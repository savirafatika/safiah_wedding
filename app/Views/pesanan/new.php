<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= base_url('user/reservasi_pengguna'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Buat Reservasi Baru</h1>
          </div>

          <div class="section-body">
               <h2 class="section-title">Perlu Diperhatikan!</h2>
               <p class="section-lead">
                    - Pastikan sudah melakukan kliam hadiah. <br>
                    - Salin kode hadiah kedalam kolom kode hadiah dibawah, pastikan huruf besar kecil sama.
               </p>
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
                    <div class="col-lg-10">
                         <div class="card">
                              <form class="needs-validation" novalidate="" action="<?= base_url('user/reservasi_pengguna/create'); ?>" method="post">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <input type="hidden" name="member_id" value="<?= user_id(); ?>">
                                        <div class="form-group row">
                                             <label for="nama_pemesan" class="col-sm-3 col-form-label">Nama Pemesan</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.nama_pemesan')) : ?>is-invalid<?php endif ?>" name="nama_pemesan" id="nama_pemesan" placeholder="Papan Menu">
                                                  <?php if (session('errors.nama_pemesan')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.nama_pemesan') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="no_wa" class="col-sm-3 col-form-label">No Whatsapp</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.no_wa')) : ?>is-invalid<?php endif ?>" name="no_wa" id="no_wa" placeholder="08870912xxxx" onkeypress="return isNumberKey(event)">
                                                  <?php if (session('errors.no_wa')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.no_wa') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                             <div class="col-sm-9">
                                                  <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control <?php if (session('errors.alamat')) : ?>is-invalid<?php endif ?>">Jalan jalan aja si gabut</textarea>
                                                  <?php if (session('errors.alamat')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.alamat') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="produk_id" class="col-sm-3 col-form-label">Produk</label>
                                             <div class="col-sm-9">
                                                  <select class="form-control select2 <?php if (session('errors.produk_id')) : ?>is-invalid<?php endif ?>" name="produk_id[]" id="produk_reservasi" multiple="">
                                                       <option></option>
                                                       <?php foreach ($produk as $p) : ?>
                                                            <option value="<?= $p['id_produk']; ?>">
                                                                 <?= $p['nama_produk']; ?> &ensp; | Rp.
                                                                 <?= number_format($p['harga'], 0, '', '.'); ?>
                                                            </option>
                                                       <?php endforeach ?>
                                                  </select>
                                                  <?php if (session('errors.produk_id')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.produk_id') ?>
                                                       </div>
                                                  <?php endif ?>
                                                  <br><br>
                                                  <div class="table-responsive">
                                                       <table class="table table-striped tabelProduk">
                                                            <thead>
                                                                 <tr>
                                                                      <th>Produk</th>
                                                                      <th>QTY</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                       </table>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="tgl_acara" class="col-sm-3 col-form-label">Tanggal Acara</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control datepicker <?php if (session('errors.tgl_acara')) : ?>is-invalid<?php endif ?>" name="tgl_acara" id="tgl_acara">
                                                  <?php if (session('errors.tgl_acara')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.tgl_acara') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="kode_hadiah" class="col-sm-3 col-form-label">Kode Hadiah</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.kode_hadiah')) : ?>is-invalid<?php endif ?>" name="kode_hadiah" id="kode_hadiah" placeholder="AbxL12">
                                                  <?php if (session('errors.kode_hadiah')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.kode_hadiah') ?>
                                                       </div>
                                                  <?php endif ?>
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