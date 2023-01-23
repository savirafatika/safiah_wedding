<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= base_url('superadmin/tag'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Buat Tag Baru</h1>
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
                              <form class="needs-validation" novalidate="" action="<?= base_url('superadmin/tag/create'); ?>" method="post">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="form-group row">
                                             <label for="nama_tag" class="col-sm-3 col-form-label">Nama Tag</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.nama_tag')) : ?>is-invalid<?php endif ?>" name="nama_tag" id="nama_tag" placeholder="Busana">
                                                  <?php if (session('errors.nama_tag')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.nama_tag') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="slug" class="col-sm-3 col-form-label">Slug</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.slug')) : ?>is-invalid<?php endif ?>" name="slug" id="slug" placeholder="busana">
                                                  <?php if (session('errors.slug')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.slug') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="deskripsi_tag" class="col-sm-3 col-form-label">Deskripsi Tag</label>
                                             <div class="col-sm-9">
                                                  <textarea name="deskripsi_tag" id="deskripsi_tag" cols="30" rows="10" class="form-control <?php if (session('errors.deskripsi_tag')) : ?>is-invalid<?php endif ?>" placeholder="Membagikan kategori busana pengantin"></textarea>
                                                  <?php if (session('errors.deskripsi_tag')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.deskripsi_tag') ?>
                                                       </div>
                                                  <?php endif ?>
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