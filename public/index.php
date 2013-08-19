<?php
error_reporting(E_ALL);
ini_set('display_errors',1);


// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// Define application environment
// Change 'development' to 'production' once the application is up and running on the production site
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));


set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/library'),
    realpath(APPLICATION_PATH . '/models'),
    get_include_path()
)));

$debug = new \Phalcon\Debug();
$debug->listen();

/**
 * Read the configuration
 */
$config = include __DIR__ . "/../app/config/config.php";


/**
 * Read auto-loader
 */
include __DIR__ . "/../app/resources/loader.php";

/**
 * Read services
 */
include __DIR__ . "/../app/resources/services.php";



/**
 * Handle the request
 */
$application = new \Phalcon\Mvc\Application();
$application->setDI($di);


echo $application->handle()->getContent();
// exception/404 managed from the dispatcher event