<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Akses Pengguna</h1>
          </div>

          <div class="section-body">
               <h2 class="section-title">Perlu Diperhatikan</h2>
               <p class="section-lead">Password untuk akun baru dan reset password akan menggunakan password default dari sistem (abc123).</p>

               <?php if (session()->has('message')) : ?>
                    <div class="flash-data" data-flashdata="<?= session('message'); ?>"></div>
               <?php endif ?>
               <?php if (session()->has('message-danger')) : ?>
                    <div class="flash-data-danger" data-flashdanger="<?= session('message-danger'); ?>"></div>
               <?php endif ?>

               <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                         <?= session('error') ?>
                    </div>
               <?php endif ?>
               <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                         <?= session('success') ?>
                    </div>
               <?php endif ?>

               <div class="row">
                    <div class="col-12">
                         <div class="card">
                              <div class="card-header">
                                   <a href="<?= route_to('buat_pengguna'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="fas fa-user-plus"> Buat Akun</i>
                                   </a>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                             <thead>
                                                  <tr>
                                                       <th class="text-center">
                                                            #
                                                       </th>
                                                       <th>Nama</th>
                                                       <th>Email</th>
                                                       <th>Peran Pengguna</th>
                                                       <th>Status</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($users as $user) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $user->fullname; ?></td>
                                                            <td><?= $user->email; ?></td>
                                                            <td><?= $user->name; ?></td>
                                                            <td><span class="badge badge-<?= ($user->active == 1) ? 'success' : 'secondary'; ?>"><?= ($user->active == 1) ? 'aktif' : 'tidak aktif'; ?></span></td>
                                                            <td>
                                                                 <a href="<?= base_url('superadmin/detail_pengguna/' . $user->userid); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat detail"><i class="fas fa-info"></i></a>
                                                                 <a href="<?= base_url('superadmin/resetpas_pengguna/' . $user->userid); ?>" class="btn btn-warning buttonResetPasUser" data-toggle="tooltip" data-placement="top" title="Reset password"><i class="fas fa-key"></i></a>
                                                                 <a href="<?= base_url('superadmin/hapus_pengguna/' . $user->userid); ?>" class="btn btn-danger buttonDelete" data-toggle="tooltip" data-placement="top" title="Hapus pengguna"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                       </tr>
                                                  <?php endforeach; ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

          </div>
     </section>
</div>

<?= $this->endSection(); ?>