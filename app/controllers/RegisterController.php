<?php
/**
 * @author Ivo Stefanov
 * @copyright Phalcon Hosting
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Licensed under the Apache license V2
 * @namespace PH\Master
 */
use \PH\Master\User\Register as Register;

/**
 * Class RegisterController
 */
class RegisterController extends ControllerBase
{

    public function indexAction() {
        $postData = $this->request->getPost(null);
        $this->view->genderOptions = Users::getGenderOptions();

        if($postData) {
            $user = new Users();

            $user->{Users::EMAIL} = $this->request->getPost('email');
            $user->{Users::PASSWORD} = Register::hashPassword($this->request->getPost('password'));

            $user->{Users::NAME} = $this->request->getPost('name');
            $user->{Users::GENDER} = $this->request->getPost('gender');

            // TODO: allow user to add his address
            $user->{Users::ADDRESS_ID} = 1;

            $user->{Users::USER_TYPE} = Users::UT_REGULAR;
            $user->{Users::USER_STATUS} = Users::US_INACTIVE;
            $user->{Users::ACTIVATION_KEY} = Register::generateActivaitonCode($this->request->getPost('email'));
            $user->{Users::JOIN_DATE} = date('Y-m-d H:i:s', time());
            $user->{Users::LAST_LOGIN} = date('Y-m-d H:i:s', time());
            // TODO: change to the default locale
            $user->{Users::LANGUAGE} = 'nl_nl';

            $success = $user->save();

            if ($success) {
                $this->flash->success("Thanks for registering!");
            } else {
                foreach ($user->getMessages() as $message) {
                    $this->view->error .= '<li>' . $message->getMessage() . "</li>";
                }
            }
        }
    }

}

