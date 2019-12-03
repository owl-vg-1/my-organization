<?php

namespace App\Controller;

use App\Model\UsersModel;
use TexLab\MyDB\DB;
use App\Core\Conf;
use TexLab\MyDB\DbEntity;

class UsersController extends AbstractTableController
{
    protected $tableName = 'workers';
    protected $viewPatternsPath = 'templates/table/';
    protected $pageSize = 3;

    public function __construct()
    {
        parent::__construct();
        $this->table = new UsersModel($this->tableName, DB::Link(Conf::MYSQL));
    }

    public function actionShowEditForm()
    {
        $tableUsersGroup = new DbEntity('group_workers', DB::Link(Conf::MYSQL));

        $this->view->setPatternsPath('templates/usersTable/');

        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'editValues' => $this->table->get(['id' => $_GET['id']])[0],
            'URL' => '?t=' . $this->shortClassName() . '&a=Edit&id=' . $_GET['id'],
            'userGroup' => $tableUsersGroup->getColumn('description'),
            'tableHeaders' => $this->table->getColumnsComments()
        ]);
    }



    public function actionShowAddForm()
    {
        $tableUsersGroup = new DbEntity('group_workers', DB::Link(Conf::MYSQL));

        $this->view->setPatternsPath('templates/usersTable/');

        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'URL' => '?t=' . $this->shortClassName() . '&a=Add',
            'userGroup' => $tableUsersGroup->getColumn('description'),
            'tableHeaders' => $this->table->getColumnsComments()
        ]);
    }

    public function actionAdd()
    {
        $_SESSION['arrError']=[];
       

        //Работает на отсутсвие пустышек
        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                $checkArray[] = $key . " - не введен!";
            }
        }
        // Работает проверка на совпадение логинов
        $checkLoginArray = $this->table->get(["login" => $_POST['login']]);
        if (isset($checkLoginArray[0])) {
            $checkArray[] = "Данный логин занят!";
        }

        // Добавление записи нового пользователя
        if (isset($checkArray)) {
            
            $_SESSION['arrError']=$checkArray;
            $_SESSION['dataNewUser'] = $_POST;
            $this->redirect('?t=' . $this->shortClassName() . '&a=ShowAddForm');

        } else {
            $this->table->add($_POST);
            $_SESSION['dataNewUser']=[];
            $this->redirect('?t=' . $this->shortClassName() . '&a=show');

        }

    }
}
