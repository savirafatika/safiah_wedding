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
                         <h4><?= lang('Auth.loginTitle') ?></h4>
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
                         <form method="POST" action="<?= url_to('login') ?>" class="needs-validation" novalidate="">
                              <?= csrf_field() ?>

                              <?php if ($config->validFields === ['email']) : ?>
                                   <div class="form-group">
                                        <label for="login"><?= lang('Auth.email') ?></label>
                                        <input id="email" type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="john@gmail.com / doe_john" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                             <?= session('errors.login') ?>
                                        </div>
                                   </div>
                              <?php else : ?>
                                   <div class="form-group">
                                        <label for="login">Email / Username</label>
                                        <input id="email" type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="john@gmail.com / doe_john" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                             <?= session('errors.login') ?>
                                        </div>
                                   </div>
                              <?php endif; ?>

                              <div class="form-group">
                                   <div class="d-block">
                                        <label for="password" class="control-label"><?= lang('Auth.password') ?></label>
                                        <?php if ($config->activeResetter) : ?>
                                             <div class="float-right">
                                                  <a href="<?= url_to('forgot') ?>" class="text-small">
                                                       Lupa Password?
                                                  </a>
                                             </div>
                                        <?php endif; ?>
                                   </div>
                                   <div class="input-group" id="show_hide_password">
                                        <input id="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>" tabindex="2" required>
                                        <div class="input-group-prepend">
                                             <div class="input-group-text">
                                                  <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                   </div>
                              </div>

                              <?php if ($config->allowRemembering) : ?>
                                   <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" name="remember" class="custom-control-input <?php if (old('remember')) : ?> checked <?php endif ?>" tabindex="3" id="remember-me">
                                             <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                                        </div>
                                   </div>
                              <?php endif; ?>

                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        <?= lang('Auth.loginAction') ?>
                                   </button>
                              </div>
                         </form>

                    </div>
               </div>
               <?php if ($config->allowRegistration) : ?>
                    <div class="mt-5 text-muted text-center">
                         Tidak punya akun? <a href="<?= url_to('register') ?>">BUAT AKUN</a>
                    </div>
               <?php endif; ?>
               <div class="simple-footer">
                    Copyright &copy; Safiah_Wedding 2023
               </div>
          </div>
     </div>
</div>

<?= $this->endSection(); ?>