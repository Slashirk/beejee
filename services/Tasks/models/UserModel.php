<?php

namespace services\Tasks\models;

use kernel\models\DbModel;

/**
 * Class UserModel
 * @package models
 * @property $id
 * @property $name
 * @property $email
 */
class UserModel extends DbModel
{
    /** @var string */
    protected static $tableName = 'user';

    /** @var int */
    public $id = null;

    /** @var string */
    public $name = null;

    /** @var string */
    public $email;
}
