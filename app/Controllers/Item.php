<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Item extends BaseController
{
    public function index()
    {
        return view('item/viewitem');
    }
}
