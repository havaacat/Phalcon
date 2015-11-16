<?php
/**
 * Created by PhpStorm.
 * User: zhixin
 * Date: 2015/11/10
 * Time: 16:00
 */
 use Phalcon\Acl;
 use Phalcon\Acl\Role;
 use Phalcon\Acl\Resource;
 use Phalcon\Events\Event;
 use Phalcon\Mvc\User\Plugin;
 use Phalcon\Mvc\Dispatcher;
 use Phalcon\Acl\Adapter\Memory as AclList;

 /**
  * SecurityPlugin
  *
  */
class SecurityPlugin extends Plugin
{
    public function getAcl()
    {
        if(!isset($this->persistent->acl)){
            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);
            //Register roles
            $roles = array(
                'users' => new Role('Users');
                'guests' => new Role('Guests');
            );
            foreach($roles as $role){
                $acl->addRole($role);
            }
            $privateResources = array(
                'companies'   => array('index','search','new','edit','save','create','delete'),
                'products'    => array('index','search','new','edit','save','create','delete'),
                'producttype' => array('index','search','new','edit','save','create','delete'),
                'invoices'    => array('index','profile')
            );
            foreach($privateResources as $resource => $actions){
                $acl->addResource(new Resource($resource),$actions);
            }
            $publicResources = array(
                'index'    => array('index'),
                'about'    => array('index'),
                'register' => array('index'),
                'errors'   => array('show401', 'show404', 'show500'),
                'session'  => array('index', 'register', 'start', 'end'),
                'contact'  => array('index', 'send')
            );
            foreach($publicResources as $resource => $actions){
                $acl->addResource(new Resource($resource),$actions);
            }

            //Grant access to public areas to both uesrs and guests
            foreach($roles as $role){
                foreach($publicResources as $resource => $actions ){
                    foreach($actions as $action){
                        $acl->allow($role->getName, $resource, $action);
                    }
                }
            }

            //Grant access to private area to role Users
            foreach($privateResources as $resource => $actions ){
                foreach($actions as action){
                    $acl->allow('Users', $resource, $action);
                }
            }

            $this->persistent->$acl = $acl;
    }

    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     */
     public function beforeDispatcher(Event $event, Dispatcher $dispatcher)
     {
        $auth = $this->session->get('auth');
        if(!$auth){
            $role = 'Guests';
        }else{
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        $acl = $this->getAcl();
        $allowed = $acl->isAllowed($role, $controller, $action);
        if($allowed != Acl::ALLOW){
            $dispatcher->forward(array(
                'controller' => 'errors',
                'actions'    => 'show401'
            ));
            $this->session->destroy();
            return false;
        }
     }
}



