<?php

namespace services\Tasks\models;

use kernel\models\DbModel;

/**
 * Class TaskModel
 * @package services\Tasks\models
 * @property $description
 * @property $user_id
 */
class TaskModel extends DbModel
{
    /** @var string */
    public static $tableName = 'task';

    /** @var int */
    public $id;

    /** @var int */
    public $user_id;

    /** @var string */
    public $description;

    /** @var null */
    public $state = 0;

    /** @var int  */
    public $updated = 0;
}
