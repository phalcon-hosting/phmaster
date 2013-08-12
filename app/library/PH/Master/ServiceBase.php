<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master;

use PH\Master\Module;
use Phalcon\Config;
use Phalcon\Db;
use Phalcon\DI;
use Phalcon\DiInterface;
use Phalcon\Exception;
use Phalcon\Cache\Backend\Apc;
use Phalcon\Paginator\Adapter\Model;

/**
@package Hosting
*/
abstract class ServiceBase extends Module{

    /**
     * @var \Phalcon\Db
     */
    protected $_db;

    /**
     * @var \Phalcon\Config
     */
    protected $_config;

    /**
     * @var \Phalcon\Cache\Backend\Apc
     */
    protected $_cache;

    /**
     * @var bool
     */
    private $__constructed = false;

    /**
     *
     */
    public function __construct() {
        parent::__construct();

        $this->__constructed = true;
    }


    /**
     * Check if the constructor was called
     */
    public function __destruct() {
        if(!$this->__constructed) {
            throw new Exception(sprintf('Invalid use of %s detected! Run parent::__construct().',__CLASS__));
        }
    }
}


