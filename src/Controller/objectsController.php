<?php

namespace App\Controller;

use App\Model\ObjectsModel;
use App\Model\CustomerModel;
use TexLab\MyDB\DB;
use App\Core\Conf;
use TexLab\MyDB\DbEntity;


class ObjectsController extends AbstractTableController
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
        $this->tableFileObject = new DbEntity('object_file', DB::Link(Conf::MYSQL));


    }

    public function actionShow()
    {
        $page = $_GET['page'] ?? 1;
        $table = $this->table->setPageSize($this->pageSize);
        $this->render("show", [
            'table' => $table->getPage($page),
            'pageCount' => $table->pageCount(),
            'paginationLink' => '?t=' . $this->shortClassName() . '&a=Show&page=',
            'currentPage' => $page,
            'controllerName' => $this->shortClassName(),
            'tableHeaders' => $this->table->getColumnsComments(),
            'searchObjectURL' => '?t=' . $this->shortClassName() . '&a=searchObject',
            'deleteEditAccess' => ($_SESSION['user']['group_workers'] == 'leader' ||
                $_SESSION['user']['group_workers'] == 'worker') ? true : false
        ]);
    }

    public function actionSearchObject()
    {
        print_r($_POST);
        print_r($this->table->get(["objects.object_name"=>"LIKE 'Объект ОАО'"]));

        // $this->redirect('?t=' . $this->shortClassName() . '&a=show');
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
        $tableCostomer = new DbEntity('customer', DB::Link(Conf::MYSQL));
        $this->view->setPatternsPath('templates/objectsTable/');
        
        $this->render("ShowAddEditForm", [
            'columnsNames' => $this->table->getColumnsNames(),
            'URL' => '?t=' . $this->shortClassName() . '&a=Add',
            'costomer' => $tableCostomer->getColumn('сustomer_name'),
            'statusObjects' => $this->tableStatusObjects->getColumn('status_objects'),
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
            'deleteEditAccess' => ($_SESSION['user']['group_workers'] == 'leader' || $_SESSION['user']['group_workers'] == 'worker')? true : false, 
            'controllerName' => $this->shortClassName(),
            'URL' => '?t=' . $this->shortClassName() . '&a=AddFile&id='.$_GET['id'],
            'files' => $this->tableFileObject->get(['id_objects'=>$_GET['id']]),
            'URLDownLoad' => '?t=' . $this->shortClassName() . '&a=DownLoad',
        ]);
    }


    public function actionAddFile() {
        $tmpFile = pathinfo($_FILES['AddFile']['tmp_name']);
        $downloadFile = pathinfo($_FILES['AddFile']['name']);
        // Работает запись из в базу данных имен файла
        $this->tableFileObject->add(['id_objects'=>$_GET['id'], 'tmp_name_file'=>$tmpFile['filename'].'.'.$downloadFile['extension'], 'name_file'=>$_FILES['AddFile']['name']]);
        // Работает загрузка файла в определенную папку со сгенерированным именем
        move_uploaded_file ($_FILES['AddFile']['tmp_name'], Conf::FILE_STORAGE.$tmpFile['filename'].'.'.$downloadFile['extension']);
        $this->redirect('?t=' . $this->shortClassName() . '&a=ShowDetails&id='.$_GET['id']);
    }

    public function actionDownLoad() {

        $fileData = $this->tableFileObject->get(['id' => $_GET['id_file']]);

        $filename = $fileData[0]['name_file'];   // имя файл предложенное для сохранения в окне браузера
        $myFile = $_SERVER['DOCUMENT_ROOT'].'/fileStorage/'.$fileData[0]['tmp_name_file']; // файл на серевере
        $mm_type="application/octet-stream";

        header("Cache-Control: public, must-revalidate"); // кешировать
        header("Pragma: hack");
        header("Content-Type: " . $mm_type);
        header("Content-Length: " .(string)(filesize($myFile)) );
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header("Content-Transfer-Encoding: binary");

        readfile($myFile); // прочитать файл и отправить в поток
    }

    public function actionDelete()
    {
        $filesData = $this->tableFileObject->get(['id_objects' => $_GET['id']]);
        
        // Работает удаление записей о фалах из БД
        $this->tableFileObject->del(['id_objects' => $_GET['id']]);

        // Работает Удаление файлов из папки
        foreach ($filesData as $file) {
            foreach ($file as $key => $fileName) {
                if ($key == 'tmp_name_file') {
                    if (file_exists(Conf::FILE_STORAGE.$fileName)) {
                        unlink(Conf::FILE_STORAGE.$fileName);
                    }
                }
            }
        }
       
        //работает удаление записи в таблице объекта 
        $this->table->del(['id' => $_GET['id']]);
        $this->redirect('?t=' . $this->shortClassName() . '&a=show');
    }



}