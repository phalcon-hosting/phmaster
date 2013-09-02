<?php
/**
 * @author Soufiane GHZAL
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 */

namespace PH\Master;

use Phalcon\DI\Injectable;

/**
 * This class helps to draw notifications on the phalcon hosting panel.
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
     * @return array list of the types present in the service
     */
    public function listTypes(){

        $types=array();

        foreach($this as $notif){
            if(!in_array($notif->type,$types))
                $types[]=$notif->type;
        }

        return $types;
    }

    /**
     * (from Countable) may be used to count notification for a certain type, also only unread/undead/all
     * @param null $type
     * @param boolean|null $unread null for all notification true for only unread false for only read
     * @return int
     */
    public function count($type=null,$unread=null){
        if(null===$type)
            $list = $this->_notifications;
        else
            $list = $this->getNotifications($type);

        if(null === $unread)
            return count($list);

        $count=0;
        foreach($list as $notif){
            if($notif->read == !$unread)
                $count++;
        }
        return $count;
    }

    /**
     * (from IteratorAggregate)
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator() {
        return new \ArrayIterator($this->_notifications);
    }


    public function initFromUser($userId){
        $resultset = $this->modelsManager->createBuilder()
            ->from("Notification")
            ->where("user_id = :uid:",array("uid"=>$userId))
            ->orWhere(" user_id is null")
            ->orderBy("Notification.created_on")
            ->getQuery()
            ->execute();

        $this->_notifications = array();

        foreach($resultset as $notif){
            $this->addNotification($notif);
        }

    }

}