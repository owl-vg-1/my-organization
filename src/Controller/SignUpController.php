<?php

namespace App\Controller;

use App\Core\Auth;
use App\Model\UsersModel;
use TexLab\MyDB\DB;
use App\Core\Conf;
use TexLab\MyDB\DbEntity;
use TexLab\MyDB\Table;

class SignUpController extends AbstractController
{
    protected $viewPatternsPath = 'templates/signup/';

    public function actionShowForm()
    {
        $newSignUpDate = $_SESSION['checkSignUpData']['Data'] ?? [];
        $signUpErrors = $_SESSION['checkSignUpData']['Errors'] ?? [];

        unset($_SESSION['checkSignUpData']);

        $this->render("showForm", [
            'SignUpURL' => '?t=' . $this->shortClassName() . '&a=registerUser',
            'newSignUpDate' => $newSignUpDate,
            'signUpErrors' => $signUpErrors,
        ]);
    }
    public function actionRegisterUser()
    {
        if ($this->checkRegisterData($_POST)) {
            $_SESSION['checkSignUpData']['Data'] = $_POST;
            $this->redirect('?t=' . $this->shortClassName() . '&a=showform');
        }

        $userGroupId = (new Table('group_workers', DB::Link(Conf::MYSQL)))->get(['group_workers' => 'user'])[0]['id'];

        (new Table('workers', DB::Link(Conf::MYSQL)))->add([
            "name" => $_POST["name"],
            "surname" => $_POST["surname"],
            "login" => $_POST["login"],
            "password" => $_POST["pass"],
            "group_workers" => $userGroupId
        ]);

        Auth::registerUser($_POST["login"], $_POST["pass"]);

        $this->redirect('?a=home');
    }

    private function checkRegisterData($data)
    {
        if ($data['pass'] != $data['passrepeat']) {
            $_SESSION['checkSignUpData']['Errors'][] = "Пароли не совпадают";
        }

        if (empty($data['name'])) {
            $_SESSION['checkSignUpData']['Errors'][] = "Введите имя";
        }

        if (empty($data['surname'])) {
            $_SESSION['checkSignUpData']['Errors'][] = "Введите фамилию";
        }

        if (empty($data['pass'])) {
            $_SESSION['checkSignUpData']['Errors'][] = "Введите пароль";
        }

        if (empty($data['login'])) {
            $_SESSION['checkSignUpData']['Errors'][] = "Введите логин";
        }

        if (!empty((new Table('workers', DB::Link(Conf::MYSQL)))->get(['login'=> $data['login']]))) {
            $_SESSION['checkSignUpData']['Errors'][] = "Этот логин занят!";
        }

        if (empty($_SESSION['checkSignUpData'])) {
            return false;
        } else {
            return true;
        }
    }
}
