<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2 
 */

namespace PH\Master\Auth\OAuth;


use PH\Master\Auth\BadRequestException;
use PH\Master\Auth\BadResponseException;
use PH\Master\Auth\UserFactory;
use Phalcon\Http\Request;

class GithubAuth extends OAuth2 {


    protected $_endPointAuthorize = 'https://github.com/login/oauth/authorize';

    protected $_endPointAccessToken = 'https://github.com/login/oauth/access_token';

    protected $_redirectUriAuthorize;

    protected $_baseUri;

    protected $_clientId;

    protected $_clientSecret;

    protected $_transport;


    protected $_githubApi = 'https://api.github.com';



    /**
     * @inheritdoc
     */
    public function setup()
    {

        $this->setupFromConfig("github",$this->config);

    }

    /**
     * @inheritdoc
     */
    public function askAuth(){

        $key   = $this->di->get("security")->getTokenKey();
        $token = $this->di->get("security")->getToken();

        $url = $this->_endPointAuthorize.
            '?client_id='.$this->_clientId.                 // id of github client account
            '&redirect_uri=' .                              // redirect url after auth
               $this->_redirectUriAuthorize.urlencode("?key=$key") .  // append the security key to the return uri
            '&state='. $token .                             // security token anti CSRF
            '&scope=user:email';                            // list of scope (access to github account)

        $this->di->get("response")->redirect($url, true);

    }

    /**
     * @inheritdoc
     */
    public function checkRequest( Request $request){



        if( $request->hasQuery("code") && $request->hasQuery("state") && $request->hasQuery("key") ){

            // check the securtity - anti csrf token
            $key=$request->getQuery("key");
            $value=$request->getQuery("state");

            if($this->di->get("security")->checkToken($key,$value))
                return true;
            else
                throw new BadRequestException("Github request has expired. Try to login again");

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


    protected function _parseReadRequestResponse($response){

        if (isset($response['error'])) {
            throw new BadResponseException('Github: '.$response['error']);
        }

        try {
            // GET THE DATAS FROM THE GITHUB API
            $transport = new \HttpRequest($this->_githubApi.'/user?access_token='.$response["access_token"]);
            $transport->send();
            $data = json_decode($transport->getResponseBody(), true);

            // CHECK THE DATAS
            if(!is_array($data))
                throw new BadResponseException('Cant access the github API');

            // GET THE USER
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

        } catch (\HttpInvalidParamException $e) {
            return false;
        } catch (\HttpRequestException $e) {
            return false;
        }

    }


    public function getTransport()
    {
        if (!$this->_transport) {
            $this->_transport = new \HttpRequest();
        }
        return $this->_transport;
    }


}