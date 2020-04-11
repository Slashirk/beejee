<?php

namespace services\Tasks\models;

use kernel\models\FormModel;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskCreateFormModel extends FormModel
{
    public $description;
    public $email;
    public $name;

    /**
     * @return array
     */
    protected static function rules(): array
    {
        return [
            [
                'description',
                [
                    new NotBlank()
                ]
            ],
            [
                'name',
                [
                    new NotBlank(),
                    new Length(['max' => 128])
                ]
            ],
            [
                'email',
                [
                    new Email(),
                    new NotBlank(),
                    new Length(['max' => 128])
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    protected static function purifierRules(): array
    {
        return [
            'description',
            'name',
            'email'
        ];
    }
}
