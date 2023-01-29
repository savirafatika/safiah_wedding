<?php

namespace App\Controllers;

use App\Models\TagModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Tag extends ResourcePresenter
{
    protected $tag;

    public function __construct()
    {
        $this->tag = new TagModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = 'Tag';
        $data['tag'] = $this->tag->findAll();
        return view('tag/index', $data);
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
        $data['title'] = 'Tambah Tag';
        return view('tag/new', $data);
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
        $rules = $this->tag->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $allowedPostFields = [
            'nama_tag' => $this->request->getPost('nama_tag'),
            'slug' => $this->request->getPost('slug'),
            'deskripsi_tag' => $this->request->getPost('deskripsi_tag')
        ];

        if (!$this->tag->save($allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->tag->errors());
        }

        // Success!
        session()->setFlashdata('message', 'Berhasil menambahkan tag baru');
        return redirect()->to(base_url('superadmin/tag'));
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id_tag = null)
    {
        $data['title'] = 'Edit Tag';
        $data['tag'] = $this->tag->where('id_tag', $id_tag)->first();
        return view('tag/edit', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id_tag = null)
    {
        // lakukan validasi
        $rules = $this->tag->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $allowedPostFields = [
            'nama_tag' => $this->request->getPost('nama_tag'),
            'slug' => $this->request->getPost('slug'),
            'deskripsi_tag' => $this->request->getPost('deskripsi_tag')
        ];

        if (!$this->tag->update($id_tag, $allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->tag->errors());
        }

        session()->setFlashdata('message', 'Berhasil mengubah tag');
        return redirect()->to(base_url('superadmin/tag'));
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id_tag = null)
    {
        if ($id_tag != null && $id_tag > 0) {
            return $this->delete($id_tag);
        }
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id_tag = null)
    {
        $this->tag->where('id_tag', $id_tag)->delete();

        session()->setFlashdata('message', 'Berhasil menghapus tag');
        return redirect()->to(base_url('superadmin/tag'));
    }
}
