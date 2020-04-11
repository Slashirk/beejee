<?php

namespace controllers;

use kernel\Controller;
use services\Auth\models\AuthFormModel;
use services\Auth\services\AuthService;

class AuthController extends Controller
{
    /** @var AuthService  */
    private $authService;

    /**
     * AuthController constructor.
     */
    public function __construct() {
        $this->authService = new AuthService();
    }

    /**
     * @return false|string
     * @throws \Doctrine\DBAL\DBALException
     */
    public function login()
    {
        if (!empty($_POST)) {
            $model = $this->authService->login(new AuthFormModel($_POST));

            if (empty($model->getErrors())) {
                $this->redirect('/');
            }
        }

        return $this->render('login', [
            'model' => $model ?? new AuthFormModel(),
            'isAdmin' => $this->authService->isAdmin()
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->authService->logout();
        $this->redirect('/');
    }
}
