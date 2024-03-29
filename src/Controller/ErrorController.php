<?php

namespace App\Controller;

use App\Core\Conf;

class ErrorController extends AbstractController
{
    public $viewLayout = Conf::DEFAULT_PLAIN_LAYOUT;
    public function forbiddenController()
    {
        $this->accessDenied();
        $this->render("error", [
            'text' => 'У Вас нету прав для этого действия!'
        ]);
        exit();
    }
    public function notFoundError($text)
    {
        $this->notFound();
        $this->render("error", [
            'text' => $text
        ]);
        exit();
    }
}
