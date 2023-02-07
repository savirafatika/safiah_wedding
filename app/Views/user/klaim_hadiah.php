<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Klaim Hadiah Pengguna</h1>
          </div>

          <div class="section-body">
               <h2 class="section-title">Perlu Diperhatikan!</h2>
               <p class="section-lead">
                    Hadiah hanya bisa digunakan sampai masa berlaku selesai. <br>
                    Masa berlaku dihitung dari tanggal klaim hadiah.
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

               <h3 class="text-primary"><i>Daftar Hadiah</i></h3>
               <div class="row">
                    <?php foreach ($hadiah as $h) : ?>
                         <div class="col-lg-3">
                              <div class="card card-large-icons row" style="background-color: #f4f4f4; border-radius: 10px; margin: 2px;">
                                   <div class="card-body col-12">
                                        <h4 style="text-transform: uppercase;"><b><?= $h['nama_hadiah']; ?></b></h4> <br>
                                        <table border="0" width="100%">
                                             <tr>
                                                  <td><?php
                                                       if ($h['jenis_hadiah'] == 'diskon_persen') {
                                                            $jenis_hadiah = 'Diskon';
                                                       } elseif ($h['jenis_hadiah'] == 'diskon_rupiah') {
                                                            $jenis_hadiah = 'Potongan harga';
                                                       } else {
                                                            $jenis_hadiah = 'Khusus untukmu';
                                                       }
                                                       ?>
                                                       <h6><?= $jenis_hadiah; ?></h6>
                                                  </td>
                                             </tr>
                                             <tr>
                                                  <td>
                                                       <?php
                                                       if ($h['jenis_hadiah'] == 'diskon_persen') {
                                                            $nilai_hadiah = '<h3 class="text-danger">' . $h['nilai_hadiah'] . ' %</h3>';
                                                       } elseif ($h['jenis_hadiah'] == 'diskon_rupiah') {
                                                            $nilai_hadiah = '<h3 class="text-danger">Rp. ' . number_format($h['nilai_hadiah'], 0, '', '.') . '</h3>';
                                                       } else {
                                                            $nilai_hadiah = '<h5 class="text-danger" style="text-transform: lowercase;">' . $h['nilai_hadiah'] . '</h5>';
                                                       }
                                                       ?>
                                                       <?= $nilai_hadiah; ?>
                                                  </td>
                                             </tr>
                                        </table> <br>
                                        <h7>
                                             Masa berlaku: <?= $h['jml_hari_berlaku']; ?> hari
                                        </h7><br><br>
                                        Kode Hadiah: <h4><?= $h['kode_hadiah']; ?></h4>
                                        <form class="needs-validation" novalidate="" action="<?= route_to('tambah_klaim_hadiah'); ?>" method="post">
                                             <?= csrf_field(); ?>
                                             <div style="float: right;">
                                                  <input type="hidden" name="hadiah_id" value="<?= $h['id_hadiah']; ?>" class="form-control">
                                                  <input type="hidden" name="masa_berlaku" value="<?= $h['jml_hari_berlaku']; ?>" class="form-control">
                                                  <button type="submit" class="btn btn-outline-primary" style="border-radius: 10px">Klaim</button>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
               <nav class=" d-inline-block">
                    <?= $pager->links('hadiah', 'bootstrap_template') ?>
               </nav>

               <br><br>
               <h3 class="text-primary"><i>Hadiah Terklaim</i></h3>
               <div class="row">
                    <?php foreach ($hadiahku as $k) : ?>
                         <div class="col-lg-3">
                              <div class="card card-large-icons row" style="background-color: #f4f4f4; border-radius: 10px; margin: 2px;">
                                   <div class="card-body col-12">
                                        <h4 style="text-transform: uppercase;"><b><?= $k['nama_hadiah']; ?></b></h4> <br>
                                        <table border="0" width="100%">
                                             <tr>
                                                  <td><?php
                                                       if ($k['jenis_hadiah'] == 'diskon_persen') {
                                                            $jenis_hadiah = 'Diskon';
                                                       } elseif ($k['jenis_hadiah'] == 'diskon_rupiah') {
                                                            $jenis_hadiah = 'Potongan harga';
                                                       } else {
                                                            $jenis_hadiah = 'Khusus untukmu';
                                                       }
                                                       ?>
                                                       <h6><?= $jenis_hadiah; ?></h6>
                                                  </td>
                                             </tr>
                                             <tr>
                                                  <td>
                                                       <?php
                                                       if ($k['jenis_hadiah'] == 'diskon_persen') {
                                                            $nilai_hadiah = '<h3 class="text-danger">' . $k['nilai_hadiah'] . ' %</h3>';
                                                       } elseif ($k['jenis_hadiah'] == 'diskon_rupiah') {
                                                            $nilai_hadiah = '<h3 class="text-danger">Rp. ' . number_format($k['nilai_hadiah'], 0, '', '.') . '</h3>';
                                                       } else {
                                                            $nilai_hadiah = '<h5 class="text-danger" style="text-transform: lowercase;">' . $k['nilai_hadiah'] . '</h5>';
                                                       }
                                                       ?>
                                                       <?= $nilai_hadiah; ?>
                                                  </td>
                                             </tr>
                                        </table> <br>
                                        <h7>
                                             <?php
                                             // date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                                             setlocale(LC_TIME, 'id_ID');
                                             $tanggal_selesai_berlaku = date_format(date_create($k['selesai_berlaku']), "d M Y H:i:s");
                                             ?>
                                             Berakhir s/d: <?= $tanggal_selesai_berlaku; ?>
                                        </h7><br><br>
                                        Kode Hadiah: <h4><?= $k['kode_hadiah']; ?></h4>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
               <nav class=" d-inline-block">
                    <?= $pager->links('hadiahku', 'bootstrap_template') ?>
               </nav>

          </div>
     </section>
</div>

<?= $this->endSection(); ?>