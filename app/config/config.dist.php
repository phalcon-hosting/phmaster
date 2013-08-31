<?php
/**
 * @author Stephen Hoogendijk
 * @copyright PhalconHosting
 * @license This file is licensed under the proprietary License of PhalconHosting
 * @namespace PH\Master
 */

/**
 * This configuration file must be set to work on production.
 */
return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => '',
        'username'    => '',
        'dbname'      => '',
        'password'    => ''
    ),
    'application' => array(
        'controllersDir' => APPLICATION_PATH.'/controllers/',
        'modelsDir'      => APPLICATION_PATH.'/models/',
        'viewsDir'       => APPLICATION_PATH.'/views/',
        'pluginsDir'     => APPLICATION_PATH.'/plugins/',
        'libraryDir'     => APPLICATION_PATH.'/library/',
        'servicesDir'    => APPLICATION_PATH.'/services/',
        'cacheDir'       => APPLICATION_PATH.'/cache/',
        'locales'        => APPLICATION_PATH.'/messages/',
        'baseUri'        => '/',
    ),
    'auth' => array(
        'github' => array(
            'redirectUri' => BASE_URL."/auth/github",
            'clientId'    => "",
            'secretId'    => ""
        )
    )
));