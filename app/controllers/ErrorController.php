<?php
/**
 * @author Stephen Hoogendijk
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */
/**
 * Class ErrorController
 */
class ErrorController extends ControllerBase
{
    /**
     * @var \Phalcon\Db\Result\Pdo
     */
    protected $_query;

    /**
     * Init method
     */
    public function initialize() {
        parent::initialize();
    }

    public function indexAction()
    {

    }

    /**
     * This action fires when a page cannot be found
     */
    public function notFoundAction() {
        $this->response->setStatusCode(404, "Not Found");
        echo '<pre> A NICE 404 MESSAGE </pre>';
    }

    public function notAuthenticatedAction() {
        $this->response->setStatusCode(403, "Not Authenticated");
        $this->flash->error($this->translate('$msg not authenticated'));
    }

    /**
     * This action fires when a page cannot be found
     */
    public function fatalAction() {
        $this->response->setStatusCode(500, "Error");
        echo '<pre> A NICE 500 MESSAGE </pre>';
    }
}

