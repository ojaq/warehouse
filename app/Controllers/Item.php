<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCategory;
use App\Models\ModelItem;
use App\Models\ModelUnit;
use CodeIgniter\HTTP\ResponseInterface;

class Item extends BaseController
{
    public function __construct()
    {
        $this->item = new ModelItem();
    }

    public function index()
    {
        $data = [
            'showdata' => $this->item->showdata()
        ];
        return view('item/viewitem', $data);
    }

    public function add()
    {
        $modelcategory = new ModelCategory();
        $modelunit = new ModelUnit();
        $data = [
            'datacategory' => $modelcategory->findAll(),
            'dataunit' => $modelunit->findAll()
        ];
        return view('item/add', $data);
    }

    public function save()
{
    $itemid = $this->request->getVar('itemid');
    $itemname = $this->request->getVar('itemname');
    $category = $this->request->getVar('category');
    $unit = $this->request->getVar('unit');
    $itemprice = $this->request->getVar('itemprice');
    $itemstock = $this->request->getVar('itemstock');

    $validation = \Config\Services::validation();
    $valid = $this->validate([
        'itemid' => [
            'rules' => 'required|is_unique[item.itemid]',
            'label' => 'Item Code',
            'errors' => [
                'required' => '{field} Cannot be empty'
            ]
        ],
        'itemname' => [
            'rules' => 'required',
            'label' => 'Item Name',
            'errors' => [
                'required' => '{field} Cannot be empty'
            ]
        ],
        'category' => [
            'rules' => 'required',
            'label' => 'Category',
            'errors' => [
                'required' => '{field} Cannot be empty'
            ]
        ],
        'unit' => [
            'rules' => 'required',
            'label' => 'Unit',
            'errors' => [
                'required' => '{field} Cannot be empty'
            ]
        ],
        'itemprice' => [
            'rules' => 'required|numeric',
            'label' => 'Price',
            'errors' => [
                'required' => '{field} Cannot be empty',
                'numeric' => 'Only numbers allowed in {field}'
            ]
        ],
        'itemstock' => [
            'rules' => 'required|numeric',
            'label' => 'Stock',
            'errors' => [
                'required' => '{field} Cannot be empty',
                'numeric' => 'Only numbers allowed in {field}'
            ]
        ],
        'image' => [
            'rules' => 'mime_in[image,image/png,image/jpg,image/jpeg]|ext_in[image,png,jpg,jpeg]',
            'label' => 'Image'
        ]
    ]);

    if (!$valid) {
        $msg = [
            'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h5><i class="icon fas fa-ban"></i> Error!</h5>
            ' . $validation->listErrors() . '
            </div>'
        ];
        session()->setFlashdata($msg);
        return redirect()->to('/item/add');
    } else {
        $imagefile = $this->request->getFile('image');
        if ($imagefile && !$imagefile->hasMoved()) {
            $imagefilename = $itemid;
            $imagefile->move('upload', $imagefilename . '.' . $imagefile->getExtension());
            $imagepath = 'upload/' . $imagefile->getName();
        } else {
            $imagepath = '';
        }

        $this->item->insert([
            'itemid' => $itemid,
            'itemname' => $itemname,
            'itemcatid' => $category,
            'itemunitid' => $unit,
            'itemprice' => $itemprice,
            'itemstock' => $itemstock,
            'itemimage' => $imagepath
        ]);

        $success = [
            'success' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> <h5><i class="icon fas fa-check"></i> Saved !</h5>
            Item with code <strong>' . $itemid . '</strong> successfully saved </div>'
        ];
        session()->setFlashdata($success);
        return redirect()->to('/item/add');
    }
}

}
