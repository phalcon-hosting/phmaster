<?php
use Phalcon\Mvc\View,
Phalcon\Mvc\View\Engine\Volt as VoltEngine;

/**
 * Setting up the view component
 */
$di->set('view', function() use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_',
                'compileAlways' => true
            ));

            $volt->getCompiler()->addFunction(
                't',
                function($key) {
                    return "\\Hosting\\Translate::translate({$key})";
                }
            );

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php' // Generate Template files uses PHP itself as the template engine
    ));

    return $view;
}, true);
