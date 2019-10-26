<?php

namespace App\Model;

use TexLab\MyDB\DbEntity;

class UsersModel extends DbEntity
{

    public function getPage(?int $page = null): array
    {
        $this
        ->reset()
        ->setSelect("`workers`.`id`, `workers`.`name`, `workers`.`surname`, `workers`.`login`, `workers`.`password`, `group_workers`.`description`")
        ->setFrom("`group_workers`, `workers`")
        ->setWhere("`group_workers`.`id` = `workers`.`group_workers`")
        ->setOrderBy("`workers`.`id`");
        return parent::getPage($page);
    }


}