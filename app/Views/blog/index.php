<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Daftar Blog</h1>
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
                                   <a href="<?= base_url('superadmin/blog/new'); ?>" class="btn btn-primary btn-icon icon-left" style="border-radius: 5px;">
                                        <i class="fas fa-user-plus"> Buat Blog baru</i>
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
                                                       <th>Judul</th>
                                                       <th>Deskripsi Singkat</th>
                                                       <th>Isi</th>
                                                       <th>Thumbnail</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $i = 1; ?>
                                                  <?php foreach ($blog as $b) : ?>
                                                       <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $b['judul']; ?></td>
                                                            <td><?= $b['deskripsi_singkat']; ?></td>
                                                            <td><?= $b['isi']; ?></td>
                                                            <td><img src="<?= base_url('images/thumbnail/' . $b['thumbnail']); ?>" alt="thumbnail_blog" width="20%" height="10%"></td>
                                                            <td>
                                                                 <a href="<?= base_url('superadmin/tag/edit/' . $b['id_tag']); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit tag" id="sw"><i class="fas fa-edit"></i></a>
                                                                 <a href="<?= base_url('superadmin/tag/remove/' . $b['id_tag']); ?>" class="btn btn-danger buttonDelete" data-toggle="tooltip" data-placement="top" title="Hapus tag"><i class="fas fa-trash"></i></a>
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