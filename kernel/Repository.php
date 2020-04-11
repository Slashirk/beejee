<?php

namespace kernel;

use Doctrine\DBAL\Query\QueryBuilder;
use kernel\interfaces\DbModelInterface;

class Repository
{
    /** @var DbModelInterface */
    protected static $modelClass;

    /** @var DbModelInterface */
    protected $model;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->model = $this->add();
    }

    /**
     * @param array $attributes
     *
     * @return DbModelInterface
     * @throws \Doctrine\DBAL\DBALException
     */
    public function insert(array $attributes = []): DbModelInterface
    {
        $this->model->getConnection()->insert($this->model->tableName(), $attributes);

        return $this->findOne($this->model->getConnection()->lastInsertId());
    }

    /**
     * @param null $condition
     */
    public function delete($condition = null): void
    {
        $query = $this->model->getQuery()->delete($this->model->tableName());
        $query = $this->buildCondition($query, $condition);
        $query->execute();
    }

    /**
     * @param null  $condition
     * @param array $attributes
     */
    public function update($condition = null, array $attributes = []): void
    {
        $query = $this->model->getQuery()->update($this->model->tableName());
        $query = $this->buildCondition($query, $condition);

        foreach ($attributes as $k => $v) {
            $query->set($k, ":$k");
            $query->setParameter($k, $v);
        }

        $query->execute();
    }

    /**
     * @param null $condition
     *
     * @return DbModelInterface|null
     */
    public function findOne($condition = null): ?DbModelInterface
    {
        $query = $this->model->getQuery()->select('*')->from($this->model->tableName());
        $query = $this->buildCondition($query, $condition);
        $row = $query->execute()->fetch();

        return $row ? $this->add($row) : null;
    }

    /**
     * @param null $condition
     *
     * @return array
     */
    public function findAll($condition = null): array
    {
        $query = $this->model->getQuery()->select('*')->from($this->model->tableName());
        $query = $this->buildCondition($query, $condition);
        $rows = $query->execute()->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            $result[] = $this->add($row);
        }

        return $result;
    }

    /**
     * Truncate
     */
    public function truncate(): void
    {
        $this->model->getQuery()->delete($this->model->tableName())->execute();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return (int)$this->model->getQuery()
            ->select('COUNT(*)')
            ->from($this->model->tableName())
            ->execute()
            ->fetchColumn();
    }

    /**
     * @param array $config
     *
     * @return DbModelInterface
     */
    public function add(array $config = []): DbModelInterface
    {
        return new static::$modelClass($config);
    }

    /**
     * @param QueryBuilder $query
     * @param null         $condition
     *
     * @return QueryBuilder
     */
    private function buildCondition(QueryBuilder $query, $condition = null)
    {
        if (is_numeric($condition)) {
            $query->where('id=:id');
            $query->setParameter('id', $condition);
        }

        if (is_array($condition)) {
            foreach ($condition as $k => $v) {
                $query->andWhere("$k = :$k");
                $query->setParameter($k, $v);
            }
        }

        return $query;
    }
}
