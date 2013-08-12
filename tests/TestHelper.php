<?php
/**
 * @author Stephen Hoogendijk
 * @copyright PhalconHosting
 * @license This file is licensed under the proprietary License of PhalconHosting
 * @namespace PH\Master
 */
use Phalcon\DI,
    Phalcon\DI\FactoryDefault;

error_reporting(E_ALL);
ini_set('display_errors',1);

define('ROOT_PATH', __DIR__);

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

define('PATH_LIBRARY', APPLICATION_PATH.'/library/');
define('PATH_SERVICES', APPLICATION_PATH.'/services/');
define('PATH_RESOURCES', APPLICATION_PATH.'/resources/');

error_reporting(E_ALL);
set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

$configFile = APPLICATION_PATH.'/config/config.dist.php';
if(!is_readable($configFile)) {
    throw new PHPUnit_Framework_IncompleteTestError(sprintf('config %s not readable', $configFile));
}

$config = include $configFile;

// use the application autoloader to autoload the classes
include PATH_RESOURCES . 'loader.php';

$di = new FactoryDefault();
DI::reset();
include PATH_RESOURCES . 'services.php';
DI::setDefault($di);
