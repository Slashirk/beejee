<?php

namespace kernel\models;

/**
 * Class Model
 * @package kernel\models
 */
class Model
{
    /**
     * Model constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->configure($config);
    }

    /**
     * @param array $config
     */
    public function configure(array $config = [])
    {
        foreach ($config as $k => $v) {
            property_exists($this, $k) ? $this->$k = $v : null;
        }
    }
}
