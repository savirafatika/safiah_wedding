<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= base_url('superadmin/kategori'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Buat Kategori Produk</h1>
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
                              <form class="needs-validation" novalidate="" action="<?= base_url('superadmin/kategori/create'); ?>" method="post">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="form-group row">
                                             <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.nama_kategori')) : ?>is-invalid<?php endif ?>" name="nama_kategori" id="nama_kategori" placeholder="Tiang">
                                                  <?php if (session('errors.nama_kategori')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.nama_kategori') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="deskripsi_kategori" class="col-sm-3 col-form-label">Deskripsi Kategori</label>
                                             <div class="col-sm-9">
                                                  <textarea name="deskripsi_kategori" id="deskripsi_kategori" cols="30" rows="10" class="form-control <?php if (session('errors.deskripsi_kategori')) : ?>is-invalid<?php endif ?>" placeholder="Penyangga"></textarea>
                                                  <?php if (session('errors.deskripsi_kategori')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.deskripsi_kategori') ?>
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