<?php

/**
 * Class IndexController
 */
class IndexController extends ControllerBase
{
    /**
     * @var \Phalcon\Db\Result\Pdo
     */
    protected $_query;

    /**
     * Init method
     */
    public function initialize() {
        Phalcon\Tag::setTitle('Phalcon Hosting');
        parent::initialize();
    }

    public function indexAction()
    {


        $n=new Notification();
        $n->message="test";
        $n->type="warning";
        $n->creation="2010-01-02 25:00";
        $this->notificator->addNotification($n);

    }

    public function generateAction() {




//       try {
//           $this->db->begin();
//
//           $newUser = new Users();
//
//           $newUser->assign(array(
//
//           ));
//
//           if ($newUser->save() == false) {
//               $this->db->rollback();
//               return;
//           }
//
//           $this->db->commit();
//
//       } catch(\Phalcon\Exception $e) {
//           $this->db->rollback();
//           throw $e;
//       }

    }

}

