<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Reservasi</h1>
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
                                   <a href="<?= base_url('admin/reservasi/new'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="fas fa-plus"> Buat reservasi baru</i>
                                   </a>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                             <thead>
                                                  <tr>
                                                       <th class="text-center"> # </th>
                                                       <th>Nama Pemesan</th>
                                                       <th>No Whatsapp</th>
                                                       <th>Alamat</th>
                                                       <th>Nama Produk</th>
                                                       <th>Tanggal Acara</th>
                                                       <th>Potongan Harga</th>
                                                       <th>Total Bayar</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($reservasi as $r) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $r['nama_pemesan']; ?></td>
                                                            <td><?= $r['no_wa']; ?></td>
                                                            <td><?= $r['alamat']; ?></td>
                                                            <td>
                                                                 <?php foreach ($produk_reservasi as $p) : ?>
                                                                      <?php if ($r['id_reservasi'] == $p->reservasi_id) : ?>
                                                                           <table style="width: 100%;" class="table-responsive">
                                                                                <tr>
                                                                                     <td colspan="3"><?= $p->nama_produk; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                     <td width="35%">
                                                                                          Rp. <?= number_format($p->harga_produk, 0, '', '.'); ?>
                                                                                     </td>
                                                                                     <td width=15%">
                                                                                          x <?= $p->qty; ?>
                                                                                     </td>
                                                                                     <td width="50%">
                                                                                          <b>Subtotal: Rp. <?= number_format($p->subtotal, 0, '', '.'); ?></b>
                                                                                     </td>
                                                                                </tr>
                                                                           </table>
                                                                      <?php endif; ?>
                                                                 <?php endforeach; ?>
                                                            </td>
                                                            <td>
                                                                 <?php
                                                                 setlocale(LC_TIME, 'id_ID');
                                                                 $tglAcara = date_format(date_create($r['tgl_acara']), "d M Y");
                                                                 ?>
                                                                 <?= $tglAcara; ?>
                                                            </td>
                                                            <td>Rp. <?= number_format((float)$r['potongan_harga'], 0, '', '.'); ?></td>
                                                            <td>Rp. <?= number_format((float)$r['total_bayar'], 0, '', '.'); ?></td>
                                                            <td>
                                                                 <a href="<?= base_url('admin/reservasi/show/' . $r['id_reservasi']); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat Faktur" id="sw"><i class="fas fa-eye"></i></a>
                                                                 <a href="<?= base_url('admin/faktur_cetak/' . $r['id_reservasi']); ?>" class="btn btn-outline-success" target="blank"><i class="fas fa-print"></i></a>
                                                                 <a href="<?= base_url('admin/reservasi/remove/' . $r['id_reservasi']); ?>" class="btn btn-danger buttonDelete" data-toggle="tooltip" data-placement="top" title="Hapus Reservasi"><i class="fas fa-trash"></i></a>
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