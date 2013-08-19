<?php

namespace PH\Master\Model;


class MinionRole extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $minion_role_id;
     
    /**
     *
     * @var integer
     */
    protected $minion_id;
     
    /**
     *
     * @var integer
     */
    protected $role_id;
     
    /**
     *
     * @var string
     */
    protected $hostname;
     
    /**
     * Method to set the value of field minion_role_id
     *
     * @param integer $minion_role_id
     * @return $this
     */
    public function setMinionRoleId($minion_role_id)
    {
        $this->minion_role_id = $minion_role_id;
        return $this;
    }

    /**
     * Method to set the value of field minion_id
     *
     * @param integer $minion_id
     * @return $this
     */
    public function setMinionId($minion_id)
    {
        $this->minion_id = $minion_id;
        return $this;
    }

    /**
     * Method to set the value of field role_id
     *
     * @param integer $role_id
     * @return $this
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
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
     * Returns the value of field minion_role_id
     *
     * @return integer
     */
    public function getMinionRoleId()
    {
        return $this->minion_role_id;
    }

    /**
     * Returns the value of field minion_id
     *
     * @return integer
     */
    public function getMinionId()
    {
        return $this->minion_id;
    }

    /**
     * Returns the value of field role_id
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->role_id;
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

    public function getSource()
    {
        return 'minion_role';
    }

}
