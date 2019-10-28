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

    public function actionShowEditForm()
    {
        $tableCostomer = new DbEntity('customer', DB::Link(Conf::MYSQL));
        $tableStatusObjects = new DbEntity('status_objects', DB::Link(Conf::MYSQL));

        $this->view->setPatternsPath('templates/objectsTable/');

        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'editValues' => $this->table->get(['id' => $_GET['id']])[0],
            'URL' => '?t=' . $this->shortClassName() . '&a=Edit&id=' . $_GET['id'],
            'costomer' => $tableCostomer->getColumn('сustomer_name'),
            'statusObjects' => $tableStatusObjects->getColumn('status_objects'),
            'tableHeaders' => $this->table->getColumnsComments()
        ]);
    }



    public function actionShowAddForm()
    {
        $tableCostomer = new DbEntity('customer', DB::Link(Conf::MYSQL));
        $tableStatusObjects = new DbEntity('status_objects', DB::Link(Conf::MYSQL));

        $this->view->setPatternsPath('templates/objectsTable/');
        
        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'URL' => '?t=' . $this->shortClassName() . '&a=Add',
            'costomer' => $tableCostomer->getColumn('сustomer_name'),
            'statusObjects' => $tableStatusObjects->getColumn('status_objects'),
            'tableHeaders' => $this->table->getColumnsComments()
        ]);
    }


}