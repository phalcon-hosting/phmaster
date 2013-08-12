<?php

$language = 'nl'; //todo select language from session

$di->set('translate', function() use ($config, $language) {
    return new \PH\Master\Translate($language);
});