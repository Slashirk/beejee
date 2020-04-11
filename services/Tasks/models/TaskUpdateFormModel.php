<?php

namespace services\Tasks\models;

use kernel\models\FormModel;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskUpdateFormModel extends FormModel
{
    public $updated = 0;
    public $description;
    public $state = '0';

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
                'state',
                [
                    new Choice(['0', '1'])
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
            'description'
        ];
    }
}
