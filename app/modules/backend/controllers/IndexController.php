<?php

namespace Utils\Modules\Backend\Controllers;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        #var_dump($this->getDI()->get('db'));die;
    }

    public function testAction(){
        echo "abc";
    }

}

