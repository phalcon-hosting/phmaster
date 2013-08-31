<?php
/**
 * @author Soufiane Ghzal
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */
use \PH\Master\User\Register as Register;
use \PH\Master\Auth\GithubAuth;
use \PH\Master\Model\User;

/**
 * Class AuthController
 *
 * Aimed to wrapped different auth services. Should not be reachable if already logged, except for logout
 *
 */
class AuthController extends ControllerBase
{


    public function beforeExecuteRoute($dispatcher){


        if ($dispatcher->getActionName() == 'logout') {

            return true;

        }

        if($this->session->get("identity")>0){
            $this->response->redirect();
            return false;
        }

        return true;
    }


    /**
     * once an user is authenticated we call this method to register him in the session
     * @param User $user
     */
    protected function _sessionAuthRegister(User $user){
        $this->di->get("auth")->setLogged($user);
    }

    /**
     * Logout the user
     * @return \Phalcon\Http\ResponseInterface
     */
    public function logoutAction(){
        if($this->di->get("auth")->isLogged())
            $this->di->get("auth")->logout();

        return $this->response->redirect();

    }

    public function loginAction(){
        if($this->di->get("auth")->isLogged()){
            return $this->getDi()->get("response")->redirect();
        }
    }


    /**
     * login from github
     *
     * Can be called to initialize an oAuth or during the oauth authentication
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function githubAction() {


        $this->view->disable();

        $auth=$this->githubAuth;


        try{

            // Check if the request comes from github to avoid csrf
            // true => ok good request => get the data at github and login the user
            // false => no request, go to github and come back here latter
            // BadRequestException => token has expired or trying to csrf
            if( ! $auth->checkRequest($this->request)){
                // if false then we initialize github auth
                $auth->askAuth();
            }else{

                //if true it means that we can try to log the user

                try{
                    // create the user from the request
                    $user=$auth->accessApi($this->request);
                }catch (\PH\Master\Auth\BadResponseException $e){
                    $user=null;
                }

                // if we cant create the user then we give an error
                if(!$user){
                    $this->flash->error("Something bad happened while trying to login with github.");
                    return $this->response->redirect();
                }

                // register the user into the session
                $this->_sessionAuthRegister($user);

                $this->flash->success("Welcome " . $user->getUsername());

                return $this->response->redirect(); // TODO same location as we come from

            }

        }catch (\PH\Master\Auth\BadRequestException $e){

            //error with github request
            $this->flash->error($e->getMessage());
            var_dump($e->getMessage());
        }



    }

}

