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

        if($this->di->get("auth")->isLogged()){
            return $this->response->redirect();
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

    public function registerAction() {
        $postData = $this->request->getPost(null);
        $this->view->genderOptions = Users::getGenderOptions();

        if($postData) {
            $user = new Users();

            $user->{Users::EMAIL} = $this->request->getPost('email');
            $user->{Users::PASSWORD} = Register::hashPassword($this->request->getPost('password'));

            $user->{Users::NAME} = $this->request->getPost('name');
            $user->{Users::GENDER} = $this->request->getPost('gender');

            // TODO: allow user to add his address
            $user->{Users::ADDRESS_ID} = 1;

            $user->{Users::USER_TYPE} = Users::UT_REGULAR;
            $user->{Users::USER_STATUS} = Users::US_INACTIVE;
            $user->{Users::ACTIVATION_KEY} = Register::generateActivaitonCode($this->request->getPost('email'));
            $user->{Users::JOIN_DATE} = date('Y-m-d H:i:s', time());
            $user->{Users::LAST_LOGIN} = date('Y-m-d H:i:s', time());
            // TODO: change to the default locale
            $user->{Users::LANGUAGE} = 'nl_nl';

            $success = $user->save();

            if ($success) {
                $this->flash->success("Thanks for registering!");
            } else {
                foreach ($user->getMessages() as $message) {
                    $this->view->error .= '<li>' . $message->getMessage() . "</li>";
                }
            }
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

