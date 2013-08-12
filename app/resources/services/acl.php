<?php

$aclConfig = include __DIR__ . '/../../config/acl.php';

$cache = \Phalcon\DI::getDefault()->get('cache');

/**
 * Should there be any errors, log the error and terminate the application
 */
try {

    /**
     * if the aclconfig has been changed or the cache no longer holds the acl, rebuild it
     */
    $aclConfigKey = 'PHH'.crc32(serialize($aclConfig));

    if(!$cache->exists($aclConfigKey)) {

        $acl = new \Phalcon\Acl\Adapter\Memory();

        // Default action is deny access
        $acl->setDefaultAction(Phalcon\Acl::DENY);

        // build the ACL
        \PH\Master\AclBuilder::build($acl, $aclConfig);
        $cache->save($aclConfigKey, $acl);

    } else {
        $acl = $cache->get($aclConfigKey);
    }

} catch (\Phalcon\Exception $e) {
    // todo log error instead of outputting
    die($e->getMessage());

}
// add the ACL to the DI
$di->setShared('acl',  $acl);
