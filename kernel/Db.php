<?php

namespace kernel;

use Doctrine\DBAL\DriverManager;

/**
 * Class Db
 * @package kernel
 */
final class Db
{
    private static $instance = null;

    /**
     * @return \Doctrine\DBAL\Connection|null
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            $config = include ROOTPATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';
            self::$instance = DriverManager::getConnection($config['db']);
        }

        return self::$instance;
    }

    private function __construct() { }

    private function __clone() { }

    private function __wakeup() { }
}
