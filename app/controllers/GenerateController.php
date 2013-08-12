<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */

/**
 * @package PH
 */
class GenerateController extends ControllerBase
{

    /**
     * @var array
     */
    protected $_actions = array(
        'modelconstants'
    );

    public function initialize(){
        if(APPLICATION_ENV != 'development') {
            die('This only works on dev!');
        }
    }

    public function indexAction()
    {
        echo '<h3>Valid actions:</h3>';
        echo '<pre>';
        var_dump($this->_actions);
        echo '</pre>';
    }

    /**
     * @param $model
     * @throws Phalcon\Exception
     */
    public function modelConstantsAction($model = '') {
        if($model) {

            if(!class_exists($model)) {
                throw new \Phalcon\Exception("Model $model does not exist");
            }
            $modelObj = new $model;

            $modelGenerator = new \PH\Master\ModelConstantsGenerator($modelObj);
            $modelGenerator->generate();

//            throw new \Phalcon\Exception('Invalid model passed!');
        }
    }


}

