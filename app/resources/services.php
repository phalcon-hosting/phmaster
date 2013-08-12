<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */


use Phalcon\DI\FactoryDefault,
	Phalcon\Mvc\View,
	Phalcon\Mvc\Url as UrlResolver,
	Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
	Phalcon\Mvc\View\Engine\Volt as VoltEngine,
	Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter,
	Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();



/**
 * Set the data cache service*
*/


// load the caching service
include __DIR__."/services/caches.php";


$di->set('testdi', function() use ($config){

    return "aaa";
});

echo "\n\n==CHECKING CACHE==\n\n";
var_dump($di->get("testdi"));

// load the translation service
include __DIR__."/services/translate.php";

// load the session service
include __DIR__."/services/session.php";

// load the view services
include __DIR__."/services/view.php";

// load the url service
include __DIR__."/services/url.php";

// load the db service
include __DIR__."/services/db.php";

// load the flash service
include __DIR__."/services/flash.php";

// load the ACL
include __DIR__."/services/acl.php";

// load the security service
include __DIR__."/services/security.php";

// load the config into the DI
$di->set('config', $config);

/**
 * Other (misc) services
 *
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function() use ($config) {
	return new MetaDataAdapter();
});

