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
    const CREATED_ON = 'created_on';
    const READ = 'read';

    // list of type, think to update  app/view/partials/notify-widget/notify-widget.volt
    const TYPE_ERROR   = "0";
    const TYPE_WARNING = "1";
    const TYPE_SUCCESS = "2";

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
    public $created_on;

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
            'created_on' => 'created_on',
            'read' => 'read'
        );
    }


}
