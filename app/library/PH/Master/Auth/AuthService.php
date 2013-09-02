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

        $session = $this->getDI()->get("session");

        $session->set('identity', $user->getId());
        $session->set('identity-gravatar', $user->getGravatarId());
        $session->set('identity-email', $user->getEmail());
    }

    /**
     * destroy the auth information from the session
     */
    public function logout(){

        $session = $this->getDI()->get("session");

        $session->remove('identity');
        $session->remove('identity-gravatar');
        $session->remove('identity-email');
    }
}