<?php

namespace services\Auth\repositories;

use kernel\Repository;
use services\Auth\models\AuthModel;

/**
 * Class AuthRepository
 * @package services\Auth\repositories
 */
class AuthRepository extends Repository
{
    protected static $modelClass = AuthModel::class;
}
