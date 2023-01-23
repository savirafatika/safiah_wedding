<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= base_url('superadmin/blog'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Edit Blog</h1>
          </div>

          <div class="section-body">
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
                              <form class="needs-validation" novalidate="" action="<?= base_url('superadmin/blog/update/' . $blog['id_blog']); ?>" method="post">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">

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