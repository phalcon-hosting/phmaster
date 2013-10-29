<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */
use Phalcon\Mvc\Controller;

/**
 * Class ControllerBase
 */
class ControllerBase extends Controller
{

    /**
     * @var \PH\Master\Translate
     */
    public $translator;

    /**
     * @var \PH\Master\NotificationService
     */
    public $notificator;

    public function initialize(){

        Phalcon\Tag::setTitle('Phalcon Hosting');


        // PREPARE THE TRANSLATE SERVICE FOR THE VIEWS
        $this->translator = $this->di->get('translate');
        $this->view->setVar('t', $this->translator);


        // PREPARE THE NOTIFICATIONS SERVICE FOR THE VIEWS
        // the notificator is initialized in `afterExecuteRoute`, because it needs user id
        $this->notificator = $this->di->get("notification");
        $this->view->setVar('notifications', $this->notificator);
    }

    /**
     * Translation method for controllers
     * @param $key
     * @param array $params
     * @return mixed
     */
    public function translate($key, array $params = array()) {
        return $this->translator->translate($key, $params);
    }

    public function afterExecuteRoute($dispatcher)
    {
        $id = $this->getDI()->get("auth")->getUserId();
        if($id>0){
            // ITINIALIZE NOTIFICATION SERVICE
            $this->notificator->initFromUser($id);

            // PREPARE THE USER INSTANCE FOR THE VIEWS
            $user = $this->getDI()->get("auth")->getUserInstance();
            $this->view->setVar('user', $user);

        }
    }

}