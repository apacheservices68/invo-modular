<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Utils\Models'             => APP_PATH . '/common/models/',
    'Utils\common\library'     => APP_PATH . '/common/library/',
    'Utils\common\plugins'     => APP_PATH . '/common/plugins/',
]);

/**
 * Register module classes and base service locator
 */
$loader->registerClasses([
    'Utils\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Utils\Modules\Backend\Module'  => APP_PATH . '/modules/backend/Module.php',
    'Utils\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php',
    'Elements'                      => APP_PATH . '/common/library/Elements.php',
]);

/*$loader->registerDirs([
    $config->application->libraryDir,
])->register();*/


$loader->register();
