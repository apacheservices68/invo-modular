<?php
namespace Utils\Modules\Backend;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Utils\common\library\Elements;
use Utils\common\plugins\SecurityPlugin;
use Utils\common\plugins\NotFoundPlugin;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Utils\Modules\Backend\Controllers' => __DIR__ . '/controllers/',
            'Utils\Modules\Backend\Models' => __DIR__ . '/models/',
            'Utils\common\plugins' => APP_PATH . '/common/plugins/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });

        $di->set('elements', function () {
            return new Elements();
        });

        $di->set('dispatcher',function(){
            $eventsManager = new EventsManager;

            /**
             * Check if the user is allowed to access certain action using the SecurityPlugin
             */
            $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

            /**
             * Handle exceptions and not-found exceptions using NotFoundPlugin
             */
            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

            $dispatcher = new Dispatcher;
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}
