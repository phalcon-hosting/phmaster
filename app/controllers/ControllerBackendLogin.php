<?php
/**
 * @author Soufiane Ghzal
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */

/**
 * Class ControllerBackendLogin
 * This controller is aimed to be extend by each controller that need a backend login
 */
class ControllerBackendLogin extends ControllerBase {

    public function beforeExecuteRoute($dispatcher){

        if(!$this->di->get("auth")->isLogged()){
            $this->response->redirect("auth/login?r=" . (\PH\Master\Util\Url::current()) ); // TODO : handle the redirect on login
            return false;
        }else
            return true;
    }

}