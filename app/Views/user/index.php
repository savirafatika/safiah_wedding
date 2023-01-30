<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="section-header">
               <h1>Galeri Produk</h1>
          </div>

          <div class="section-body">

               <!-- Grid row -->
               <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-12 d-flex justify-content-center mb-5">
                         <button type="button" class="btn btn-outline-black waves-effect filter" data-rel="all">All</button>
                         <?php foreach ($kategori as $k) : ?>
                              <button type="button" class="btn btn-outline-black waves-effect filter" data-rel="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></button>
                         <?php endforeach; ?>
                    </div>
                    <!-- Grid column -->

               </div>
               <!-- Grid row -->

               <!-- Grid row -->
               <div class="gallery" id="gallery">

                    <?php foreach ($produk as $p) : ?>
                         <!-- Grid column -->
                         <div class="mb-3 pics animation all <?= $p['kategori_id']; ?>">
                              <img class="img-fluid" src="<?= base_url('images/katalog/' . $p['foto_produk']); ?>" alt="Card image cap" width="100%">
                         </div>
                         <!-- Grid column -->
                    <?php endforeach; ?>

               </div>
               <!-- Grid row -->

          </div>
     </section>
</div>

<?= $this->endSection(); ?>