<?php

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTittle('Sign UP/Sign In');
        parent::initialize();
    }

    public function indexAction()
    {
        if(!$this->request->isPost()){
            $this->tag->setDefault('email','demo@phalconphp.com');
            $this->tag->setDefault('password','phalcon');
        }
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $users)
    {
        $this->session->set('auth', array(
            'id'   => $user->id,
            'name' => $user->name
        ));
    }

    /**
     * This action authenicate and logs an user into the application
     *
     */
    public function startAction()
    {
        if($this->request->isPost()){
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = Users::findFirst(array(
                "(email = :email: OR username = :email) AND password = :password: AND active = 'Y'",
                'bind' => array('email' => $email, 'password' => sha1($password))
            ));
            if($user != false){
                $this->_registerSession($user);
                $this->flash->success('Welcome'.$user->name);
                return $this->forword('invoices/index');
            }
            $this->flash->error("Wrong email/password");
        }
        return $this->forward('session/index');
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unkown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye');
        return $this->forward('index/index');
    }
}


?>