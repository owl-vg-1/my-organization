<?php

namespace App\Controller;

class customerController extends AbstractTableController
{
    protected $tableName = 'customer';
    protected $viewPatternsPath = 'templates/table/';
    protected $pageSize = 5;
}