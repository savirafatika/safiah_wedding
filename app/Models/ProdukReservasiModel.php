<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukReservasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk_reservasi';
    protected $primaryKey       = 'id_produk_reservasi';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk_reservasi', 'reservasi_id', 'produk_id', 'qty', 'subtotal', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = false;

    // Validation
    protected $validationRules      = [
        'reservasi_id' => [
            'label' => 'ID Reservasi',
            'rules' => 'required'
        ],
        'produk_id' => [
            'label' => 'Produk',
            'rules' => 'required',
            'errors' => 'Produk harus dipilih.',
        ],
        'qty' => [
            'label' => 'Jumlah pesanan',
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
