<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01/12/2016
 * Time: 14:37
 */

namespace Utils\Modules\Frontend\Controllers;

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('About us');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}