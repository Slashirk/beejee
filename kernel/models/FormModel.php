<?php

namespace kernel\models;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;

abstract class FormModel extends Model
{
    /** @var \Symfony\Component\Validator\Validator\ValidatorInterface */
    protected $validator;

    /** @var array */
    protected $errors = [];

    /**
     * @return array
     */
    abstract protected static function rules(): array;

    /**
     * @return array
     */
    abstract protected static function purifierRules(): array;

    /**
     * FormModel constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->purify();
        $this->validator = Validation::createValidator();
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach (static::rules() as $rule) {
            [$field, $params] = $rule;
            $violations = $this->validator->validate($this->$field, $params);

            /** @var $violations ConstraintViolationInterface[] */
            if (0 !== count($violations)) {
                foreach ($violations as $violation) {
                    $this->errors[$field] = $violation->getMessage();
                }
            }
        }

        return $this->errors === [];
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->errors === [];
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getError(string $name): string
    {
        return $this->errors[$name] ?? '';
    }

    /**
     * @param $attribute
     * @param $message
     */
    public function addError($attribute, $message): void
    {
        $this->errors[$attribute] = $message;
    }

    /**
     *  Purifies input
     */
    public function purify(): void
    {
        foreach (static::purifierRules() as $attribute) {
            $this->$attribute = htmlentities($this->$attribute);
        }
    }

}
