<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Profil Akun</h1>
          </div>

          <div class="section-body">
               <h2 class="section-title">Perlu Diperhatikan!</h2>
               <p class="section-lead">
                    Demi keamanan, silahkan mengganti password secara berkala.
               </p>

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
               <?php if (session()->has('warning')) : ?>
                    <div class="alert alert-warning">
                         <?= session('warning') ?>
                    </div>
               <?php endif ?>
               <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                         <?= session('success') ?>
                    </div>
               <?php endif ?>

               <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                         <div class="card profile-widget">
                              <div class="profile-widget-header">
                                   <img alt="image" src="https://ui-avatars.com/api/?background=e3eaef&name=<?= user()->fullname; ?>" class="rounded-circle profile-widget-picture">
                                   <div class="profile-widget-items">
                                        <div class="profile-widget-item">
                                             <div class="profile-widget-item-label">Sejak</div>
                                             <div class="profile-widget-item-value"><?= date('d F Y', strtotime(user()->created_at)); ?></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="profile-widget-description">
                                   <div class="profile-widget-name"><?= user()->fullname; ?> <div class="text-muted d-inline font-weight-normal">
                                             <div class="slash"></div> <?= $pengguna->name; ?>
                                        </div>
                                   </div>
                                   <table border="0">
                                        <tr>
                                             <td>Email</td>
                                             <td>:</td>
                                             <td>&ensp;<?= user()->email; ?> </td>
                                        </tr>
                                        <tr>
                                             <td>Username</td>
                                             <td>:</td>
                                             <td>&ensp;<?= user()->username; ?></td>
                                        </tr>
                                   </table>
                              </div>
                              <div class="card-footer text-center">
                                   <div class="font-weight-bold mb-2">Terakhir diperbarui <?= date('d F Y', strtotime(user()->updated_at)); ?></div>
                              </div>
                         </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                         <div class="card">
                              <form method="post" action="<?= route_to('gantipas_pengguna'); ?>" class="needs-validation" novalidate="">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Ganti Password</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="form-group col-12">
                                                  <label for="old_password">Password Lama</label>
                                                  <div class="input-group" id="show_hide_password">
                                                       <input type="password" class="form-control <?php if (session('errors.old_password')) : ?>is-invalid<?php endif ?>" name="old_password" placeholder="Password Lama" autocomplete="off">
                                                       <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                 <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                            </div>
                                                       </div>
                                                       <?php if (session('errors.old_password')) : ?>
                                                            <div class="invalid-feedback">
                                                                 <?= session('errors.old_password') ?>
                                                            </div>
                                                       <?php endif ?>
                                                       <?php if (session('error')) : ?>
                                                            <div class="invalid-feedback">
                                                                 <?= session('error') ?>
                                                            </div>
                                                       <?php endif ?>
                                                  </div>
                                             </div>
                                             <div class="form-group col-12">
                                                  <label for="password" class="d-block">Password Baru</label>
                                                  <div class="input-group" id="show_hide_password2">
                                                       <input id="password2" type="password" class="form-control pwstrength <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" data-indicator="pwindicator" name="password" placeholder="Password" autocomplete="off">
                                                       <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                 <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                            </div>
                                                       </div>
                                                       <?php if (session('errors.password')) : ?>
                                                            <div class="invalid-feedback">
                                                                 <?= session('errors.password') ?>
                                                            </div>
                                                       <?php endif ?>
                                                  </div>
                                             </div>
                                             <div class="form-group col-12">
                                                  <label for="pass_confirm" class="d-block">Konfirmasi Password</label>
                                                  <div class="input-group" id="show_hide_password2">
                                                       <input id="password2" type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Konfirmasi Password" autocomplete="off">
                                                       <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                 <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                            </div>
                                                       </div>
                                                       <?php if (session('errors.pass_confirm')) : ?>
                                                            <div class="invalid-feedback">
                                                                 <?= session('errors.pass_confirm') ?>
                                                            </div>
                                                       <?php endif ?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                   </div>

                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>

<?= $this->endSection(); ?>