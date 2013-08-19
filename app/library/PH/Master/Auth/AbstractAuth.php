<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2 
 */

namespace PH\Master\Auth;


use PH\Master\Model\User;
use Phalcon\Http\Request;

abstract class AbstractAuth {


    protected $di;
    protected $config;

    public function setConfig($config){
        $this->config=$config;
    }

    public function setDi($di){
        $this->di = $di;
    }



    /**
     * initialize the aut
     */
    abstract public function setup();


}