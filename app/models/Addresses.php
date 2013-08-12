<?php


class Addresses extends \Phalcon\Mvc\Model
{

    /**
     * Addresses constants
     */
    const ID = 'id';
    const COUNTRY = 'country';
    const CITY = 'city';
    const STREET = 'street';
    const NUMBER = 'number';
    const ADDITION = 'addition';

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var string
     */
    public $country;
     
    /**
     *
     * @var string
     */
    public $city;
     
    /**
     *
     * @var string
     */
    public $street;
     
    /**
     *
     * @var integer
     */
    public $number;
     
    /**
     *
     * @var string
     */
    public $addition;
     
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('Addresses');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return array(
            'id' => 'id', 
            'country' => 'country', 
            'city' => 'city', 
            'street' => 'street', 
            'number' => 'number', 
            'addition' => 'addition'
        );
    }

}
