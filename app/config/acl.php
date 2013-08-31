<?php
use \PH\Master\AclBuilder as AclBuilder;
/**
 * @author Stephen Hoogendijk
 * @copyright PhalconHosting
 * @license This file is licensed under the proprietary License of PhalconHosting
 * @namespace PH\Master
 */
return new \Phalcon\Config(array(
    /**
     * Roles should be sorted in order of rights
     */
    'roles' => array(
        AclBuilder::ROLE_ADMIN,
        AclBuilder::ROLE_MODERATOR,
        AclBuilder::ROLE_USER,
        AclBuilder::ROLE_GUEST
    ),
    /**
     * Public controllers are controllers available for ALL roles. If only a certain role is allowed to access a action
     * within a public controller, then the action can be protected by adding it to the role. Then only that role (and
     * it's children) will inherit the rights to access it.
     */
    'publiccontrollers' => array(
        'index',
        'error'
    ),
    /**
     * <pre>
     * Resources are resources a user type may access.
     * The AclBuilder makes sure that users can access the resources defined here
     *
     * Access rights are inherited, so the least privileged should go on top.
     *
     * Format is Role => array (
     *      'controller' => array(actions) || string action
     * )
     * </pre>
     *
     */
    'resources' =>
        array(
        AclBuilder::ROLE_GUEST => array(
            'register'       =>      'index'
        ),
        AclBuilder::ROLE_ADMIN => array(
            'admin'          =>      'index',
            'index'          =>      'generate',
        )
    )

));
