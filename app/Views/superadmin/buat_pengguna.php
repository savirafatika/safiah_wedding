<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= route_to('daftar_pengguna'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Buat Pengguna Baru</h1>
          </div>

          <div class="section-body">
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
               <div class="row">
                    <div class="col-lg-8">
                         <div class="card">
                              <form class="needs-validation" novalidate="" action="<?= route_to('simpan_pengguna'); ?>" method="post">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="form-group row">
                                             <label for="fullname" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" id="fullname" placeholder="John Doe">
                                                  <?php if (session('errors.fullname')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.fullname') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="email" class="col-sm-3 col-form-label">Email</label>
                                             <div class="col-sm-9">
                                                  <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" id="email" placeholder="john@mail.com">
                                                  <?php if (session('errors.email')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.email') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="username" class="col-sm-3 col-form-label">Username</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" id="username" placeholder="john_doe">
                                                  <?php if (session('errors.username')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.username') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                             <label for="role" class="col-sm-3 col-form-label">Peran</label>
                                             <div class="col-sm-9">
                                                  <select class="form-control select2 <?php if (session('error')) : ?>is-invalid<?php endif ?>" name="role" id="grup_pengguna">
                                                       <option></option>
                                                       <?php foreach ($grup as $gr) : ?>
                                                            <option value="<?= $gr->name; ?>"><?= $gr->name; ?></option>
                                                       <?php endforeach; ?>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>

<?= $this->endSection(); ?>