<?php

namespace services\Tasks\repositories;

use kernel\Repository;
use services\Tasks\models\UserModel;

class UsersRepository extends Repository
{
    protected static $modelClass = UserModel::class;
}
