<?php


class Users extends \Phalcon\Mvc\Model
{

    /**
     * User constants
     */
    const ID = 'id';
    const ADDRESS_ID = 'addressId';
    const COMPANY_ID = 'companyId';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const USER_TYPE = 'userType';
    const GENDER = 'gender';
    const NAME = 'name';
    const ACTIVATION_KEY = 'activationKey';
    const PASSWORD_RESET_KEY = 'passwordResetKey';
    const USER_STATUS = 'userStatus';
    const JOIN_DATE = 'joinDate';
    const LAST_LOGIN = 'lastLogin';
    const LANGUAGE = 'language';

    /**
     * User Type constants
     */
    const UT_ADMIN = 1;
    const UT_MODERATOR = 2;
    const UT_REGULAR = 3;


    /**
     * User Status constants
     */
    const US_ACTIVE = 1;
    const US_INACTIVE = 2;
    const US_BANNED = 3;
    const US_PENDING = 4;


    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var integer
     */
    public $addressId;
     
    /**
     *
     * @var string
     */
    public $email;
     
    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $userType;
     
    /**
     *
     * @var string
     */
    public $gender;
     
    /**
     *
     * @var string
     */
    public $name;
     
    /**
     *
     * @var integer
     */
    public $companyId;
     
    /**
     *
     * @var string
     */
    public $activationKey;
     
    /**
     *
     * @var string
     */
    public $passwordResetKey;
     
    /**
     *
     * @var integer
     */
    public $userStatus;
     
    /**
     *
     * @var string
     */
    public $joinDate;
     
    /**
     *
     * @var string
     */
    public $lastLogin;
     
    /**
     *
     * @var string
     */
    public $language;
     
    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new \Phalcon\Mvc\Model\Validator\Email(
                array(
                    "field"    => "email",
                    "required" => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('Users');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return array(
            'id' => 'id', 
            'addressId' => 'addressId', 
            'email' => 'email', 
            'password' => 'password', 
            'userType' => 'userType',
            'gender' => 'gender', 
            'name' => 'name', 
            'companyId' => 'companyId', 
            'activationKey' => 'activationKey', 
            'passwordResetKey' => 'passwordResetKey', 
            'userStatus' => 'userStatus',
            'joinDate' => 'joinDate', 
            'lastLogin' => 'lastLogin', 
            'language' => 'language'
        );
    }

    /**
     * Returns available gender options
     * @return array
     */
    public static function getGenderOptions() {
        return array(
            "U" => "Unspecified",
            "M" => "Male",
            "F" => "Female"
        );
    }
}
