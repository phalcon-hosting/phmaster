<?php

namespace PH\Master\Model;


class HostingServices extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $hosting_account_id;
     
    /**
     *
     * @var integer
     */
    protected $minion_role_id;
     
    /**
     *
     * @var integer
     */
    protected $state;
     
    /**
     * Method to set the value of field hosting_account_id
     *
     * @param integer $hosting_account_id
     * @return $this
     */
    public function setHostingAccountId($hosting_account_id)
    {
        $this->hosting_account_id = $hosting_account_id;
        return $this;
    }

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
     * Returns the value of field hosting_account_id
     *
     * @return integer
     */
    public function getHostingAccountId()
    {
        return $this->hosting_account_id;
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
        return 'hosting_services';
    }

}
