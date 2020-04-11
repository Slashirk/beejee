<?php

use kernel\Application;

define('ROOTPATH', __DIR__ . '/../');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../kernel/Application.php';

Application::init();
Application::$kernel->launch();