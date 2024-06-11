<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCategory;

class Category extends BaseController
{
    protected $category;

    public function __construct()
    {
        $this->category = new ModelCategory();
    }

    public function index()
    {
        $searchbutton = $this->request->getPost('searchbutton');
        if(isset($searchbutton)){
            $search = $this->request->getPost('search');
            session()->set('search_category', $search);
            redirect()->to('category/index');
        } else {
            $search = session()->get('search_category');
        }
        $datacategory = $search ? $this->category->searchData($search)->paginate(5, 'category') : $this->category->paginate(5, 'category');
        $pagenum = $this->request->getVar('page_category') ? $this->request->getVar('page_category') : 1;
        $data = [
            'showdata' => $datacategory,
            'pager' => $this->category->pager,
            'pagenum' => $pagenum,
            'search' => $search
        ];
        return view('category/viewcategory', $data);
    }

    public function add()
    {
        return view('category/add');
    }

    public function save()
    {
        $categoryname = $this->request->getVar('categoryname');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'categoryname' => [
                'rules' => 'required',
                'label' => 'Category',
                'errors' => [
                    'required' => '{field} cannot be empty!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'errorCategoryName' => '<br><div class="alert alert-danger">' . $validation->getError('categoryname') . '</div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('category/add');
        } else {
            $this->category->insert([
                'catname' => $categoryname
            ]);
            $msg = [
                'success' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Category added!
              </div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('category/index');
        }
    }

    public function edit($id)
    {
        $rowData = $this->category->find($id);
        if ($rowData) {
            $data = [
                'id' => $id,
                'name' => $rowData['catname']
            ];
            return view('category/edit', $data);
        } else {
            exit('Data not found!');
        }
    }

    public function update()
    {
        $categoryname = $this->request->getVar('categoryname');
        $idcategory = $this->request->getVar('idcategory');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'categoryname' => [
                'rules' => 'required',
                'label' => 'Category',
                'errors' => [
                    'required' => '{field} cannot be empty!'
                ]
            ]
        ]);

        if (!$valid) {
            $msg = [
                'errorCategoryName' => '<br><div class="alert alert-danger">' . $validation->getError('categoryname') . '</div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('category/edit/' . $idcategory);
        } else {
            $this->category->update($idcategory, [
                'catname' => $categoryname
            ]);
            $msg = [
                'success' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Category updated!
              </div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('category/index');
        }
    }

    public function delete($id)
    {
        $rowData = $this->category->find($id);
        if ($rowData) {
            $this->category->delete($id);

            $msg = [
                'success' => '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Category deleted!
              </div>'
            ];

            session()->setFlashdata($msg);
            return redirect()->to('category/index');
        } else {
            exit('Data not found!');
        }
    }
}
