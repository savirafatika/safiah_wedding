<?php

namespace App\Controllers;

use App\Models\KlaimHadiahModel;

class Admin extends BaseController
{
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
}
