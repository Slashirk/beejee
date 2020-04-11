<?php

namespace services\Auth\models;

use kernel\models\FormModel;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthFormModel extends FormModel
{
    /** @var string */
    public $login;

    /** @var string */
    public $password;

    /**
     * @return array
     */
    protected static function rules(): array
    {
        return [
            [
                'login',
                [
                    new NotBlank()
                ]
            ],
            [
                'password',
                [
                    new NotBlank()
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    protected static function purifierRules(): array
    {
        return [];
    }
}
