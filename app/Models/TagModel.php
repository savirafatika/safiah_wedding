<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tag';
    protected $primaryKey       = 'id_tag';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_tag', 'nama_tag', 'slug', 'deskripsi_tag', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = false;

    // Validation
    protected $validationRules      = [
        'nama_tag' => [
            'label' => 'Nama Tag',
            'rules' => 'required'
        ],
        'slug' => [
            'label' => 'Slug',
            'rules' => 'required'
        ],
        'deskripsi_tag' => [
            'label' => 'Deskripsi Tag',
            'rules' => 'required'
        ]
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
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
