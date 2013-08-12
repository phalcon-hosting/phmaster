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

    public function initialize(){

        Phalcon\Tag::setTitle('Phalcon Hosting');

//        $mailer = new \Phalcon\Mail('mails/test');
        $this->translator = $this->di->get('translate');

        // expose the translation methods to all views
        $this->view->setVar('t', $this->translator);
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
}