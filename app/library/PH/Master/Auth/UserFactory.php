<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2 
 */

namespace PH\Master\Auth;
use PH\Master\Model\User;
use Phalcon\Exception;

/**
 * Class that aims to construct user from different services (for instance : internal login, Github OAuth, Bitbucket OAuth...)
 * Class UserFactory
 * @package PH\Master\Factory
 */
abstract class UserFactory {

    /**
     * read the data to get the user the user (does not save it, just create it)
     * calling this method assumes that you have already checked that $data was an array
     * @param $data github data from https://api.github.com/user?access_token=???
     * @param $token an array with 2 keys : access_token and token_type
     */
    public static function fromGithubApi($data,$token){
        $user = User::findFirstByAccessToken($token['access_token']);

        if($user === false){
            $user=new User();
            $user->setAccessToken($token['access_token']);
            $user->setTokenType($token['token_type']);
            $user->setEmail($data["email"]);
        }

        $user->setUsername($data["login"]);


        $user->setName($data["name"]);

        $user->setGravatarId($data["gravatar_id"]);

        return $user;

    }

}