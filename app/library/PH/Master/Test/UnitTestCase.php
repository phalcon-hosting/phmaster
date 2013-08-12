<?php
/**
 * @author Stephen Hoogendijk
 * @copyright stiHosting
 * @license This file is licensed under the proprietary License of stiHosting
 * @namespace PH\Master
 */
namespace PH\Master\Test;
use Phalcon\DI\FactoryDefault,
    Phalcon\DI,
    PH\Master\Cache;

/**
 * Class UnitTestCase
 * @package Hosting
 */
class UnitTestCase extends \Phalcon\Test\UnitTestCase {

    /**
     * @var \PH\Master\Cache
     */
    protected $_cache;

    /**
     * @var \Phalcon\Config
     */
    protected $_config;

    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp() {

        // Load any additional services that might be required during testing
        $di = DI::getDefault();
        $this->_cache = $di->get('cache');
        $this->_config = $di->get('config');

        parent::setUp($di, $this->_config);

        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct() {
        if(!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError('Please run parent::setUp().');
        }
    }
}