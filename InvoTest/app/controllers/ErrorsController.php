<?php
/**
 * Created by PhpStorm.
 * User: zhixin
 * Date: 2015/11/10
 * Time: 18:54
 */
class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTittle('Oops!');
        parent::initialize();
    }

    public function show404Action()
    {

    }

    public function show401Action()
    {

    }

    public function show500Action()
    {

    }
}