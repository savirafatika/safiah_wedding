<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Klaim Hadiah</h1>
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
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                             <thead>
                                                  <tr>
                                                       <th class="text-center">
                                                            #
                                                       </th>
                                                       <th>Pengguna</th>
                                                       <th>Nama Hadiah</th>
                                                       <th>Jenis Hadiah</th>
                                                       <th>Nilai Hadiah</th>
                                                       <th>Tanggal Selesai Berlaku</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($hadiahku as $h) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $h->fullname; ?></td>
                                                            <td><?= $h->nama_hadiah; ?></td>
                                                            <td>
                                                                 <?php
                                                                 if ($h->jenis_hadiah == 'diskon_persen') {
                                                                      $jenis_hadiah = 'Diskon';
                                                                 } elseif ($h->jenis_hadiah == 'diskon_rupiah') {
                                                                      $jenis_hadiah = 'Potongan harga';
                                                                 } else {
                                                                      $jenis_hadiah = 'Khusus untukmu';
                                                                 }
                                                                 ?>
                                                                 <?= $jenis_hadiah; ?>
                                                            </td>
                                                            <td>
                                                                 <?php
                                                                 if ($h->jenis_hadiah == 'diskon_persen') {
                                                                      $nilai_hadiah = $h->nilai_hadiah . ' %';
                                                                 } elseif ($h->jenis_hadiah == 'diskon_rupiah') {
                                                                      $nilai_hadiah = 'Rp. ' . number_format($h->nilai_hadiah, 0, '', '.');
                                                                 } else {
                                                                      $nilai_hadiah = $h->nilai_hadiah;
                                                                 }
                                                                 ?>
                                                                 <?= $nilai_hadiah; ?>
                                                            </td>
                                                            <td>
                                                                 <?php
                                                                 setlocale(LC_TIME, 'id_ID');
                                                                 $tanggal_selesai_berlaku = date_format(date_create($h->selesai_berlaku), "d M Y H:i:s");
                                                                 ?>
                                                                 <?= $tanggal_selesai_berlaku; ?>
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