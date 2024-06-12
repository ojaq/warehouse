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
        $imagefile = $this->request->getFile('image');

        $validationRules = [
            'itemid' => [
                'rules' => 'required|is_unique[item.itemid]',
                'label' => 'Item Code',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'is_unique' => '{field} must be unique'
                ]
            ],
            'itemname' => [
                'rules' => 'required',
                'label' => 'Item Name',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'category' => [
                'rules' => 'required',
                'label' => 'Category',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'label' => 'Unit',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'itemprice' => [
                'rules' => 'required|numeric',
                'label' => 'Price',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'numeric' => '{field} must be a number'
                ]
            ],
            'itemstock' => [
                'rules' => 'required|numeric',
                'label' => 'Stock',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'numeric' => '{field} must be a number'
                ]
            ]
        ];

        if ($imagefile->isValid() && !$imagefile->hasMoved()) {
            $validationRules['image'] = [
                'rules' => 'mime_in[image,image/png,image/jpg,image/jpeg]|ext_in[image,png,jpg,jpeg]',
                'label' => 'Image'
            ];
        }

        if (!$this->validate($validationRules)) {
            $msg = [
                'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h5><i class="icon fas fa-ban"></i> Error!</h5>
            ' . $validation->listErrors() . '
            </div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('/item/add')->withInput();
        } else {
            if ($imagefile->isValid() && !$imagefile->hasMoved()) {
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

            $saved = [
                'saved' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> <h5><i class="icon fas fa-check"></i> Saved !</h5>
            Item with code <strong>' . $itemid . '</strong> successfully saved </div>'
            ];
            session()->setFlashdata($saved);
            return redirect()->to('/item/index');
        }
    }

    public function edit($id)
    {
        $rowData = $this->item->find($id);
        if ($rowData) {
            $modelcategory = new ModelCategory();
            $modelunit = new ModelUnit();
            $data = [
                'itemid' => $rowData['itemid'],
                'itemname' => $rowData['itemname'],
                'category' => $rowData['itemcatid'],
                'unit' => $rowData['itemunitid'],
                'itemprice' => $rowData['itemprice'],
                'itemstock' => $rowData['itemstock'],
                'itemimage' => $rowData['itemimage'],
                'datacategory' => $modelcategory->findAll(),
                'dataunit' => $modelunit->findAll()
            ];
            return view('item/edit', $data);
        } else {
            $errmsg = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> <h5><i class="icon fas fa-ban"></i> Error !</h5>
                Data not found!
                </div>'
            ];
            session()->setFlashdata($errmsg);
            return redirect()->to('/item/index');
        }
    }

    public function update()
    {
        $itemid = $this->request->getVar('itemid');
        $itemname = $this->request->getVar('itemname');
        $category = $this->request->getVar('category');
        $unit = $this->request->getVar('unit');
        $itemprice = $this->request->getVar('itemprice');
        $itemstock = $this->request->getVar('itemstock');

        $validation = \Config\Services::validation();
        $imagefile = $this->request->getFile('image');

        $validationRules = [
            'itemname' => [
                'rules' => 'required',
                'label' => 'Item Name',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'category' => [
                'rules' => 'required',
                'label' => 'Category',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'label' => 'Unit',
                'errors' => [
                    'required' => '{field} cannot be empty'
                ]
            ],
            'itemprice' => [
                'rules' => 'required|numeric',
                'label' => 'Price',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'numeric' => '{field} must be a number'
                ]
            ],
            'itemstock' => [
                'rules' => 'required|numeric',
                'label' => 'Stock',
                'errors' => [
                    'required' => '{field} cannot be empty',
                    'numeric' => '{field} must be a number'
                ]
            ]
        ];

        if ($imagefile->isValid() && !$imagefile->hasMoved()) {
            $validationRules['image'] = [
                'rules' => 'mime_in[image,image/png,image/jpg,image/jpeg]|ext_in[image,png,jpg,jpeg]',
                'label' => 'Image'
            ];
        }

        if (!$this->validate($validationRules)) {
            $msg = [
                'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h5><i class="icon fas fa-ban"></i> Error!</h5>
            ' . $validation->listErrors() . '
            </div>'
            ];
            session()->setFlashdata($msg);
            return redirect()->to('/item/add')->withInput();
        } else {
            if ($imagefile->isValid() && !$imagefile->hasMoved()) {
                $imagefilename = $itemid;
                $imagefile->move('upload', $imagefilename . '.' . $imagefile->getExtension());
                $imagepath = 'upload/' . $imagefile->getName();
            } else {
                $imagepath = '';
            }

            $this->item->update($itemid, [
                'itemname' => $itemname,
                'itemcatid' => $category,
                'itemunitid' => $unit,
                'itemprice' => $itemprice,
                'itemstock' => $itemstock,
                'itemimage' => $imagepath
            ]);

            $updated = [
                'updated' => '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> <h5><i class="icon fas fa-check"></i> Updated !</h5>
            Item with code <strong>' . $itemid . '</strong> successfully updated </div>'
            ];
            session()->setFlashdata($updated);
            return redirect()->to('/item/index');
        }
    }

    public function delete($id)
    {
        $rowData = $this->item->find($id);
        if ($rowData) {
            $this->item->delete($id);

            $msg = [
                'success' => '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Item deleted!
              </div>'
            ];

            session()->setFlashdata($msg);
            return redirect()->to('item/index');
        } else {
            exit('Data not found!');
        }
    }
}
