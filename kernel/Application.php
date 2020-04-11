<?php

namespace kernel;

use Doctrine\DBAL\Connection;
use kernel\exceptions\InvalidRouteException;

class Application
{
    /** @var Connection */
    public static $db;

    /** @var Router */
    public static $router;

    /** @var Kernel */
    public static $kernel;

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function init()
    {
        session_start();
        spl_autoload_register(['static', 'loadClass']);
        static::bootstrap();
        set_exception_handler(['kernel\Application', 'handleException']);
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function bootstrap()
    {
        static::$router = new Router();
        static::$kernel = new Kernel();
        static::$db = Db::getInstance();
    }

    /**
     * @param $className
     */
    public static function loadClass($className)
    {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH . DIRECTORY_SEPARATOR . $className . '.php';
    }

    public function handleException(\Throwable $e)
    {
        echo "<pre>";
        print_r($e);
        echo "</pre>";
        die;
    }

}
