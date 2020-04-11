<?php

namespace kernel\models;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use kernel\Application;
use kernel\interfaces\DbModelInterface;

/**
 * Class DbModel
 * @package kernel\models
 */
class DbModel extends Model implements DbModelInterface
{
    /** @var \Doctrine\DBAL\Connection */
    protected $connection;

    /** @var \Doctrine\DBAL\Query\QueryBuilder */
    protected $query;

    /** @var string */
    protected static $tableName;

    /**
     * DbModel constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->connection = Application::$db;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function getQuery(): QueryBuilder
    {
        return $this->connection->createQueryBuilder();
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return static::$tableName;
    }
}
