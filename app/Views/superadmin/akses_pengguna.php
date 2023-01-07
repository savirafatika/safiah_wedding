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
               <div class="row">
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
                    <div class="col-12">
                         <div class="card">
                              <div class="card-header">
                                   <a href="<?= route_to('buat_pengguna'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="far fa-user-plus">Buat Akun</i>
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
                                                       <th>Username</th>
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
                                                            <td><?= $user->username; ?></td>
                                                            <td><?= $user->email; ?></td>
                                                            <td><?= $user->name; ?></td>
                                                            <td><span class="badge badge-<?= ($user->active = 1) ? 'success' : 'secondary'; ?>"><?= ($user->active = 1) ? 'aktif' : 'tidak aktif'; ?></span></td>
                                                            <td>
                                                                 <a href="<?= base_url('superadmin/detail_pengguna/' . $user->userid); ?>" class="badge badge-info">detail</a>
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