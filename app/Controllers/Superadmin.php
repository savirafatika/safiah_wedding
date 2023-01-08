<?php

namespace App\Controllers;

use Config\Database;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Password;
use Myth\Auth\Entities\User;

class Superadmin extends BaseController
{
     protected $db, $builder, $auth, $config;

     public function __construct()
     {
          $this->db = Database::connect();
          $this->builder = $this->db->table('users');
          $this->config = config('Auth');
          $this->auth = service('authentication');
     }

     public function index()
     {
          $data['title'] = 'Dashboard';
          return view('superadmin/index', $data);
     }

     public function daftar_akses_pengguna()
     {
          $builder = $this->builder
               ->select('users.id as userid, fullname, email, active, name')
               ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
               ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
               ->get();

          $data['title'] = 'Daftar Akses Pengguna';
          $data['users'] = $builder->getResult();
          return view('superadmin/akses_pengguna', $data);
     }

     public function detail_pengguna($id_user = 0)
     {
          $builder = $this->builder
               ->select('users.id as userid, users.created_at as terdaftar, username, email, fullname, active, name')
               ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
               ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
               ->where('users.id', $id_user)
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
          $users = model(UserModel::class);

          $rules = [
               'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
               'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
               'fullname' => [
                    'label' => 'Nama lengkap',
                    'rules' => 'required',
               ],
          ];

          if (!$this->validate($rules)) {
               return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
          }

          // simpan data pengguna
          $allowedPostFields = array_merge(
               [
                    'password_hash' => Password::hash('abc123'),
                    'active' => 1
               ],
               $this->request->getPost(['fullname', 'username', 'email'])
          );
          $user = new User($allowedPostFields);

          // menambahkan pengguna ke grup pengguna
          if (!empty($this->request->getVar('role'))) {
               $users = $users->withGroup($this->request->getVar('role'));
          } else {
               $users = $users->withGroup($this->config->defaultUserGroup);
          }

          if (!$users->save($user)) {
               return redirect()->back()->withInput()->with('errors', $users->errors());
          }

          // Success!
          session()->setFlashdata('message', 'Berhasil menambahkan pengguna');
          return redirect()->to(base_url('superadmin/akses_pengguna'));
     }

     public function resetpas_pengguna($id_user = 0)
     {
          $users = new UserModel();
          $data = ['password_hash' => Password::hash('abc123')];
          $users->update($id_user, $data);

          session()->setFlashdata('message', 'Berhasil mengubah password pengguna');
          return redirect()->to(base_url('superadmin/akses_pengguna'));
     }

     public function hapus_pengguna($id_user = 0)
     {
          $users = new UserModel();
          $users->where('id', $id_user)->delete();

          session()->setFlashdata('message', 'Berhasil menghapus pengguna');
          return redirect()->to(base_url('superadmin/akses_pengguna'));
     }
}
