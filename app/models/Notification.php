<?php


class Notification extends \Phalcon\Mvc\Model
{

    /**
     * Addresses constants
     */
    const ID = 'id';
    const USER_ID = 'user_id';
    const TYPE = 'type';
    const MESSAGE = 'message';
    const CREATION = 'creation';
    const READ = 'read';

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var integer
     */
    public $user_id;
     
    /**
     *
     * @var string
     */
    public $type;
     
    /**
     *
     * @var string
     */
    public $message;

    /**
     *
     * @var string
     */
    public $creation;

    /**
     *
     * @var integer
     */
    public $read;
     
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('notification');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return array(
            'id' => 'id',
            'user_id' => 'user_id',
            'type' => 'type',
            'message' => 'message',
            'creation' => 'creation',
            'read' => 'read'
        );
    }


}
