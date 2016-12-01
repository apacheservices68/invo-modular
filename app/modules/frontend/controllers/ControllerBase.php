<?php
namespace Utils\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle('INVO web | ');
        $this->view->setTemplateAfter('main');
    }
}
