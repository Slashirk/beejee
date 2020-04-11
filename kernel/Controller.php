<?php

namespace kernel;

/**
 * Class Controller
 * @package kernel
 */
class Controller
{
    /** @var string */
    public $layoutFile = '/views/layouts/index.php';

    public $viewPath = '/views/';

    /**
     * @param $body
     *
     * @return false|string
     */
    public function renderLayout(string $body = '', array $params = [])
    {
        extract($params);

        ob_start();
        require ROOTPATH . $this->layoutFile;

        return ob_get_clean();
    }

    /**
     * @param       $viewName
     * @param array $params
     *
     * @return false|string
     */
    public function render($viewName, array $params = [])
    {
        $viewFile = ROOTPATH . $this->viewPath . $viewName . '.php';

        extract($params);

        ob_start();
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();

        return $this->renderLayout($body, $params);
    }

    public function redirect(string $path)
    {
        header('Location: ' . $path);
        exit();
    }
}
