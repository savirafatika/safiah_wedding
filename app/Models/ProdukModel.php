<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk', 'nama_produk', 'deskripsi', 'harga', 'foto_produk', 'kategori_id', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = false;

    // Validation
    protected $validationRules      = [
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
    protected $validationMessages   = [];
    protected $skipValidation       = true;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
