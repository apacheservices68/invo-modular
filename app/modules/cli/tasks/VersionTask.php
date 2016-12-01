<?php
namespace Utils\Modules\Cli\Tasks;

class VersionTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        $config = $this->getDI()->get('config');

        echo $config['version'];
    }

    public function modulesAction(){
        $config = $this->getDI();
        var_dump($config);
    }

}
