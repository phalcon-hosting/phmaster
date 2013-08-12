<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master;
use Phalcon\Mvc\User\Plugin;
use phpDocumentor\Reflection\Exception;
use Phalcon\DI as DI;

/**
 *
 * Modules are plugins that are loaded after the initial services are loaded
 * @package Hosting
*/
abstract class Module extends Plugin {
    /**
     * @var mixed
     */
    public $_cache;
    /**
     * @var mixed
     */
    public $_db;
    /**
     * @var mixed
     */
    public $_config;


    /**
     *
     */
    public  function __construct() {

        /**
         * Gets the necessary services for use in modules
         * @todo include security, session and auth services here
         */
        $di = DI::getDefault();


        $this->_cache = ($di->has('cache') ? $di->get('cache') : null);
        $this->_db = ($di->has('db') ? $di->get('db') : null);
        $this->_config = ($di->has('config') ? $di->get('config') : null);

    }
}


