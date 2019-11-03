<?php

namespace App\Controller;

class  SiteController extends AbstractController
{
    use AuthTrait;
    public function actionHome()
    {
        $this->render("home", [
            'title' => "Home"
        ]);
    }
}
