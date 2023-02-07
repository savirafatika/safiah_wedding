<?php

namespace App\Controllers;

use App\Models\KlaimHadiahModel;
use App\Models\ReservasiModel;
use Config\Database;

class Admin extends BaseController
{
     protected $reservasi, $db;

     public function __construct()
     {
          $this->reservasi = new ReservasiModel();
          $this->db = Database::connect();
     }

     public function index()
     {
          return view('admin/index');
     }

     public function daftar_klaim_hadiah()
     {
          $klaimHadiahModel = new KlaimHadiahModel();

          $data['title'] = 'Daftar Klaim Hadiah';
          $dataKlaimHadiah = $klaimHadiahModel->join('hadiah', 'hadiah.id_hadiah = klaim_hadiah.hadiah_id')
               ->join('users', 'users.id = klaim_hadiah.user_id')
               ->select('klaim_hadiah.id_klaim_hadiah, klaim_hadiah.selesai_berlaku, hadiah.nama_hadiah, hadiah.jenis_hadiah, hadiah.nilai_hadiah, users.fullname')
               ->get();
          $data['hadiahku'] = $dataKlaimHadiah->getResult();
          // echo '<pre>';
          // print_r($dataKlaimHadiah);
          // die;
          return view('admin/klaim_hadiah', $data);
     }

     public function cetak_reservasi($id_reservasi = null)
     {
          $data['title'] = 'Cetak Reservasi';
          $data['reservasi'] = $this->reservasi->select('reservasi.*, users.*, hadiah.*, reservasi.created_at as tgl_reservasi')
               ->join('users', 'users.id = reservasi.member_id', 'left')
               ->join('hadiah', 'hadiah.id_hadiah = reservasi.hadiah_id', 'left')
               ->where('id_reservasi', $id_reservasi)
               ->first();

          $builder = $this->db->table('produk_reservasi as pr')->select('pr.*, pd.nama_produk, pd.harga as harga_produk, r.potongan_harga, r.total_bayar')
               ->join('reservasi as r', 'r.id_reservasi = pr.reservasi_id')
               ->join('produk as pd', 'pd.id_produk = pr.produk_id')
               ->where('reservasi_id', $id_reservasi)
               ->get();
          $data['produk_reservasi'] = $builder->getResultArray();

          return view('reservasi/cetak', $data);
     }
}
