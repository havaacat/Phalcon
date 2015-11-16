<?php
/**
 * Created by PhpStorm.
 * User: zhixin
 * Date: 2015/11/10
 * Time: 18:52
 */

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTittle('About us');
        parent::initialize();
    }

    public function indexAction()
    {

    }
}