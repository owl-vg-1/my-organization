<?php

namespace App\Model;

use TexLab\MyDB\Runner;

class AuthModel extends Runner
{

    public function getUserData(string $login, string $pass) : ?array
    {

$sql = <<<SQL
SELECT workers.name, workers.surname, workers.login, workers.password, group_workers.group_workers, group_workers.description 
FROM `workers`,`group_workers` 
WHERE group_workers.id = workers.group_workers AND workers.login = '$login' AND workers.password = '$pass';
SQL;

        return $this->runSQL($sql)[0];
    }
}