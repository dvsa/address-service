<?php
/**
 * Test bootstrap, for setting up autoloading
 */
namespace Test;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    protected static $serviceManager;

    public static function init()
    {
        chdir(__DIR__ . '/../../');
        // Setup the autloader
        static::initAutoloader();

        // Grab the application config
        $config = include __DIR__ . '/../../' . '/config/application.config.php';

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    protected static function initAutoloader()
    {
        require( __DIR__ . '/../../' . '/init_autoloader.php');
    }
}

Bootstrap::init();
