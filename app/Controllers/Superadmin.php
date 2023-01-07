<?php

namespace App\Controllers;

use Config\Database;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Superadmin extends BaseController
{
     protected $db, $builder;

     public function __construct()
     {
          $this->db = Database::connect();
          $this->builder = $this->db->table('users');
     }

     public function index()
     {
          $data['title'] = 'Dashboard';
          return view('superadmin/index', $data);
     }

     public function daftar_akses_pengguna()
     {
          // $users = new UserModel();
          // $data['users'] = $users->findAll();
          $builder = $this->builder
               ->select('users.id as userid, username, email, active, name')
               ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
               ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
               ->get();

          $data['title'] = 'Daftar Akses Pengguna';
          $data['users'] = $builder->getResult();
          return view('superadmin/akses_pengguna', $data);
     }

     public function detail_pengguna($id = 0)
     {
          $builder = $this->builder
               ->select('users.id as userid, users.created_at as terdaftar, username, email, fullname, active, name')
               ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
               ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
               ->where('users.id', $id)
               ->get();

          $data['title'] = 'Detail Pengguna';
          $data['user'] = $builder->getRow();

          if (empty($data['user'])) {
               return redirect()->to('superadmin/akses_pengguna');
          }

          return view('superadmin/detail_pengguna', $data);
     }

     public function buat_pengguna()
     {
          $groups = new GroupModel();

          $data['title'] = 'Buat Pengguna Baru';
          $data['grup'] = $groups->where('id !=', 1)->findAll();

          return view('superadmin/buat_pengguna', $data);
     }

     public function simpan_pengguna()
     {
          $pengguna = new UserModel();

          $pengguna->withGroup($this->request->getVar('role'))->insert([
               'fullname' => $this->request->getPost('fullname'),
               'username' => $this->request->getPost('username'),
               'email' => $this->request->getPost('email'),
               'password_hash' => $this->request->getPost('abc123'),
               'active' => 1
          ]);

          session()->setFlashdata('success', 'Berhasil menambahkan pengguna');
          return redirect()->to(base_url('superadmin/buat_pengguna'));
     }
}
