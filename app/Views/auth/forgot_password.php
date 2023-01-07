<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
     <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
               <div class="login-brand">
                    <img src="<?= base_url(); ?>/assets/img/institusi.png" alt="logo" width="100" class="shadow-light rounded-circle">
               </div>

               <div class="card card-primary">
                    <div class="card-header">
                         <h4>Lupa Password</h4>
                    </div>
                    <?php if (session()->has('message')) : ?>
                         <div class="alert">
                              <div class="alert alert-success">
                                   <?= session('message') ?>
                              </div>
                         </div>
                    <?php endif ?>

                    <?php if (session()->has('error')) : ?>
                         <div class="alert">
                              <div class="alert alert-danger">
                                   <?= session('error') ?>
                              </div>
                         </div>
                    <?php endif ?>

                    <?php if (session()->has('errors')) : ?>
                         <div class="alert">
                              <ul class="alert alert-danger">
                                   <?php foreach (session('errors') as $error) : ?>
                                        <li><?= $error ?></li>
                                   <?php endforeach ?>
                              </ul>
                         </div>
                    <?php endif ?>
                    <div class="card-body">
                         <p class="text-muted">Kami akan mengirimkan link untuk mengatur ulang kata sandi Anda melalui email.</p>
                         <form method="POST" action="<?= url_to('forgot') ?>">
                              <?= csrf_field() ?>

                              <div class="form-group">
                                   <label for="email">Email</label>
                                   <input id="email" type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" tabindex="1" aria-describedby="emailHelp" required autofocus>
                                   <div class="invalid-feedback">
                                        <?= session('errors.email') ?>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Kirim permintaan reset password
                                   </button>
                              </div>

                         </form>
                    </div>
               </div>
               <div class="mt-5 text-muted text-center">
                    Kembali ke halaman <a href="<?= url_to('login') ?>">LOGIN</a>
               </div>
               <div class="simple-footer">
                    Copyright &copy; Safiah_Wedding 2023
               </div>
          </div>
     </div>
</div>

<?= $this->endSection(); ?>