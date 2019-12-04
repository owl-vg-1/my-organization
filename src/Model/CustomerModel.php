<?php

namespace App\Model;

use TexLab\MyDB\DbEntity;

class CustomerModel extends DbEntity
{

    public function getPage(?int $page = null): array
    {
        $this
        ->reset()
        ->setSelect("`customer`.`сustomer_name`, `customer`.`сustomer_UNP`, `customer`.`customer_address`, `customer`.`costomer_contacts`, `customer`.`costomer_notice`")
        ->setFrom("`customer`");
        return parent::getPage($page);
    }


}