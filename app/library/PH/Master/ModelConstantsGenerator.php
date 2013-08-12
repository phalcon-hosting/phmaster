<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master;
use Phalcon\Config;
use Phalcon\DI;
use Phalcon\Exception;
use Phalcon\Mvc\Model;
use Phalcon\Text;

/**
 * Class ModelConstantsGenerator
 * @package Hosting
 */
class ModelConstantsGenerator  {

    /**
     * @var Config
     */
    protected $_config;

    /**
     * @var string
     */
    protected $_modelDir;

    /**
     * @var \Phalcon\Mvc\Model
     */
    protected $_model;

    /**
     * @param \Phalcon\Mvc\Model $model
     * @throws \Phalcon\Exception
     */
    public function __construct(Model $model) {

        $this->_config = DI::getDefault()->get('config');

        $this->_modelDir = $this->_config->application->modelsDir;

        if(!is_readable($this->_modelDir)) {
            throw new Exception('We could not read the model dir!');
        }

        $this->_model = $model;
    }

    public function generate() {
        echo '<pre>';
        $columns = $this->_model->getModelsMetaData()->getColumnMap($this->_model);

        foreach ($columns as $columnName) {
            echo "const ".self::createConstant($columnName) . " = '$columnName';" . PHP_EOL;
        }
        echo '</pre>';
    }

    /**
     * @param $column
     * @return string
     */
    public static function createConstant($column) {
        $constant = '';
        $pieces = preg_split('/(?=[A-Z])/',$column);
        if(count($pieces) > 0) {
            foreach ($pieces as $piece) {
              $constant .= "_$piece";
            }
            $constant = substr($constant, 1);
        }

        return Text::upper($constant);
    }
}


