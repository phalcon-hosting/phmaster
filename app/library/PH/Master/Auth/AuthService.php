<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 */

namespace PH\Master\Auth;


use PH\Master\Model\User;
use Phalcon\DI\Injectable;

/**
 * This class speak with session to know if user is logged or not, or to log/logout an user
 *
 * Class AuthService
 * @package PH\Master\Auth
 */
class AuthService extends Injectable  {

    protected $userInstance = null;

    /**
     * say whether or not the user is logged
     * @return bool true if the user is logged or false
     */
    public function isLogged(){
        return $this->getDI()->get("session")->get("identity")>0;
    }

    /**
     * get the id of the authenticated user
     * @return int id of the user (0 means not logged)
     */
    public function getUserId(){
        if($this->isLogged()){
            $session = $this->getDI()->get("session");
            return $session->get('identity');
        }

        return 0;
    }


    /**
     * Register the user into the session
     * @param User $user
     */
    public function setLogged(User $user){

        $this->invalidateUser();

        $session = $this->getDI()->get("session");

        $session->set('identity', $user->getId());
        $session->set('identity-gravatar', $user->getGravatarId());
        $session->set('identity-email', $user->getEmail());
    }

    /**
     * destroy the auth information from the session
     */
    public function logout(){

        $this->invalidateUser();

        $session = $this->getDI()->get("session");

        $session->remove('identity');
        $session->remove('identity-gravatar');
        $session->remove('identity-email');
    }

    /**
     * Invalidate the cached user.
     * The next call to `getUserInstance` will perform a new DB operation
     */
    public function invalidateUser(){
        $this->userInstance = null;
    }

    /**
     * Create an user instance from the logged user
     * @return User the user instance
     */
    public function getUserInstance(){

        if(!$this->isLogged())
            return null;
        // TODO : use the cache to store that
        if($this->userInstance == null){
            $this->userInstance = User::findFirst($this->getUserId());
        }

        return $this->userInstance;

    }
}