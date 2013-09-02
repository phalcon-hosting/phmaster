<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 */

namespace PH\Master;

use Phalcon\DI\Injectable;

/**
 * This class helps to draw notifications on the phalcon hosting pannel.
 *
 * Class NotificationService
 * @package PH\Master
 */
class NotificationService extends Injectable implements \Countable , \IteratorAggregate  {


    /**
     * @var array
     */
    protected $_notifications;

    public function __construct(){
        $this->_notifications=array();
    }

    /**
     * add a notification with a certain type
     * @param string $type  type of the notification
     * @param string $message  the message to show
     */
    public function addNotification(\Notification $notification){

        $this->_notifications[]=$notification;
    }

    /**
     * Get the registered notifications. Can get per type
     * @param null|string $type if is null it will return all the notifications or else will return only the asked type of notifications
     * @return array list of notification depending on the asked type (or all notifs if $type is null)
     */
    public function getNotifications($type=null){
        if(null === $type)
            return $this->_notifications;

        $notifType=array();

        foreach($this as $notif){
            if($notif->type===$type){
                $notifType[]=$notif;
            }
        }

        return $notifType;
    }

    /**
     * (from Countable) may be used to count notification for a certain type
     * @param null $type
     * @return int
     */
    public function count($type=null){
        if(null===$type)
            return count($this->_notifications);

        return count($this->getNotifications($type));
    }

    /**
     * (from IteratorAggregate)
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator() {
        return new \ArrayIterator($this->_notifications);
    }

}