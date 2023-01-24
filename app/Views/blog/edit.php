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
                              <form class="needs-validation" novalidate="" action="<?= base_url('superadmin/blog/update/' . $blog['id_blog']); ?>" method="post" enctype="multipart/form-data">
                                   <?= csrf_field(); ?>

                                   <div class="card-header">
                                        <h4>Mohon mengisi form dengan benar dan lengkap!</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="form-group row">
                                             <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.judul')) : ?>is-invalid<?php endif ?>" name="judul" id="judul" value="<?= $blog['judul']; ?>">
                                                  <?php if (session('errors.judul')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.judul') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="deskripsi_singkat" class="col-sm-3 col-form-label">Deskripsi Singkat</label>
                                             <div class="col-sm-9">
                                                  <input type="text" class="form-control <?php if (session('errors.deskripsi_singkat')) : ?>is-invalid<?php endif ?>" name="deskripsi_singkat" id="deskripsi_singkat" value="<?= $blog['deskripsi_singkat']; ?>">
                                                  <?php if (session('errors.deskripsi_singkat')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.deskripsi_singkat') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="isi" class="col-sm-3 col-form-label">Isi</label>
                                             <div class="col-sm-9">
                                                  <textarea name="isi" id="isi" class="summernote-simple <?php if (session('errors.isi')) : ?>is-invalid<?php endif ?>"><?= $blog['isi']; ?></textarea>
                                                  <?php if (session('errors.isi')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.isi') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="tag" class="col-sm-3 col-form-label">Tag</label>
                                             <div class="col-sm-9">
                                                  <select class="form-control selectric <?php if (session('errors.tag')) : ?>is-invalid<?php endif ?>" name="tag[]" id="tag" multiple="">
                                                       <option value="" selected data-default>Pilih Tag</option>
                                                       <?php foreach ($tag as $g) : ?>
                                                            <?php foreach ($tagOption as $t) : ?>
                                                                 <?php
                                                                 $selectedTag = '';
                                                                 // if (in_array($g->tag_id, $t)) {
                                                                 //      $selectedTag = 'selected';
                                                                 // }
                                                                 if ($g->tag_id == $t['id_tag']) {
                                                                      $selectedTag = 'selected';
                                                                 }
                                                                 ?>
                                                                 <option value="<?= $t['id_tag']; ?>" <?= $selectedTag; ?>><?= $t['nama_tag']; ?></option>
                                                            <?php endforeach ?>
                                                       <?php endforeach ?>
                                                  </select>
                                                  <?php if (session('errors.tag')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.tag') ?>
                                                       </div>
                                                  <?php endif ?>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label for="thumbnail" class="col-sm-3 col-form-label">Thumbnail</label>
                                             <div class="col-sm-9">
                                                  <input type="file" id="thumbnail" name="thumbnail" class="form-control thumbnail <?php if (session('errors.thumbnail')) : ?>is-invalid<?php endif ?>" accept=".jpg,.png,.jpeg" value="" onchange="readURL(this);" />
                                                  <!-- <div id="image-preview" class="image-preview">
                                                       <label for="image-upload" id="image-label">Choose File</label>
                                                       <input type="file" id="image-upload" name="thumbnail" class="<?php if (session('errors.thumbnail')) : ?>is-invalid<?php endif ?>" />
                                                       </div> -->
                                                  <?php if (session('errors.thumbnail')) : ?>
                                                       <div class="invalid-feedback">
                                                            <?= session('errors.thumbnail') ?>
                                                       </div>
                                                  <?php endif ?>
                                                  <br>
                                                  <img id="preview_thumbnail" src="<?= base_url('images/thumbnail/' . $blog['thumbnail']); ?>" alt="thumbnail image" width="250" />
                                             </div>
                                        </div>
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