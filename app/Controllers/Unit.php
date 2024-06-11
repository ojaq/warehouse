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
        $searchbutton = $this->request->getPost('searchbutton');
        if (isset($searchbutton)) {
            $search = $this->request->getPost('search');
            session()->set('search_unit', $search);
            redirect()->to('unit/index');
        } else {
            $search = session()->get('search_unit');
        }
        $dataunit = $search ? $this->unit->searchData($search)->paginate(5, 'unit') : $this->unit->paginate(5, 'unit');
        $pagenum = $this->request->getVar('page_unit') ? $this->request->getVar('page_unit') : 1;
        $data = [
            'showdata' => $dataunit,
            'pager' => $this->unit->pager,
            'pagenum' => $pagenum,
            'search' => $search
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
                'success' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Unit added!
              </div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('unit/index');
        }
    }

    public function edit($id)
    {
        $rowData = $this->unit->find($id);
        if ($rowData) {
            $data = [
                'id' => $id,
                'name' => $rowData['unitname']
            ];
            return view('unit/edit', $data);
        } else {
            exit('Data not found!');
        }
    }

    public function update()
    {
        $unitname = $this->request->getVar('unitname');
        $idunit = $this->request->getVar('idunit');
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
            return redirect()->to('unit/edit/' . $idunit);
        } else {
            $this->unit->update($idunit, [
                'unitname' => $unitname
            ]);
            $msg = [
                'success' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Unit updated!
              </div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('unit/index');
        }
    }

    public function delete($id)
    {
        $rowData = $this->unit->find($id);
        if ($rowData) {
            $this->unit->delete($id);

            $msg = [
                'success' => '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Unit deleted!
              </div>'
            ];

            session()->setFlashdata($msg);
            return redirect()->to('unit/index');
        } else {
            exit('Data not found!');
        }
    }
}
