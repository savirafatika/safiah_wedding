<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Kategori extends ResourcePresenter
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = 'Kategori Produk';
        $data['kategori'] = $this->kategori->findAll();
        return view('kategori/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $data['title'] = 'Tambah Kategori Produk';
        return view('kategori/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        // lakukan validasi
        $rules = $this->kategori->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $allowedPostFields = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi_kategori' => $this->request->getPost('deskripsi_kategori')
        ];

        if (!$this->kategori->save($allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->kategori->errors());
        }

        // Success!
        session()->setFlashdata('message', 'Berhasil menambahkan kategori produk');
        return redirect()->to(base_url('superadmin/kategori'));
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id_kategori = null)
    {
        $data['title'] = 'Edit Kategori Produk';
        $data['kategori'] = $this->kategori->where('id_kategori', $id_kategori)->first();
        return view('kategori/edit', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id_kategori = null)
    {
        // lakukan validasi
        $rules = $this->kategori->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $allowedPostFields = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi_kategori' => $this->request->getPost('deskripsi_kategori')
        ];

        if (!$this->kategori->update($id_kategori, $allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->kategori->errors());
        }

        session()->setFlashdata('message', 'Berhasil mengubah kategori produk');
        return redirect()->to(base_url('superadmin/kategori'));
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id_kategori = null)
    {
        if ($id_kategori != null && $id_kategori > 0) {
            return $this->delete($id_kategori);
        }
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id_kategori = null)
    {
        $this->kategori->where('id_kategori', $id_kategori)->delete();

        session()->setFlashdata('message', 'Berhasil menghapus kategori produk');
        return redirect()->to(base_url('superadmin/kategori'));
    }
}
