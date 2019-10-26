<?php

namespace App\Controller;

class statusObjectsController extends AbstractTableController
{
    protected $tableName = 'status_objects';
    protected $viewPatternsPath = 'templates/table/';
    protected $pageSize = 10;
}