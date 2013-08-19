<?php

namespace PH\Master\Model;


class User extends \Phalcon\Mvc\Model
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
     * @var string
     */
    protected $username;
     
    /**
     *
     * @var string
     */
    protected $email;
     
    /**
     *
     * @var string
     */
    protected $gravatar_id;
     
    /**
     *
     * @var string
     */
    protected $token_type;
     
    /**
     *
     * @var string
     */
    protected $access_token;
     
    /**
     *
     * @var string
     */
    protected $created_on;
     
    /**
     *
     * @var string
     */
    protected $modified_on;
     
    /**
     *
     * @var string
     */
    protected $login_time;
     
    /**
     *
     * @var string
     */
    protected $notifications;
     
    /**
     *
     * @var string
     */
    protected $timezone;
     
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
     * Method to set the value of field username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Method to set the value of field gravatar_id
     *
     * @param string $gravatar_id
     * @return $this
     */
    public function setGravatarId($gravatar_id)
    {
        $this->gravatar_id = $gravatar_id;
        return $this;
    }

    /**
     * Method to set the value of field token_type
     *
     * @param string $token_type
     * @return $this
     */
    public function setTokenType($token_type)
    {
        $this->token_type = $token_type;
        return $this;
    }

    /**
     * Method to set the value of field access_token
     *
     * @param string $access_token
     * @return $this
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }

    /**
     * Method to set the value of field created_on
     *
     * @param string $created_on
     * @return $this
     */
    public function setCreatedOn($created_on)
    {
        $this->created_on = $created_on;
        return $this;
    }

    /**
     * Method to set the value of field modified_on
     *
     * @param string $modified_on
     * @return $this
     */
    public function setModifiedOn($modified_on)
    {
        $this->modified_on = $modified_on;
        return $this;
    }

    /**
     * Method to set the value of field login_time
     *
     * @param string $login_time
     * @return $this
     */
    public function setLoginTime($login_time)
    {
        $this->login_time = $login_time;
        return $this;
    }

    /**
     * Method to set the value of field notifications
     *
     * @param string $notifications
     * @return $this
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
        return $this;
    }

    /**
     * Method to set the value of field timezone
     *
     * @param string $timezone
     * @return $this
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
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
     * Returns the value of field username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field gravatar_id
     *
     * @return string
     */
    public function getGravatarId()
    {
        return $this->gravatar_id;
    }

    /**
     * Returns the value of field token_type
     *
     * @return string
     */
    public function getTokenType()
    {
        return $this->token_type;
    }

    /**
     * Returns the value of field access_token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Returns the value of field created_on
     *
     * @return string
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * Returns the value of field modified_on
     *
     * @return string
     */
    public function getModifiedOn()
    {
        return $this->modified_on;
    }

    /**
     * Returns the value of field login_time
     *
     * @return string
     */
    public function getLoginTime()
    {
        return $this->login_time;
    }

    /**
     * Returns the value of field notifications
     *
     * @return string
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Returns the value of field timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {


    }

    public function getSource()
    {
        return 'user';
    }

}
