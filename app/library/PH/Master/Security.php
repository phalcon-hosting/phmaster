<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
*/
namespace PH\Master;

use Phalcon\DI;
use Phalcon\Events\Event,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Acl;

/**
@package Hosting
*/
class Security extends Module {

    /**
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher){

//
        //Check whether the "auth" variable exists in session to define the active role
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = AclBuilder::ROLE_GUEST;
        } else {
            $role = AclBuilder::ROLE_USER;

            //@todo check admin role
        }


        //Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();


        //Obtain the ACL list
        $acl = $this->_getAcl();

        //Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);
        if ($allowed != Acl::ALLOW) {

            //If he doesn't have access forward him to the index controller
            $this->response->redirect('error/notauthenticated')->send();

            //Returning "false" we tell to the dispatcher to stop the current operation
            return false;
        }

        return true;

    }

    /**
     * @return \Phalcon\Acl\Adapter\Memory
     */
    protected function _getAcl() {
        return $this->di->get('acl');

    }

}
