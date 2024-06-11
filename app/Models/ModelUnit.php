<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUnit extends Model
{
    protected $table            = 'unit';
    protected $primaryKey       = 'unitid';
    protected $allowedFields    = ['unitid', 'unitname'];
}
