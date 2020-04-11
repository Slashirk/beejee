<?php

namespace helpers;

use kernel\interfaces\DbModelInterface;
use kernel\models\Model;

class ModelHelper
{
    /**
     * @param $model
     *
     * @return array
     */
    public static function toArray($model): array
    {
        return get_object_vars($model);
    }
}
