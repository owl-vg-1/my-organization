<?php

namespace App\Model;

use TexLab\MyDB\DbEntity;

class ObjectsModel extends DbEntity
{

    public function getPage(?int $page = null): array
    {
        $this
        ->reset()
        ->setSelect("`objects`.`id`, `objects`.`id_customer`, `objects`.`object_name`, `objects`.`beginning_works`, `objects`.`end_work`, `objects`.`status_objects`, `objects`.`notes`");
        // ->setFrom("`group_workers`, `workers`")
        // ->setWhere("`group_workers`.`id` = `workers`.`group_workers`")
        // ->setOrderBy("`workers`.`id`");
        return parent::getPage($page);
    }


}