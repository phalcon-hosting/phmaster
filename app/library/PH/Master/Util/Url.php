<?php
/**
 * @author Soufiane Ghzal
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */

namespace PH\Master\Util;


/**
 * Url
 *
 * @author sghzal
 */
class Url {

    protected $protocol="http";

    protected $domain;

    protected $uri;

    protected $port=80;


    /**
     *
     * @return Url
     */
    public static function current(){
        $url = new Url();

        $url->setProtocol("http" . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "s" : "" ) );
        $url->setDomain($_SERVER["SERVER_NAME"]);

        $url->setUri($_SERVER["REQUEST_URI"]);

        $url->setPort($_SERVER["SERVER_PORT"]);

        return $url;

    }

    public function build(){
        return $this->protocol . "://" . $this->domain .  ($this->port != 80 ? ":" . $this->port : "" )  . $this->uri;
    }


    public function __toString() {
        return $this->build();
    }



    public function getProtocol() {
        return $this->protocol;
    }

    public function setProtocol($protocol) {
        $this->protocol = $protocol;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function setDomain($domain) {
        $this->domain = $domain;
    }

    public function getUri() {
        return $this->uri;
    }

    public function setUri($uri) {
        $this->uri = $uri;
    }

    public function getPort() {
        return $this->port;
    }

    public function setPort($port) {
        $this->port = $port;
    }



}