<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Kategori Produk</h1>
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
                                   <a href="<?= base_url('superadmin/kategori/new'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="fas fa-plus"> Buat Kategori Produk</i>
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
                                                       <th>Nama Kategori</th>
                                                       <th>Deskripsi Kategori</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($kategori as $k) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $k['nama_kategori']; ?></td>
                                                            <td><?= $k['deskripsi_kategori']; ?></td>
                                                            <td>
                                                                 <a href="<?= base_url('superadmin/kategori/edit/' . $k['id_kategori']); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Kategori" id="sw"><i class="fas fa-edit"></i></a>
                                                                 <a href="<?= base_url('superadmin/kategori/remove/' . $k['id_kategori']); ?>" class="btn btn-danger buttonDelete" data-toggle="tooltip" data-placement="top" title="Hapus kategori"><i class="fas fa-trash"></i></a>
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