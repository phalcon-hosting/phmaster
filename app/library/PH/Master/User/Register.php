<?php
/**
 * @author Ivo Stefanov
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master\User;

use PH\Master\ServiceBase;

/**
@package Hosting
*/
class Register extends ServiceBase {

    /**
     * Hashes a plain password
     * @param $plainPassword
     * @return string
     */
    public static function hashPassword($plainPassword) {
        // TODO: Add salting
        return hash('SHA256', $plainPassword);
    }

    /**
     * Generates an activation code
     * @param $email
     * @return string
     */
    public static function generateActivaitonCode($email) {
        return sha1(mt_rand(10000,99999).time().$email);
    }
}