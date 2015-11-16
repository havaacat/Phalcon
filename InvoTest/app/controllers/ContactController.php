<?php
/**
 * Created by PhpStorm.
 * User: zhixin
 * Date: 2015/11/10
 * Time: 19:20
 */

/**
 * ContactController
 *
 * Allows to contact the staff using a contact form
 */
class ContactController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Contact us');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->form = new ContactForm;
    }

    /**
     *  Saves the contact infomation in the database
     */
    public function sendAction()
    {
        if($this->request->isPost() != true){
            return $this->forword('contact/index');
        }

        $form = new ContactForm;
        $contact = new Contact();

        //Validate the form
        $data = $this->request->getPost();
        if(!$form->isValid($data, $contact)){
            foreach($form->getMessage() as $message){
                $this->flash->error($message);
            }
            return $this->forward('contact/index');
        }

        if($contact->save() == false){
            foreach($contact->getMessage() as $message){
                $this->flash->error($message);
            }
            return $this->forward('contact/index');
        }

        $this->flash->successs('Thanks, we will contact you in the next few hours');
        return $this->forwar('index/index');
    }

}