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
        $data = [
            'showdata' => $this->category->findAll()
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
                'success' => '<div class="alert alert-success">Category saved!</div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('category/index');
        }
    }
}
