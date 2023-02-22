<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Cetak Faktur Safiah_Wedding</title>
     <!-- General CSS Files -->
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/fontawesome/css/all.min.css">

     <!-- CSS Libraries -->

     <!-- Template CSS -->
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/components.css">
     <!-- Start GA -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
     <script>
          window.dataLayer = window.dataLayer || [];

          function gtag() {
               dataLayer.push(arguments);
          }
          gtag('js', new Date());

          gtag('config', 'UA-94034622-3');
     </script>
</head>

<body>
     <div class="invoice">
          <div class="invoice-print">
               <div class="row">
                    <div class="col-lg-12">
                         <div class="invoice-title">
                              <h2>Faktur</h2>
                              <div class="invoice-number">Order #SW<?= $reservasi['id_reservasi']; ?></div>
                         </div>
                         <hr>
                         <div class="row">
                              <div class="col-md-6">
                                   <address>
                                        <strong>Reservasi dibuat:</strong><br>
                                        <?= $reservasi['nama_pemesan']; ?><br>
                                        <?= $reservasi['no_wa']; ?><br>
                                        <?php
                                        setlocale(LC_TIME, 'id_ID');
                                        $tgl_order = date_format(date_create($reservasi['tgl_reservasi'] ?? date('Y-m-d H:i:s')), "d M Y H:i:s");
                                        ?>
                                        <?= $tgl_order; ?>
                                   </address>
                              </div>
                              <div class="col-md-6 text-md-right">
                                   <address>
                                        <strong>Pengiriman:</strong><br>
                                        <?= $reservasi['nama_pemesan']; ?><br>
                                        <?= $reservasi['alamat']; ?><br><br>
                                   </address>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6">
                                   <?php if ($reservasi['member_id'] !== null) : ?>
                                        <address>
                                             <strong>Member:</strong><br>
                                             <?= $reservasi['fullname']; ?> (<?= $reservasi['username']; ?>)<br>
                                             <?= $reservasi['email']; ?>
                                        </address>
                                   <?php endif; ?>
                              </div>
                              <div class="col-md-6 text-md-right">
                                   <address>
                                        <strong>Tanggal Acara:</strong><br>
                                        <?php
                                        setlocale(LC_TIME, 'id_ID');
                                        $tglAcara = date_format(date_create($reservasi['tgl_acara']), "d M Y");
                                        ?>
                                        <?= $tglAcara; ?>
                                   </address>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="row mt-4">
                    <div class="col-md-12">
                         <div class="section-title">Ringkasan Pesanan</div>
                         <p class="section-lead">Semua item di sini tidak dapat diubah.</p>
                         <div class="table-responsive">
                              <table class="table table-striped table-hover table-md">
                                   <tr>
                                        <th data-width="40">#</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Harga Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-right">Subtotal</th>
                                   </tr>
                                   <?php $i = 1; ?>
                                   <?php foreach ($produk_reservasi as $p) : ?>
                                        <tr>
                                             <td><?= $i++; ?></td>
                                             <td><?= $p['nama_produk']; ?></td>
                                             <td class="text-center">Rp. <?= number_format($p['harga_produk'], 0, '', '.'); ?></td>
                                             <td class="text-center"><?= $p['qty']; ?></td>
                                             <td class="text-right">Rp. <?= number_format($p['subtotal'], 0, '', '.'); ?></td>
                                        </tr>
                                   <?php endforeach; ?>
                              </table>
                         </div>
                         <div class="row mt-4">
                              <div class="col-lg-8">
                                   <div class="section-title">Metode Pembayaran</div>
                                   <p class="section-lead">Metode pembayaran yang kami berikan adalah untuk memudahkan Anda membayar tagihan.</p>
                                   <div class="images">
                                        <img src="<?= base_url(); ?>/assets/img/bri.png" alt="bri" width="55px">
                                        <b>&ensp; 020801014929533</b>
                                   </div>
                                   <div class="images mt-2">
                                        <img src="<?= base_url(); ?>/assets/img/bca.png" alt="bca" width="55px">
                                        <b>&ensp; 8955342581</b>
                                   </div>
                              </div>
                              <div class="col-lg-4 text-right">
                                   <?php if ($reservasi['hadiah_id'] !== null) : ?>
                                        <div class="invoice-detail-item">
                                             <div class="invoice-detail-name">Kode Hadiah yang Digunakan</div>
                                             <div class="invoice-detail-value badge badge-light"><?= $reservasi['kode_hadiah']; ?></div>
                                        </div>
                                        <br>
                                        <div class="invoice-detail-item">
                                             <div class="invoice-detail-name">Potongan Harga</div>
                                             <div class="invoice-detail-value">Rp. <?= number_format($reservasi['potongan_harga'], 0, '', '.'); ?></div>
                                        </div>
                                   <?php endif; ?>
                                   <hr class="mt-2 mb-2">
                                   <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">Rp. <?= number_format($reservasi['total_bayar'], 0, '', '.'); ?></div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <hr>
     </div>
</body>

</html>

<script>
     window.print();
</script>
<script src="<?= base_url(); ?>/assets/modules/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/popper.js"></script>
<script src="<?= base_url(); ?>/assets/modules/tooltip.js"></script>
<script src="<?= base_url(); ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url(); ?>/assets/modules/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/stisla.js"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom.js"></script>