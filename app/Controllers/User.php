<?php

namespace App\Controllers;

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
          $data['title'] = 'Galeri Produk';
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
}
