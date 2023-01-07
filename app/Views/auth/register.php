<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
     <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
               <div class="login-brand">
                    <img src="<?= base_url(); ?>/assets/img/institusi.png" alt="logo" width="100" class="shadow-light rounded-circle">
               </div>

               <div class="card card-primary">
                    <div class="card-header">
                         <h4><?= lang('Auth.register') ?></h4>
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
                         <form action="<?= url_to('register') ?>" method="POST">
                              <?= csrf_field() ?>

                              <div class="form-group">
                                   <label for="fullname">Nama Lengkap</label>
                                   <input id="fullname" type="text" class="form-control <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" placeholder="John Doe" value="<?= old('fullname') ?>" autofocus>
                              </div>

                              <div class="form-group">
                                   <label for="email"><?= lang('Auth.email') ?></label>
                                   <input id="email" type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="john@gmail.com" value="<?= old('email') ?>">
                                   <small id="emailHelp" class="form-text text-muted">Kami tidak akan pernah membagikan email Anda kepada orang lain.</small>
                              </div>

                              <div class="form-group">
                                   <label for="username">Username</label>
                                   <input id="username" type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="doe_john" value="<?= old('username') ?>" autofocus>
                              </div>

                              <div class="row">
                                   <div class="form-group col-6">
                                        <label for="password" class="d-block"><?= lang('Auth.password') ?></label>
                                        <div class="input-group" id="show_hide_password">
                                             <input id="password" type="password" class="form-control pwstrength <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" data-indicator="pwindicator" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                             <div class="input-group-prepend">
                                                  <div class="input-group-text">
                                                       <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                             <div class="bar"></div>
                                             <div class="label"></div>
                                        </div>
                                   </div>
                                   <div class="form-group col-6">
                                        <label for="pass_confirm" class="d-block">Konfirmasi Password</label>
                                        <div class="input-group" id="show_hide_password2">
                                             <input id="password2" type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Konfirmasi Password" autocomplete="off">
                                             <div class="input-group-prepend">
                                                  <div class="input-group-text">
                                                       <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <?= lang('Auth.register') ?>
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