<?php

namespace PH\Master\Model;


class HostingAccountType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;
     
    /**
     *
     * @var string
     */
    protected $name;
     
    /**
     *
     * @var double
     */
    protected $hd_limit;
     
    /**
     *
     * @var double
     */
    protected $traffic_limit;
     
    /**
     *
     * @var integer
     */
    protected $disabled;
     
    /**
     *
     * @var string
     */
    protected $cost;
     
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
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Method to set the value of field hd_limit
     *
     * @param double $hd_limit
     * @return $this
     */
    public function setHdLimit($hd_limit)
    {
        $this->hd_limit = $hd_limit;
        return $this;
    }

    /**
     * Method to set the value of field traffic_limit
     *
     * @param double $traffic_limit
     * @return $this
     */
    public function setTrafficLimit($traffic_limit)
    {
        $this->traffic_limit = $traffic_limit;
        return $this;
    }

    /**
     * Method to set the value of field disabled
     *
     * @param integer $disabled
     * @return $this
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * Method to set the value of field cost
     *
     * @param string $cost
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
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
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field hd_limit
     *
     * @return double
     */
    public function getHdLimit()
    {
        return $this->hd_limit;
    }

    /**
     * Returns the value of field traffic_limit
     *
     * @return double
     */
    public function getTrafficLimit()
    {
        return $this->traffic_limit;
    }

    /**
     * Returns the value of field disabled
     *
     * @return integer
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Returns the value of field cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    public function getSource()
    {
        return 'hosting_account_type';
    }

}
