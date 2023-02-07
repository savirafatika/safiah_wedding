<?php

namespace App\Controllers;

use App\Models\HadiahModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Hadiah extends ResourcePresenter
{
    protected $hadiah;
    public function __construct()
    {
        $this->hadiah = new HadiahModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = 'Hadiah';
        $data['hadiah'] = $this->hadiah->findAll();
        return view('hadiah/index', $data);
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
        $data['title'] = 'Tambah Hadiah';
        return view('hadiah/new', $data);
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
        $rules = $this->hadiah->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $code = $this->uniqKodeHadiah(6);
        $jenis_hadiah = $this->request->getPost('jenis_hadiah');
        $nilai_hadiah = 'khusus';
        $status = $this->request->getPost('status');
        $jml_hari_berlaku = $this->request->getPost('jml_hari_berlaku');

        if ($jenis_hadiah == 'diskon_persen') {
            $nilai_hadiah = $this->request->getPost('nilai_hadiah_persen');
        } elseif ($jenis_hadiah == 'diskon_rupiah') {
            $nilai_hadiah = str_replace('.', '', $this->request->getPost('nilai_hadiah_rupiah'));
        } else {
            $nilai_hadiah = $this->request->getPost('nilai_hadiah');
        }

        $allowedPostFields = [
            'nama_hadiah' => $this->request->getPost('nama_hadiah'),
            'kode_hadiah' => $code,
            'jenis_hadiah' => $jenis_hadiah != '' ? $jenis_hadiah : 'khusus',
            'nilai_hadiah' => $nilai_hadiah != '' ? $nilai_hadiah : 'belum ada nilai / deskripsi hadiah',
            'status' => $status != '' ? $status : 'off',
            'jml_hari_berlaku' => $jml_hari_berlaku != '' ? $jml_hari_berlaku : 1
        ];

        if (!$this->hadiah->save($allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->hadiah->errors());
        }

        // Success!
        session()->setFlashdata('message', 'Berhasil menambahkan hadiah baru');
        return redirect()->to(base_url('superadmin/hadiah'));
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id_hadiah = null)
    {
        $data['title'] = 'Edit Hadiah';
        $data['hadiah'] = $this->hadiah->where('id_hadiah', $id_hadiah)->first();
        return view('hadiah/edit', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id_hadiah = null)
    {
        // lakukan validasi
        $rules = $this->hadiah->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $jenis_hadiah = $this->request->getPost('jenis_hadiah');
        $nilai_hadiah = 'khusus';
        $status = $this->request->getPost('status');
        $jml_hari_berlaku = $this->request->getPost('jml_hari_berlaku');

        if ($jenis_hadiah == 'diskon_persen') {
            $nilai_hadiah = $this->request->getPost('nilai_hadiah_persen');
        } elseif ($jenis_hadiah == 'diskon_rupiah') {
            $nilai_hadiah = str_replace('.', '', $this->request->getPost('nilai_hadiah_rupiah'));
        } else {
            $nilai_hadiah = $this->request->getPost('nilai_hadiah');
        }

        $allowedPostFields = [
            'nama_hadiah' => $this->request->getPost('nama_hadiah'),
            'jenis_hadiah' => $jenis_hadiah != '' ? $jenis_hadiah : 'khusus',
            'nilai_hadiah' => $nilai_hadiah != '' ? $nilai_hadiah : 'belum ada nilai / deskripsi hadiah',
            'status' => $status != '' ? $status : 'off',
            'jml_hari_berlaku' => $jml_hari_berlaku != '' ? $jml_hari_berlaku : 1
        ];

        if (!$this->hadiah->update($id_hadiah, $allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->hadiah->errors());
        }

        session()->setFlashdata('message', 'Berhasil mengubah hadiah');
        return redirect()->to(base_url('superadmin/hadiah'));
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id_hadiah = null)
    {
        if ($id_hadiah != null && $id_hadiah > 0) {
            return $this->delete($id_hadiah);
        }
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id_hadiah = null)
    {
        $this->hadiah->where('id_hadiah', $id_hadiah)->delete();

        session()->setFlashdata('message', 'Berhasil menghapus hadiah');
        return redirect()->to(base_url('superadmin/hadiah'));
    }

    function uniqKodeHadiah($lenght = 6)
    {
        // uniqid gives 6 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}
