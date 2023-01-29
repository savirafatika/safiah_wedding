<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= base_url('superadmin/produk'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Buat Produk Baru</h1>
          </div>

          <div class="section-body">
               <?php if (session()->has('errors')) : ?>
                    <div class="alert">
                         <ul class="alert alert-danger">
                              <?php foreach (session('errors') as $error) : ?>
                                   <li><?= $error ?></li>
                              <?php endforeach ?>
                         </ul>
                    </div>
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
               <div class="row">
                    <div class="col-lg-8">
                         <div class="card">
                              <form class="needs-validation" novalidate="" action="<?= base_url('superadmin/produk/create'); ?>" method="post" enctype="multipart/form-data">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="form-group row">
                                             <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.nama_produk')) : ?>is-invalid<?php endif ?>" name="nama_produk" id="nama_produk" placeholder="Papan Menu">
                                                  <?php if (session('errors.nama_produk')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.nama_produk') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                             <div class="col-sm-9">
                                                  <textarea name="deskripsi" id="deskripsi" class="summernote-simple <?php if (session('errors.deskripsi')) : ?>is-invalid<?php endif ?>" placeholder="Penyangga"></textarea>
                                                  <?php if (session('errors.deskripsi')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.deskripsi') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                                             <div class="col-sm-9">
                                                  <div class="input-group">
                                                       <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                 IDR
                                                            </div>
                                                       </div>
                                                       <input type="text" class="form-control <?php if (session('errors.harga')) : ?>is-invalid<?php endif ?>" name="harga" id="harga" placeholder="100000" onkeypress="return isNumberKey(event)" onkeyup="toRupiah(this)">
                                                       <?php if (session('errors.harga')) : ?>
                                                            <div class="invalid-feedback">
                                                                 <?= session('errors.harga') ?>
                                                            </div>
                                                       <?php endif ?>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="kategori_id" class="col-sm-3 col-form-label">Kategori</label>
                                             <div class="col-sm-9">
                                                  <select class="form-control select2 <?php if (session('errors.kategori_id')) : ?>is-invalid<?php endif ?>" name="kategori_id" id="kategori_id">
                                                       <option></option>
                                                       <?php foreach ($kategori as $k) : ?>
                                                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                                       <?php endforeach ?>
                                                  </select>
                                                  <?php if (session('errors.kategori_id')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.kategori_id') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="foto_produk" class="col-sm-3 col-form-label">Foto Produk</label>
                                             <div class="col-sm-9">
                                                  <input type="file" id="foto_produk" name="foto_produk" class="form-control foto_produk <?php if (session('errors.foto_produk')) : ?>is-invalid<?php endif ?>" accept=".jpg,.png,.jpeg" onchange="readURL(this);" />
                                                  <?php if (session('errors.foto_produk')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.foto_produk') ?>
                                                       </div>
                                                  <?php endif ?>
                                                  <br>
                                                  <img id="preview_foto_produk" src="<?= base_url(); ?>/assets/img/news/img01.jpg" alt="foto_produk image" width="250" />
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary" value="Upload">Simpan</button>
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