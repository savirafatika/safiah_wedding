<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'blog';
    protected $primaryKey       = 'id_blog';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_blog', 'judul', 'deskripsi_singkat', 'isi', 'thumbnail', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = false;

    // Validation
    protected $validationRules      = [
        'judul' => [
            'label' => 'Judul',
            'rules' => 'required'
        ],
        'deskripsi_singkat' => [
            'label' => 'Deskripsi Singkat',
            'rules' => 'required'
        ],
        'thumbnail' => [
            'label' => 'Thumbnail',
            'rules' => [
                'is_image[thumbnail]',
                'mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                'max_size[thumbnail,2048]',
            ],
            'errors' => [
                'is_image' => 'Harus Berupa Gambar dengan Ekstensi jpg,jpeg,png',
                'mime_in' => 'File Ekstensi Harus Berupa jpg,jpeg,png',
                'max_size' => 'Ukuran File Maksimal 2 MB'
            ]
        ]
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
