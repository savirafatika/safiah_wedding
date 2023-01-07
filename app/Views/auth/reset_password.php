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
                         <h4>Reset Password</h4>
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
                         <p class="text-muted">Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda</p>
                         <form method="POST" action="<?= url_to('reset-password') ?>">
                              <?= csrf_field() ?>

                              <input type="hidden" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">

                              <div class="form-group">
                                   <label for="email">Email</label>
                                   <input id="email" type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" value="<?= old('email') ?>" tabindex="1" required autofocus>
                                   <div class="invalid-feedback">
                                        <?= session('errors.email') ?>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <label for="password">Password Baru</label>
                                   <div class="input-group" id="show_hide_password">
                                        <input id="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?> pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                                        <div class="input-group-prepend">
                                             <div class="input-group-text">
                                                  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                   </div>
                                   <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <label for="pass_confirm">Konfirmasi Password Baru</label>
                                   <div class="input-group" id="show_hide_password2">
                                        <input id="pass_confirm" type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" tabindex="2" required>
                                        <div class="input-group-prepend">
                                             <div class="input-group-text">
                                                  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="invalid-feedback">
                                        <?= session('errors.pass_confirm') ?>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Reset Password
                                   </button>
                              </div>

                         </form>
                    </div>
               </div>
               <div class="simple-footer">
                    Copyright &copy; Safiah_Wedding 2023
               </div>
          </div>
     </div>
</div>

<?= $this->endSection(); ?>