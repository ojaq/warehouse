<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCategory extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'catid';
    protected $allowedFields    = ['catid', 'catname'];
}
