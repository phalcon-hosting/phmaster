<?php
/*
+------------------------------------------------------------------------+
| Phalcon Framework |
+------------------------------------------------------------------------+
| Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com) |
+------------------------------------------------------------------------+
| This source file is subject to the New BSD License that is bundled |
| with this package in the file docs/LICENSE.txt. |
| |
| If you did not receive a copy of the license and are unable to |
| obtain it through the world-wide-web, please send an email |
| to license@phalconphp.com so we can send you a copy immediately. |
+------------------------------------------------------------------------+
| Authors: Andres Gutierrez <andres@phalconphp.com> |
| Eduar Carvajal <eduar@phalconphp.com> |
+------------------------------------------------------------------------+
*/
/**
 *
 * <pre>
 * The goal of this plugin is to create an easy interface for sending emails with phalcon.
 *
 * You can pass the name of a view which resided in your view directory and the mail component will parse it together
 * with any variables you pass.
 *
 * </pre>
 *
 * @author Stephen Hoogendijk <info@phalconhosting.com>
 * @copyright Phalcon Hosting
 * @namespace Phalcon
*/
namespace Phalcon;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\View;

/**
@package Hosting
*/
class Mail extends Plugin {

    /**
     * @var bool
     */
    protected $_disableFlash = false;

    /**
     * @var string
     */
    protected $_mailTemplateDir;


    protected $_viewContent;


    public function __construct($viewName = null, $alternateViewsDir = null) {
        if(!is_null($viewName)) {

            if(!$this->view) {
                throw new Exception('No view engine registered!');
            }

            $mailView = clone $this->view;

            $mailView->reset();
            $mailView->setRenderLevel(View::LEVEL_NO_RENDER);

            $mailView->setVar('bla', 'BLALALA');
            $mailView->partial($viewName);
            //Start the output buffering
//            $mailView->start();
//            $mailView->render(null,null);

            //Finish the output buffering

            // get the contents from the outputBuffer related to this view, resume normal operation
            $this->_viewContent = ob_get_contents();
            ob_end_clean();



        }
    }

    /**
     * Disable any flash messages that might be sent as the result of an action here
     * @param $setting
     * @return $this
     */
    public function setDisableFlash($setting) {
        $this->_disableFlash = (bool)$setting;
        return $this;
    }
}


