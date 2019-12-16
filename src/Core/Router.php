<?php

namespace App\Core;

use App\Controller\ErrorController;
use Texlab\Route\Dispatcher;

class Router
{
    public $controllerName;
    public $actionName;
    public $url;
    public function __construct()
    {
        $this->dispatcher = new Dispatcher([
            '/home' => 'site/home',
            '/about' => 'site/about',
        ]);
        $decodeUri = $this->dispatcher->decodeUri($_SERVER['REQUEST_URI']);
        if (!empty($decodeUri['handler'])) {
            $handler = explode('/', $decodeUri['handler']);
            $_GET["t"] = $handler[0];
            $_GET["a"] = $handler[1];
        }
        $this->controllerName = ($_GET["t"] ?? Conf::DEFAULT_CONTROLLER) . 'Controller';
        $this->actionName = 'action' . ($_GET["a"] ?? Conf::DEFAULT_ACTION);
    }
    public function run()
    {
       if (Auth::checkControllerPermit($this->controllerName)) {
            $className = "App\\Controller\\{$this->controllerName}";
            if (class_exists($className)) {
                $MVC = new $className();
                if (method_exists($MVC, $this->actionName)) {
                    $MVC->{$this->actionName}();
                } else {
                    // echo "нет такого метода: $this->methodName";
                    (new ErrorController())->notFoundError("Not Found Action: {$this->actionName}");
                }
            } else {
                            //    echo "нет такого класса: $this->controllerName";
                (new ErrorController())->notFoundError("Not Found Controller: {$this->controllerName}");
            }
        } else {
            // echo "ошибка доступа";
            (new ErrorController())->forbiddenController();
        }
    }
}
