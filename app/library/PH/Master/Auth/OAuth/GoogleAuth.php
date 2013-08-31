<?php
/**
 * @author Ivo Stefanov
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2 
 */

namespace PH\Master\Auth\OAuth;


use PH\Master\Auth\BadRequestException;
use PH\Master\Auth\BadResponseException;
use PH\Master\Auth\UserFactory;
use Phalcon\Http\Request;

class GoogleAuth extends OAuth2 {

    protected $_endPointAuthorize = "https://accounts.google.com/o/oauth2/auth";

    protected $_endPointAccessToken = '';

    protected $_redirectUriAuthorize = 'http://phalconhosting.com/oauth2callback';

    protected $_baseUri;

    protected $_clientId;

    protected $_clientSecret;

    protected $_transport;

    protected $_googleApi = '';



    /**
     * @inheritdoc
     */
    public function setup()
    {
        $this->setupFromConfig("google", $this->config);
    }

    /**
     * @inheritdoc
     */
    public function askAuth() {

        $key   = $this->di->get("security")->getTokenKey();
        $token = $this->di->get("security")->getToken();

        $url = $this->_endPointAuthorize .
            '?client_id=' . $this->_clientId .                  // id of github client account
            '&redirect_uri=' . $this->_redirectUriAuthorize .   // redirect url after auth
            '&state=' . $token .                                // security token anti CSRF
            '&response_type=code&'.                             // response type important for google
            '&scope=openid email';

        $this->di->get("response")->redirect($url, true);
    }

    /**
     * @inheritdoc
     */
    public function checkRequest(Request $request) {

        if($request->hasQuery("state") && $request->hasQuery("code")){

            $value = $request->getQuery("state");


//            if($this->di->get("security")->checkToken($value)) {
            if(true) {
                return true;
            }

            throw new BadRequestException("Google request has expired. Try to login again");
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function accessApi(Request $request)
    {
        $response = $this->send($this->_endPointAccessToken, array(
            'client_id' => $this->_clientId,
            'client_secret' => $this->_clientSecret,
            'code' => $request->getQuery('code'),
            'state' => $request->getQuery('state')
        ));

        if(!$response || !is_array($response))
            return null;
        else{
            try{
                return $this->_parseReadRequestResponse($response);
            }catch(BadResponseException $e){
                throw $e;
            }
        }
    }


    /**
     * @param $response
     * @throws \PH\Master\Auth\BadResponseException
     * @return int
     */
    protected function _parseReadRequestResponse($response){

        if (isset($response['error'])) {
            throw new BadResponseException('Google: '.$response['error']);
        }

        try {
            // Extract the necessary data from Google API
            $transport = new \HttpRequest($this->_googleApi.'/user?access_token='.$response["access_token"]);
            $transport->send();
            $data = json_decode($transport->getResponseBody(), true);

            // Perform a data check
            if(!is_array($data))
                throw new BadResponseException('Cant access Google API');

            // Retrieve the user
            $user = UserFactory::fromGithubApi($data,$response);

            if(!$user->save()){
                foreach ($user->getMessages() as $message) {
                    var_dump((string) $message);
                }
                return null;
            }

            return $user;

        } catch (\HttpInvalidParamException $e) {
            return null;
        }
    }

    /**
     * @param $url
     * @param $parameters
     * @param $method
     * @return bool|mixed
     */
    public function send($url, $parameters, $method=\HttpRequest::METH_POST)
    {
        try {
            $transport = $this->getTransport();

            $transport->setHeaders(array(
                'Accept' => 'application/json'
            ));

            $transport->setUrl($url);
            $transport->setMethod($method);

            switch ($method) {
                case \HttpRequest::METH_POST:
                    $transport->addPostFields($parameters);
                    break;
                case \HttpRequest::METH_GET:
                    $transport->addQueryData($parameters);
                    break;
            }

            $transport->send();

            return json_decode($transport->getResponseBody(), true);
        }
        catch (\HttpInvalidParamException $e) {
            return false;
        }
        catch (\HttpRequestException $e) {
            return false;
        }
    }


    public function getTransport()
    {

    }


}