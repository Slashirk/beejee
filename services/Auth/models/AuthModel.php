<?php

namespace services\Auth\models;

use kernel\models\DbModel;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class AuthModel
 * @package services\Auth\models
 * @property $session_id
 */
class AuthModel extends DbModel
{
    /** @var string */
    protected static $tableName = 'auth';

    /** @var string */
    public $session_id;
}
