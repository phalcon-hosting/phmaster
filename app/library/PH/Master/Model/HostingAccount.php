<?php

namespace PH\Master\Model;


class HostingAccount extends \Phalcon\Mvc\Model
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
    protected $minion_identifier;
     
    /**
     *
     * @var integer
     */
    protected $hosting_account_type_id;
     
    /**
     *
     * @var integer
     */
    protected $user_id;
     
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
     * Method to set the value of field minion_identifier
     *
     * @param string $minion_identifier
     * @return $this
     */
    public function setMinionIdentifier($minion_identifier)
    {
        $this->minion_identifier = $minion_identifier;
        return $this;
    }

    /**
     * Method to set the value of field hosting_account_type_id
     *
     * @param integer $hosting_account_type_id
     * @return $this
     */
    public function setHostingAccountTypeId($hosting_account_type_id)
    {
        $this->hosting_account_type_id = $hosting_account_type_id;
        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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
     * Returns the value of field minion_identifier
     *
     * @return string
     */
    public function getMinionIdentifier()
    {
        return $this->minion_identifier;
    }

    /**
     * Returns the value of field hosting_account_type_id
     *
     * @return integer
     */
    public function getHostingAccountTypeId()
    {
        return $this->hosting_account_type_id;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    public function getSource()
    {
        return 'hosting_account';
    }

}
