<?php

namespace App\Controller;

use App\Model\ObjectsModel;
use TexLab\MyDB\DB;
use App\Core\Conf;
use TexLab\MyDB\DbEntity;

class objectsController extends AbstractTableController
{
    protected $tableName = 'objects';
    protected $viewPatternsPath = 'templates/table/';
    protected $pageSize = 3;
    
    public function __construct()
    {
        parent::__construct();
        $this->table = new ObjectsModel($this->tableName, DB::Link(Conf::MYSQL));
    }

    // public function actionShowEditForm()
    // {
    //     $tableUsersGroup = new DbEntity('group_workers', DB::Link(Conf::MYSQL));

    //     $this->view->setPatternsPath('templates/usersTable/');

    //     $this->render("ShowAddEditForm", [
    //         'columnsNames' => $this->table->getColumnsNames(),
    //         'editValues' => $this->table->get(['id' => $_GET['id']])[0],
    //         'URL' => '?t=' . $this->shortClassName() . '&a=Edit&id=' . $_GET['id'],
    //         'userGroup' => $tableUsersGroup->getColumn('description'),
    //         'tableHeaders' => $this->table->getColumnsComments()
    //     ]);
    // }



    // public function actionShowAddForm()
    // {
    //     $tableUsersGroup = new DbEntity('group_workers', DB::Link(Conf::MYSQL));

    //     $this->view->setPatternsPath('templates/usersTable/');
        
    //     $this->render("ShowAddEditForm", [
    //         'columnsNames' => $this->table->getColumnsNames(),
    //         'URL' => '?t=' . $this->shortClassName() . '&a=Add',
    //         'userGroup' => $tableUsersGroup->getColumn('description'),
    //         'tableHeaders' => $this->table->getColumnsComments()
    //     ]);
    // }


}