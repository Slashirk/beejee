<?php

namespace services\Tasks\repositories;

use kernel\Repository;
use services\Tasks\models\TaskModel;

class TasksRepository extends Repository
{
    protected static $modelClass = TaskModel::class;

    /**
     * @param int   $limit
     * @param int   $offset
     * @param array $sort
     *
     * @return array
     */
    public function getList($limit = 1, $offset = 0, array $sort = []): array
    {
        $query = $this->model->getQuery()
            ->from($this->model->tableName())
            ->select([
                'task.id',
                'task.user_id',
                'task.description',
                'task.state',
                'task.updated',
                'u.name',
                'u.email'
            ])
            ->leftJoin($this->model->tableName(), 'user', 'u', 'u.id = task.user_id')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        if (!empty($sort)) {
            [$field, $direction] = $sort;
            $query->orderBy($field, $direction);
        } else {
            $query->orderBy('id', 'asc');
        }

        return $query->execute()->fetchAll();
    }
}
