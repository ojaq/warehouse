<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUnit;

class Unit extends BaseController
{
    protected $unit;

    public function __construct()
    {
        $this->unit = new ModelUnit();
    }

    public function index()
    {
        $data = [
            'showdata' => $this->unit->findAll()
        ];
        return view('unit/viewunit', $data);
    }

    public function add()
    {
        return view('unit/add');
    }

    public function save()
    {
        $unitname = $this->request->getVar('unitname');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'unitname' => [
                'rules' => 'required',
                'label' => 'Unit',
                'errors' => [
                    'required' => '{field} cannot be empty!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'errorUnitName' => '<br><div class="alert alert-danger">' . $validation->getError('unitname') . '</div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('unit/add');
        } else {
            $this->unit->insert([
                'unitname' => $unitname
            ]);
            $msg = [
                'success' => '<div class="alert alert-success">Unit saved!</div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('unit/index');
        }
    }
}
