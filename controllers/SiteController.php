<?php

namespace controllers;

use helpers\ModelHelper;
use helpers\UrlHelper;
use kernel\Controller;
use services\Auth\services\AuthService;
use services\Tasks\models\TaskCreateFormModel;
use services\Tasks\models\TaskModel;
use services\Tasks\models\TaskUpdateFormModel;
use services\Tasks\services\TasksService;
use voku\helper\Paginator;

class SiteController extends Controller
{
    /** @var TasksService */
    private $tasksService;

    /** @var AuthService */
    private $authService;

    /**
     * SiteController constructor.
     */
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->tasksService = new TasksService();
    }

    /**
     * @return false|string
     * @throws \Doctrine\DBAL\DBALException
     * @throws \kernel\exceptions\UnprocessableEntityException
     */
    public function index()
    {
        // Save Logic
        $success = false;
        $request = new TaskCreateFormModel($_POST);

        if (!empty($_POST) && $request->validate()) {
            $this->tasksService->add(ModelHelper::toArray($request));
            $request = new TaskCreateFormModel();
            $success = true;
        }

        // Pagination
        $pagination = new Paginator(3, 'page');
        $pagination->set_total($this->tasksService->getCount());

        // Tasks and sorts
        $sorts = UrlHelper::getSorts();
        [$offset, $limit] = $pagination->get_limit_raw();
        $tasks = $this->tasksService->getList($limit, $offset, $sorts);

        return $this->render(
            'index',
            [
                'model'      => $request,
                'tasks'      => $tasks,
                'pagination' => $pagination,
                'success'    => $success,
                'sorts'      => $sorts,
                'isAdmin'    => $this->authService->isAdmin()
            ]
        );
    }

    /**
     * @return false|string
     */
    public function update()
    {
        if (!$this->authService->isAdmin()) {
            $this->redirect('/auth/login');
        }

        /** @var $model TaskModel */
        if (empty($model = $this->tasksService->findOne($_GET['id']))) {
            $this->redirect('/');
        }

        if (empty($_POST)) {
            $request = new TaskUpdateFormModel(ModelHelper::toArray($model));
        } else {
            $request = new TaskUpdateFormModel($_POST);
            if ($request->validate()) {
                if ($model->description !== $request->description) {
                    $request->updated = 1;
                }
                $this->tasksService->update(['id' => $_GET['id']], ModelHelper::toArray($request));
                $this->redirect('/');
            }

        }

        return $this->render('update', ['model' => $request, 'isAdmin' => true]);
    }
}
