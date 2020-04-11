<?php

namespace services\Auth\services;

use services\Auth\models\AuthFormModel;
use services\Auth\repositories\AuthRepository;

class AuthService
{
    const LOGIN    = 'admin1';
    const PASSWORD = '123';

    /** @var AuthRepository */
    private $authRepository;

    /**
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->authRepository = new AuthRepository();
    }

    /**
     * @param AuthFormModel $model
     *
     * @return AuthFormModel
     * @throws \Doctrine\DBAL\DBALException
     */
    public function login(AuthFormModel $model): AuthFormModel
    {
        if ($model->login !== self::LOGIN || $model->password !== self::PASSWORD) {
            $model->addError('login', 'Login or Password are incorrect');
            return $model;
        }

        $this->authRepository->truncate();

        $this->authRepository->insert(['session_id' => session_id()]);

        return $model;
    }

    /**
     * Logout
     */
    public function logout(): void
    {
        session_destroy();
        $this->authRepository->truncate();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return !empty($this->authRepository->findOne(['session_id' => session_id()]));
    }

}
