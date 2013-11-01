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

        if(!$this->auth->isLogged())
            return $this->response->redirect("auth/login");

        $user = $this->auth->getUserInstance();
        $hostringAccounts = \PH\Master\Model\HostingAccount::find(array(
            "conditions" => "user_id = ?1",
            "bind"       => array(1 => $user->getId())
        ));

        $this->view->setVar("hostingAccounts",$hostringAccounts);

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

