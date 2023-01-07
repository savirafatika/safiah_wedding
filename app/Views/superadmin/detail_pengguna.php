<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <div class="section-header-back">
                    <a href="<?= route_to('daftar_pengguna'); ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
               </div>
               <h1>Detail Pengguna</h1>
          </div>

          <div class="section-body">
               <div class="row">
                    <div class="col-lg-6">
                         <div class="card card-large-icons">
                              <div class="card-icon bg-primary text-white">
                                   <img src="https://ui-avatars.com/api/?background=6777EF&color=ffffff&name=<?= $user->fullname; ?>">
                              </div>
                              <div class="card-body">
                                   <h4><?= $user->fullname; ?></h4> <br>
                                   <table border="0">
                                        <tr>
                                             <td>Email</td>
                                             <td>:</td>
                                             <td>&ensp;<?= $user->email; ?> </td>
                                        </tr>
                                        <tr>
                                             <td>Username</td>
                                             <td>:</td>
                                             <td>&ensp;<?= $user->username; ?></td>
                                        </tr>
                                        <tr>
                                             <td>Status</td>
                                             <td>:</td>
                                             <td>&ensp; <span class="badge badge-<?= ($user->active = 1) ? 'success' : 'secondary'; ?>"><?= ($user->active = 1) ? 'aktif' : 'tidak aktif'; ?></span></td>
                                        </tr>
                                   </table> <br>
                                   <p>Sebagai <?= $user->name; ?> Sejak <?= date('d F Y', strtotime($user->terdaftar)); ?></p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>

<?= $this->endSection(); ?>