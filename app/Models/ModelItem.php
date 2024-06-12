<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelItem extends Model
{
    protected $table            = 'item';
    protected $primaryKey       = 'itemid';
    protected $allowedFields    = [
        'itemid', 'itemname', 'itemcatid', 'itemunitid', 'itemprice', 'itemimage', 'itemstock'
    ];

    public function showdata()
    {
        return $this->select('item.*, category.catname as categoryname, unit.unitname as unitname')
            ->join('category', 'category.catid = item.itemcatid')
            ->join('unit', 'unit.unitid = item.itemunitid')
            ->findAll();
    }
}
