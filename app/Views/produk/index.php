<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Produk</h1>
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
                                   <a href="<?= base_url('superadmin/produk/new'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="fas fa-plus"> Buat Produk baru</i>
                                   </a>
                              </div>
                              <div class="card-body">
                                   <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                             <thead>
                                                  <tr>
                                                       <th class="text-center" width="3%"> # </th>
                                                       <th width=10%">Nama Produk</th>
                                                       <th width="35%">Deskripsi</th>
                                                       <th width="15%">harga</th>
                                                       <th width="7%">Kategori</th>
                                                       <th width="20%">Foto Produk</th>
                                                       <th width="10%">Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($produk as $p) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $p['nama_produk']; ?></td>
                                                            <td><?= $p['deskripsi']; ?></td>
                                                            <td>Rp. <?= number_format($p['harga'], 0, '', '.'); ?></td>
                                                            <td>
                                                                 <?php foreach ($kategori as $k) : ?>
                                                                      <?php if (($p['kategori_id'] == $k->id_kategori) && ($p['id_produk'] == $k->id_produk)) : ?>
                                                                           <span class="badge badge-light mb-1">
                                                                                <?= $k->nama_kategori; ?>
                                                                           </span>
                                                                      <?php endif; ?>
                                                                 <?php endforeach; ?>
                                                            </td>
                                                            <td><img src="<?= base_url('images/katalog/' . $p['foto_produk']); ?>" alt="foto_produk_produk" width="70%" style="padding: 10px;"></td>
                                                            <td>
                                                                 <a href="<?= base_url('superadmin/produk/edit/' . $p['id_produk']); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Produk" id="sw"><i class="fas fa-edit"></i></a>
                                                                 <a href="<?= base_url('superadmin/produk/remove/' . $p['id_produk']); ?>" class="btn btn-danger buttonDelete" data-toggle="tooltip" data-placement="top" title="Hapus Produk"><i class="fas fa-trash"></i></a>
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