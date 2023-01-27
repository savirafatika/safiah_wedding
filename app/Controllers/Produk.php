<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;
use CodeIgniter\RESTful\ResourcePresenter;
use Config\Database;

class Produk extends ResourcePresenter
{
    protected $produk, $db;

    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->db = Database::connect();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = 'Produk';
        $data['produk'] = $this->produk->findAll();

        $builder = $this->db->table('produk as p')->select('p.id_produk, k.id_kategori, k.nama_kategori')
            ->join('kategori as k', 'p.kategori_id = k.id_kategori')
            ->get();
        $data['kategori'] = $builder->getResult();

        return view('produk/index', $data);
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
        $kategori = new KategoriModel();
        $data['title'] = 'Tambah Produk';
        $data['kategori'] = $kategori->findAll();
        return view('produk/new', $data);
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
        $rules = [
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required'
            ],
            'deskripsi' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required'
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required'
            ],
            'foto_produk' => [
                'label' => 'Foto Produk',
                'rules' => [
                    'is_image[foto_produk]',
                    'mime_in[foto_produk,image/jpg,image/jpeg,image/png]',
                    'max_size[foto_produk,2048]',
                ],
                'errors' => [
                    'is_image' => 'Harus Berupa Gambar dengan Ekstensi jpg,jpeg,png',
                    'mime_in' => 'File Ekstensi Harus Berupa jpg,jpeg,png',
                    'max_size' => 'Ukuran File Maksimal 2 MB'
                ]
            ],
            'kategori_id' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Produk harus harus dikategorikan',
                ]
            ],
        ];

        // cek ada validasi tidak 
        if ($this->validate($rules)) {
            $fileImage_name = "placeholder.jpg";
            if (isset($_FILES) && @$_FILES['foto_produk']['error'] != '4') {
                if ($fileImage = $this->request->getFile('foto_produk')) {
                    if (!$fileImage->isValid()) {
                        throw new \RuntimeException($fileImage->getErrorString() . '(' . $fileImage->getError() . ')');
                    } else {
                        $fileImage_name = $fileImage->getRandomName();
                        $fileImage->move('images/katalog', $fileImage_name);
                    }
                }
            }

            $allowedPostFields = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => str_replace('.', '', $this->request->getPost('harga')),
                'foto_produk' => $fileImage_name,
                'kategori_id' => $this->request->getPost('kategori_id')
            ];

            $this->produk->save($allowedPostFields);

            // Success!
            session()->setFlashdata('message', 'Berhasil menambahkan produk baru');
            return redirect()->to(base_url('superadmin/produk'));
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id_produk = null)
    {
        $kategoriModel = new KategoriModel();
        $data['title'] = 'Edit Produk';
        $data['kategoriOption'] = $kategoriModel->findAll();
        $builder = $this->db->table('produk as p')->select('p.id_produk, k.id_kategori, k.nama_kategori')
            ->join('kategori as k', 'p.kategori_id = k.id_kategori')
            ->where('id_produk', $id_produk)
            ->get();
        $data['kategori'] = $builder->getRowArray();
        $data['produk'] = $this->produk->where('id_produk', $id_produk)->first();
        return view('produk/edit', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id_produk = null)
    {
        $id_produk =  $this->request->getVar('id_produk');

        // lakukan validasi
        $rules = [
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required'
            ],
            'deskripsi' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required'
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'required'
            ],
            'foto_produk' => [
                'label' => 'Foto Produk',
                'rules' => [
                    'is_image[foto_produk]',
                    'mime_in[foto_produk,image/jpg,image/jpeg,image/png]',
                    'max_size[foto_produk,2048]',
                ],
                'errors' => [
                    'is_image' => 'Harus Berupa Gambar dengan Ekstensi jpg,jpeg,png',
                    'mime_in' => 'File Ekstensi Harus Berupa jpg,jpeg,png',
                    'max_size' => 'Ukuran File Maksimal 2 MB'
                ]
            ],
            'kategori_id' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Produk harus harus dikategorikan',
                ]
            ],
        ];

        // cek ada validasi tidak 
        if ($this->validate($rules)) {
            $fileImage_name = $this->request->getVar('oldFotoProduk');
            if (isset($_FILES) && @$_FILES['foto_produk']['error'] != '4') {
                if ($fileImage = $this->request->getFile('foto_produk')) {
                    if (!$fileImage->isValid()) {
                        throw new \RuntimeException($fileImage->getErrorString() . '(' . $fileImage->getError() . ')');
                    } else {
                        if ($fileImage_name !== 'placeholder.jpg') {
                            $path = 'images/katalog/';
                            unlink($path . $fileImage_name);
                        }
                        $fileImage_name = $fileImage->getRandomName();
                        $fileImage->move('images/katalog', $fileImage_name);
                    }
                }
            }

            $allowedPostFields = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => str_replace('.', '', $this->request->getPost('harga')),
                'foto_produk' => $fileImage_name,
                'kategori_id' => $this->request->getPost('kategori_id')
            ];

            $this->produk->update($id_produk, $allowedPostFields);

            // Success!
            session()->setFlashdata('message', 'Berhasil mengubah produk');
            return redirect()->to(base_url('superadmin/produk'));
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id_produk = null)
    {
        if ($id_produk != null && $id_produk > 0) {
            return $this->delete($id_produk);
        }
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id_produk = null)
    {
        $produk_data = $this->produk->where('id_produk', $id_produk)->first();
        $fileImage_name = $produk_data['foto_produk'];

        if ($fileImage_name !== 'placeholder.jpg') {
            unlink('images/katalog/' . $fileImage_name);
        }
        $this->produk->where('id_produk', $id_produk)->delete();

        session()->setFlashdata('message', 'Berhasil menghapus produk');
        return redirect()->to(base_url('superadmin/produk'));
    }
}
