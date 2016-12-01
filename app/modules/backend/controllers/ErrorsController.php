<?php
/**
 * Created by PhpStorm.
 * User: Vinh Banh <apacheservices68@gmail.com>
 * Version: 1.0
 * Date: 29/11/2016
 * Time: 16:59
 */

namespace Utils\Modules\Backend\Controllers;


class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Oops!');
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