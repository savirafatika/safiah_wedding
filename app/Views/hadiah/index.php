<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Hadiah</h1>
          </div>

          <div class="section-body">
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
                                   <a href="<?= base_url('superadmin/hadiah/new'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="fas fa-plus"> Buat Hadiah baru</i>
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
                                                       <th>Nama Hadiah</th>
                                                       <th>Kode Hadiah</th>
                                                       <th>Jenis Hadiah</th>
                                                       <th>Nilai/Keterangan Hadiah</th>
                                                       <th>Status</th>
                                                       <th>Masa Berlaku</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($hadiah as $h) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $h['nama_hadiah']; ?></td>
                                                            <td><b><?= $h['kode_hadiah']; ?></b></td>
                                                            <td>
                                                                 <?php
                                                                 if ($h['jenis_hadiah'] == 'diskon_persen') {
                                                                      $jenis_hadiah = 'Diskon dalam %';
                                                                 } elseif ($h['jenis_hadiah'] == 'diskon_rupiah') {
                                                                      $jenis_hadiah = 'Potongan harga dalam Rp';
                                                                 } else {
                                                                      $jenis_hadiah = 'Khusus / Kustom';
                                                                 }
                                                                 ?>
                                                                 <?= $jenis_hadiah; ?>
                                                            </td>
                                                            <td>
                                                                 <?php
                                                                 if ($h['jenis_hadiah'] == 'diskon_persen') {
                                                                      $nilai_hadiah = $h['nilai_hadiah'] . ' %';
                                                                 } elseif ($h['jenis_hadiah'] == 'diskon_rupiah') {
                                                                      $nilai_hadiah = 'Rp. ' . number_format($h['nilai_hadiah'], 0, '', '.');
                                                                 } else {
                                                                      $nilai_hadiah = $h['nilai_hadiah'];
                                                                 }
                                                                 ?>
                                                                 <?= $nilai_hadiah; ?>
                                                            </td>
                                                            <td>
                                                                 <?php
                                                                 if ($h['status'] == 'on') {
                                                                      $color = 'success';
                                                                 } else {
                                                                      $color = 'light';
                                                                 }
                                                                 ?>
                                                                 <span class="badge badge-<?= $color; ?>"><?= $h['status']; ?></span>
                                                            </td>
                                                            <td><?= $h['jml_hari_berlaku']; ?> hari</td>
                                                            <td>
                                                                 <a href="<?= base_url('superadmin/hadiah/edit/' . $h['id_hadiah']); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit hadiah" id="sw"><i class="fas fa-edit"></i></a>
                                                                 <a href="<?= base_url('superadmin/hadiah/remove/' . $h['id_hadiah']); ?>" class="btn btn-danger buttonDelete" data-toggle="tooltip" data-placement="top" title="Hapus hadiah"><i class="fas fa-trash"></i></a>
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