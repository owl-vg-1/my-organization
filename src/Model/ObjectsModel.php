<?php

namespace App\Model;

use TexLab\MyDB\DbEntity;

class ObjectsModel extends DbEntity
{

    public function getPage(?int $page = null): array
    {
        $this
        ->reset()
        ->setSelect("`objects`.`id`, `customer`.`сustomer_name`, `objects`.`object_name`, `objects`.`beginning_works`, `objects`.`end_work`, `objects`.`status_objects`, `objects`.`notes`, `status_objects`.`status_objects`")
        ->setFrom("`customer`, `objects`, `status_objects`")
        ->setWhere("`customer`.`id` = `objects`.`id_customer` AND `status_objects`.`id` = `objects`.`status_objects`")
        ->setOrderBy("`objects`.`id`");
        return parent::getPage($page);
    }

    public function searchResults(string $search = null): array
    {
        $this
        ->reset()
        ->setSelect("`objects`.`id`, `customer`.`сustomer_name`, `objects`.`object_name`, `objects`.`beginning_works`, `objects`.`end_work`, `objects`.`status_objects`, `objects`.`notes`, `status_objects`.`status_objects`")
        ->setFrom("`customer`, `objects`, `status_objects`")
        ->setWhere("`customer`.`id` = `objects`.`id_customer` AND `status_objects`.`id` = `objects`.`status_objects` AND `objects`.`object_name` LIKE '%$search%' ")
        ->setOrderBy("`objects`.`id`");
        return $this->get();
    }


}