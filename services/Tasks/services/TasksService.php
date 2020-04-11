<?php

namespace services\Tasks\services;

use helpers\ModelHelper;
use kernel\exceptions\UnprocessableEntityException;
use kernel\interfaces\DbModelInterface;
use services\Tasks\models\TaskModel;
use services\Tasks\models\UserModel;
use services\Tasks\repositories\TasksRepository;
use services\Tasks\repositories\UsersRepository;

class TasksService
{
    /** @var UsersRepository */
    private $usersRepository;

    /** @var TasksRepository */
    private $tasksRepository;

    /**
     * TasksService constructor.
     */
    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
        $this->tasksRepository = new TasksRepository();
    }

    /**
     * @param null $condition
     *
     * @return \kernel\interfaces\DbModelInterface|null
     */
    public function findOne($condition = null): ?DbModelInterface
    {
        return $this->tasksRepository->findOne($condition);
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws UnprocessableEntityException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function add(array $payload = []): array
    {
        /** @var UserModel $user */
        $user = $this->usersRepository->findOne($payload['email'])
            ?? $this->usersRepository->insert(ModelHelper::toArray($this->usersRepository->add($payload)));

        $payload['user_id'] = $user->id;

        /** @var TaskModel $task */
        $task = $this->tasksRepository->insert(ModelHelper::toArray($this->tasksRepository->add($payload)));

        return [
            'name'        => $user->name,
            'email'       => $user->email,
            'description' => $task->description,
            'state'       => $task->state,
        ];
    }

    /**
     * @param null  $condition
     * @param array $payload
     *
     * @return TaskModel
     */
    public function update($condition = null, array $payload = []): void
    {
        $this->tasksRepository->update($condition, $payload);
    }

    /**
     * @param int   $limit
     * @param int   $offset
     * @param array $sort
     *
     * @return array
     */
    public function getList($limit = 1, $offset = 0, array $sort = [])
    {
        return $this->tasksRepository->getList($limit, $offset, $sort);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->tasksRepository->count();
    }
}
