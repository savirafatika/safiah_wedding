<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= base_url('superadmin/hadiah'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Buat Hadiah Baru</h1>
          </div>

          <div class="section-body">
               <h2 class="section-title">Perlu Diperhatikan!</h2>
               <p class="section-lead">
                    - Jika tidak memilih jenis hadiah, sistem akan membuat default "khusus". <br>
                    - Jika tidak mengisi nilai hadiah, sistem akan membuat default "belum ada nilai / deskripsi hadiah". <br>
                    - Jika tidak mengatur status, sistem akan membuat default "off" / belum bisa di klaim. <br>
                    - Jika tidak mengatur masa berlaku hadiah, sistem akan membuat default masa berlaku hanya 1 hari.
               </p>
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
                              <form class="needs-validation" novalidate="" action="<?= base_url('superadmin/hadiah/create'); ?>" method="post">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="form-group row">
                                             <label for="nama_hadiah" class="col-sm-3 col-form-label">Nama Hadiah</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.nama_hadiah')) : ?>is-invalid<?php endif ?>" name="nama_hadiah" id="nama_hadiah" placeholder="free ice cream 100 porsi">
                                                  <?php if (session('errors.nama_hadiah')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.nama_hadiah') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="jenis_hadiah" class="col-sm-3 col-form-label">Jenis Hadiah</label>
                                             <div class="col-sm-9">
                                                  <select class="form-control select2 <?php if (session('errors.jenis_hadiah')) : ?>is-invalid<?php endif ?>" name="jenis_hadiah" id="jenis_hadiah">
                                                       <option></option>
                                                       <option value="diskon_persen">Diskon %</option>
                                                       <option value="diskon_rupiah">Diskon Rupiah</option>
                                                       <option value="khusus">Khusus</option>
                                                  </select>
                                                  <?php if (session('errors.jenis_hadiah')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.jenis_hadiah') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="nilai_hadiah" class="col-sm-3 col-form-label">Nilai Hadiah</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control khusus <?php if (session('errors.nilai_hadiah')) : ?>is-invalid<?php endif ?>" name="nilai_hadiah" id="nilai_hadiah" placeholder="dapat 100 porsi ice cream">
                                                  <input type="number" class="form-control diskon_persen <?php if (session('errors.nilai_hadiah')) : ?>is-invalid<?php endif ?>" name="nilai_hadiah_persen" id="nilai_hadiah" placeholder="dapat 100 porsi ice cream">
                                                  <input type="text" class="form-control diskon_rupiah <?php if (session('errors.nilai_hadiah')) : ?>is-invalid<?php endif ?>" name="nilai_hadiah_rupiah" id="nilai_hadiah" placeholder="dapat 100 porsi ice cream" onkeyup="toRupiah(this)">
                                                  <?php if (session('errors.nilai_hadiah')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.nilai_hadiah') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="status" class="col-sm-3 col-form-label">Status</label>
                                             <div class="col-sm-9">
                                                  <label class="custom-switch mt-2">
                                                       <input type="checkbox" name="status" class="custom-switch-input status" id="status" value="off">
                                                       <span class="custom-switch-indicator"></span>
                                                       <span class="custom-switch-description">Hadiah terbuka untuk di klaim</span>
                                                  </label>
                                                  <?php if (session('errors.deskripsi_hadiah')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.deskripsi_hadiah') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="jml_hari_berlaku" class="col-sm-3 col-form-label">Masa Berlaku (hari)</label>
                                             <div class="col-sm-9">
                                                  <input type="number" class="form-control <?php if (session('errors.jml_hari_berlaku')) : ?>is-invalid<?php endif ?>" name="jml_hari_berlaku" id="jml_hari_berlaku" placeholder="0">
                                                  <?php if (session('errors.jml_hari_berlaku')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.jml_hari_berlaku') ?>
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