<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2 
 */

namespace PH\Master\Auth\OAuth;


use PH\Master\Auth\AbstractAuth;
use PH\Master\Model\User;
use Phalcon\Http\Request;

abstract class OAuth2 extends AbstractAuth {


    public function setupFromConfig($oauthName,$config){
        $this->_redirectUriAuthorize = $config->auth->get($oauthName)->redirectUri;
        $this->_clientId = $config->auth->get($oauthName)->clientId;
        $this->_clientSecret = $config->auth->get($oauthName)->secretId;
    }


    /**
     * First step of Oauth : get a token
     */
    abstract public function askAuth();

    /**
     *
     * Helper to check if the request provided for the second step is ok
     *
     * @return boolean will return true if the request is ok. Else false means that the request is not intended
     * @throws BadRequestException an exception is thrown if the request is well formatted but does not match with the security (for instance : token expriation, trying to csrf, or direct access)
     */
    abstract public function checkRequest(Request $request);

    /**
     *
     * Last step of the OAuth. We get the informations and we return an user
     *
     * @param  $request the request resulting from askAuth
     * @return User a valid user or null if something bad happened
     */
    abstract public function accessApi(Request $request);
}