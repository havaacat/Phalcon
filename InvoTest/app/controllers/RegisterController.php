<?php
/**
 * Created by PhpStorm.
 * User: zhixin
 * Date: 2015/11/10
 * Time: 18:57
 */
class RegisterController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTittle('Sign Up/Sign In');
        parent::initialize();
    }

    /**
     *  Action to register a new user
     */
    public function indexAction()
    {
        $form = new RegisterForm;

        if($this->request->isPost()){
            $name = $this->request->getPost('name', array('string','striptags'));
            $username = $this->request->getPost('username','alphanum');
            $email = $this->request->getPost('email','email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');

            if($password != $repeatPassword){
                $this->flash->error('Passwords are different');
                return false;
            }

            $user = new Users();
            $user->username = $username;
            $user->password = $sha1($password);
            $user->name = $name;
            $user->email = $email;
            $user->create_at = new Phalcon\Db\RawValue('now()');
            $user->active = 'Y';
            if($user->save() == flase){
                foreach($user->getMessage() as $message){
                    $this->flash->error((string) $message);
                }
            }else{
                $this->tag->setDefault('email','');
                $this->tag->setDefault('password','');
                $this->tag->setDefault('Thanks for sign-up,please log-in to start generating invoices');
                return $this->forward('session/index');
            }
        }
        $this->view->form = $form;
    }
}