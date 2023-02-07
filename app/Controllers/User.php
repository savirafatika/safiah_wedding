<?php

namespace App\Controllers;

use App\Models\HadiahModel;
use App\Models\KategoriModel;
use App\Models\KlaimHadiahModel;
use App\Models\ProdukModel;
use App\Models\ReservasiModel;
use Config\Database;
use Myth\Auth\Password;

class User extends BaseController
{
     protected $db, $builder;

     public function __construct()
     {
          $this->db = Database::connect();
          $this->builder = $this->db->table('users');
     }

     public function index()
     {
          $produkModel = new ProdukModel();
          $kategoriModel = new KategoriModel();

          $data['title'] = 'Galeri Produk';
          $data['produk'] = $produkModel->findAll();
          $data['kategori'] = $kategoriModel->findAll();

          return view('user/index', $data);
     }

     public function profil()
     {
          $builder = $this->builder
               ->select('name')
               ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
               ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
               ->where('users.id', user_id())
               ->get();

          $data['title'] = 'Profil';
          $data['pengguna'] = $builder->getRow();
          return view('user/profil', $data);
     }

     public function gantipas_pengguna()
     {
          $users = model(UserModel::class);
          $user = $users->where('id', user_id())->first();

          $rules = [
               'old_password'       => [
                    'label' => 'Password Lama',
                    'rules' => 'required',
               ],
               'password'           => [
                    'label' => 'Password Baru',
                    'rules' => 'required|strong_password',
               ],
               'pass_confirm'       => [
                    'label' => 'Konfirmasi Password Baru',
                    'rules' => 'required|matches[password]',
               ],
          ];

          if (!$this->validate($rules)) {
               return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
          }

          $postPwd = Password::hash($this->request->getVar('password'));
          // $user = new User([
          //      'password_hash' => $postPwd,
          //      'updated_at' => date('Y-m-d H:i:s')
          // ]);

          if (!password_verify(base64_encode(hash('sha384', service('request')->getPost('old_password'), true)), user()->password_hash)) {
               return redirect()->back()->withInput()->with('error', 'Password Lama salah');
          }

          $user->password_hash = $postPwd;
          $user->updated_at = date('Y-m-d H:i:s');
          $users->save($user);

          if (!$users->save($user)) {
               return redirect()->back()->withInput()->with('errors', $users->errors());
          }

          // Success!
          session()->setFlashdata('message', 'Berhasil mengganti password pengguna');
          return redirect()->to(base_url('user/profil'));
     }

     public function klaim_hadiah()
     {
          $hadiahModel = new HadiahModel();
          $klaimHadiahModel = new KlaimHadiahModel();
          $klaim_hadiah = $klaimHadiahModel->where('user_id', user_id())->get();
          $hadiah_id = array_column($klaim_hadiah->getResultArray() ?? [], 'hadiah_id');
          $hadiahModel->where('status', 'on');

          if ($hadiah_id) {
               $hadiahModel->whereNotIn('id_hadiah', $hadiah_id);
          }

          $data['title'] = 'Klaim Hadiah';
          $data['klaim'] = $klaim_hadiah->getResultArray();
          $data['hadiah'] = $hadiahModel->paginate(4, 'hadiah');
          $data['pager'] = $hadiahModel->pager;

          $data['hadiahku'] = $klaimHadiahModel->join('hadiah', 'hadiah.id_hadiah = klaim_hadiah.hadiah_id')
               ->where('user_id', user_id())
               ->paginate(4, 'hadiahku');
          $data['pager2'] = $klaimHadiahModel->pager;

          return view('user/klaim_hadiah', $data);
     }

     public function tambah_klaim()
     {
          $klaimHadiahModel = new KlaimHadiahModel();
          // lakukan validasi
          $rules = $klaimHadiahModel->validationRules;

          // cek ada validasi tidak 
          if (!$this->validate($rules)) {
               return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
          }

          $id_hadiah = ($this->request->getPost('hadiah_id') != '') ? $this->request->getPost('hadiah_id') : 0;
          $masa_berlaku = ($this->request->getPost('masa_berlaku') != '') ? $this->request->getPost('masa_berlaku') : 0;

          $now = date('Y-m-d H:i:s');
          $tgl_selesai_berlaku = date('Y-m-d H:i:s', strtotime($now . ' + ' . $masa_berlaku . ' days'));

          $allowedPostFields = [
               'hadiah_id' => $id_hadiah,
               'user_id' => user_id(),
               'selesai_berlaku' => $tgl_selesai_berlaku
          ];

          // echo '<pre>';
          // print_r($allowedPostFields);
          // die;

          if (!$klaimHadiahModel->save($allowedPostFields)) {
               return redirect()->back()->withInput()->with('errors', $klaimHadiahModel->errors());
          }

          // Success!
          session()->setFlashdata('message', 'Selamat Anda berhasil klaim hadiah');
          return redirect()->to(base_url('user/hadiah_pengguna'));
     }

     public function cetak_reservasi($id_reservasi = null)
     {
          $reservasiModel = new ReservasiModel();
          $data['title'] = 'Cetak Reservasi';
          $data['reservasi'] = $reservasiModel->select('reservasi.*, users.*, hadiah.*, reservasi.created_at as tgl_reservasi')
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

          return view('pesanan/cetak', $data);
     }
}
