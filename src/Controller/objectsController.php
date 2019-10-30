<?php

namespace App\Controller;

use App\Model\ObjectsModel;
use App\Model\CustomerModel;
use TexLab\MyDB\DB;
use App\Core\Conf;
use TexLab\MyDB\DbEntity;


class objectsController extends AbstractTableController
{
    protected $tableName = 'objects';
    protected $tableNameCustomer = 'customer';
    protected $viewPatternsPath = 'templates/objectsTable/';
    protected $pageSize = 3;
    
    public function __construct()
    {
        parent::__construct();
        $this->table = new ObjectsModel($this->tableName, DB::Link(Conf::MYSQL));
        $this->tableCustomer = new CustomerModel($this->tableNameCustomer, DB::Link(Conf::MYSQL));
        $this->tableStatusObjects = new DbEntity('status_objects', DB::Link(Conf::MYSQL));

    }

    public function actionShowEditForm()
    {
        $tableCostomer = new DbEntity('customer', DB::Link(Conf::MYSQL));

        $this->view->setPatternsPath('templates/objectsTable/');

        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'editValues' => $this->table->get(['id' => $_GET['id']])[0],
            'URL' => '?t=' . $this->shortClassName() . '&a=Edit&id=' . $_GET['id'],
            'costomer' => $tableCostomer->getColumn('сustomer_name'),
            'statusObjects' => $this->tableStatusObjects->getColumn('status_objects'),
            'tableHeaders' => $this->table->getColumnsComments()
        ]);
    }


    public function actionShowAddForm()
    {
        // $tableStatusObjects = new DbEntity('status_objects', DB::Link(Conf::MYSQL));

        $this->view->setPatternsPath('templates/objectsTable/');
        
        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'URL' => '?t=' . $this->shortClassName() . '&a=Add',
            'costomer' => $this->tableCostomer->getColumn('сustomer_name'),
            'statusObjects' => $tableStatusObjects->getColumn('status_objects'),
            'tableHeaders' => $this->table->getColumnsComments()
        ]);
    }

    public function actionShowDetails()
    {
        $this->view->setPatternsPath('templates/objectsTable/');
        $detailsObject = $this->table->get(['id'=>$_GET['id']]);

        $this->render("showDetails", [
            'objectInfo' => $detailsObject,
            'objectHeaders' => $this->table->getColumnsComments(),
            'customerInfo' => $this->tableCustomer->get(['id'=>$detailsObject[0]['id_customer']]),
            'customerHeaders' => $this->tableCustomer->getColumnsComments(),
            'statusObjectsInfo' => $this->tableStatusObjects->get(['id'=>$detailsObject[0]['status_objects']]),
            'statusObjectsHeaders' => $this->tableStatusObjects->getColumnsComments(),

            // 'URL' => '?t=' . $this->shortClassName() . '&a=Add',

            // 'table' => $table->getPage($page),
            // 'pageCount' => $table->pageCount(),
            // 'paginationLink' => '?t=' . $this->shortClassName() . '&a=Show&page=',
            // 'controllerName' => $this->shortClassName(),
            // 'tableHeaders' => $this->table->getColumnsComments(),
            // 'deleteEditAccess' => ($_SESSION['user']['group_workers'] == 'leader' || $_SESSION['user']['group_workers'] == 'worker')? true : false 
        ]);
    }



}