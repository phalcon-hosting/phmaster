<?php

namespace PH\Master\Model;


class Minion extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;
     
    /**
     *
     * @var integer
     */
    protected $cluster_id;
     
    /**
     *
     * @var string
     */
    protected $identifier;
     
    /**
     *
     * @var string
     */
    protected $hostname;
     
    /**
     *
     * @var string
     */
    protected $ip_address;
     
    /**
     *
     * @var string
     */
    protected $public_key;
     
    /**
     *
     * @var string
     */
    protected $last_communication;
     
    /**
     *
     * @var integer
     */
    protected $state;
     
    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Method to set the value of field cluster_id
     *
     * @param integer $cluster_id
     * @return $this
     */
    public function setClusterId($cluster_id)
    {
        $this->cluster_id = $cluster_id;
        return $this;
    }

    /**
     * Method to set the value of field identifier
     *
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Method to set the value of field hostname
     *
     * @param string $hostname
     * @return $this
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * Method to set the value of field ip_address
     *
     * @param string $ip_address
     * @return $this
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
        return $this;
    }

    /**
     * Method to set the value of field public_key
     *
     * @param string $public_key
     * @return $this
     */
    public function setPublicKey($public_key)
    {
        $this->public_key = $public_key;
        return $this;
    }

    /**
     * Method to set the value of field last_communication
     *
     * @param string $last_communication
     * @return $this
     */
    public function setLastCommunication($last_communication)
    {
        $this->last_communication = $last_communication;
        return $this;
    }

    /**
     * Method to set the value of field state
     *
     * @param integer $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field cluster_id
     *
     * @return integer
     */
    public function getClusterId()
    {
        return $this->cluster_id;
    }

    /**
     * Returns the value of field identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Returns the value of field hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Returns the value of field ip_address
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Returns the value of field public_key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * Returns the value of field last_communication
     *
     * @return string
     */
    public function getLastCommunication()
    {
        return $this->last_communication;
    }

    /**
     * Returns the value of field state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    public function getSource()
    {
        return 'minion';
    }

}
