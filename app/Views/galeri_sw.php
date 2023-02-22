<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Safiah_Wedding <?= '| ' . $title; ?></title>
  <link rel="icon" href="<?= base_url(); ?>/assets/img/institusi.png" type="image/png">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?= base_url(); ?>/assets/css-materialize/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="<?= base_url(); ?>/assets/css-materialize/style.css" type="text/css" rel="stylesheet" media="screen,projection" />

  <!-- galeri produk -->
  <style>
    .gallery {
      -webkit-column-count: 4;
      -moz-column-count: 4;
      column-count: 4;
      -webkit-column-width: 25%;
      -moz-column-width: 25%;
      column-width: 25%;
    }

    .gallery .pics {
      -webkit-transition: all 350ms ease;
      transition: all 350ms ease;
    }

    .gallery .animation {
      -webkit-transform: scale(1);
      -ms-transform: scale(1);
      transform: scale(1);
    }

    @media (max-width: 450px) {
      .gallery {
        -webkit-column-count: 1;
        -moz-column-count: 1;
        column-count: 1;
        -webkit-column-width: 100%;
        -moz-column-width: 100%;
        column-width: 100%;
      }
    }

    @media (max-width: 400px) {
      .btn.filter {
        padding-left: 1.1rem;
        padding-right: 1.1rem;
      }
    }
  </style>
</head>

<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?= route_to('landingpage'); ?>" class="brand-logo">safiahwedding</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?= route_to('galeri_sw'); ?>">Galeri Produk</a></li>
        <li><a href="<?= route_to('order'); ?>">Reservasi</a></li>
        <li><a href="<?= route_to('login'); ?>">Masuk</a></li>
        <li><a href="<?= route_to('register'); ?>">Daftar</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="<?= route_to('galeri_sw'); ?>">Galeri Produk</a></li>
        <li><a href="<?= route_to('order'); ?>">Reservasi</a></li>
        <li><a href="<?= route_to('login'); ?>">Masuk</a></li>
        <li><a href="<?= route_to('register'); ?>">Daftar</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center deep-purple-text text-lighten-1" style="font-weight: 500; text-shadow: 15px;">Hai, Kepoin WO Kami Yuk!</h1>
        <div class="row center">
          <h5 class="header col s12" style="font-weight: 600; text-shadow: 15px;">Terencana, Tepat Waktu dan Bisa Diandalkan untuk Mengawal Hari Bahagiamu</h5>
        </div>
        <div class="row center">
          <a href="<?= route_to('order'); ?>" id="download-button" class="btn-large waves-effect waves-light deep-purple lighten-1">Reservasi Sekarang</a>
        </div>
        <br><br>

      </div>
    </div>
    <div style="background-color: black; opacity: 80%;" class="parallax"><img src="<?= base_url(); ?>/assets/img-materialize/c.jpg" alt="Unsplashed background img 1"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h4>Galeri Produk</h4><br><br>

          <!-- Grid row -->
          <div class="row">

            <!-- Grid column -->
            <div class="col-md-12 d-flex justify-content-center mb-5">
              <button type="button" class="btn btn-outline-black waves-effect filter deep-purple" data-rel="all">All</button>
              <?php foreach ($kategori as $k) : ?>
                <button type="button" class="btn btn-outline-black waves-effect filter deep-purple" data-rel="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></button>
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
      </div>

    </div>
  </div>

  <footer class="page-footer deep-purple">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Safiah Wedding</h5>
          <p class="grey-text text-lighten-4">Kami menyediakan jasa rias acara, sewa busana pengantin dan sewa properti WO. Semakin meluasnya bisnis kami, kami membutuhkan alat sebagai media bertukar informasi dengan pelanggan. Dibuatlah website ini sekaligus menunjang kemudakan transaksi pemesanan pelanggan.</p>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Fitur</h5>
          <ul style="text-transform: uppercase;">
            <li><a class="white-text" href="<?= route_to('register'); ?>">Daftar Member</a></li>
            <li><a class="white-text" href="<?= route_to('order'); ?>">Reservasi</a></li>
            <li><a class="white-text" href="<?= route_to('galeri_sw'); ?>">Produk Kami</a></li>
            <li><a class="white-text" href="<?= route_to('login'); ?>">Masuk Member Area</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Kontak Kami</h5>
          <ul>
            <li><a class="white-text" href="https://goo.gl/maps/PKLgRLhox9YvUs3V8"><i class="tiny material-icons">location_on</i> Jalan Arif Rahman Hakim, Desa Tuan-Tuan, Kec. Benua Kayong, Kota Ketapang, Kalimantan Barat, 78822</a></li>
            <li><a class="white-text" href="#!"><i class="tiny material-icons">phone</i> 081344541714</a></li>
            <li><a class="white-text" href="https://wa.me/6289698721891"><b>WA</b> 089698721891</a></li>
            <li><a class="white-text" href="https://www.instagram.com/safiah_wedding/"><b>IG</b> @safiah_wedding</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        Copyright &copy; <a class="brown-text text-lighten-3" href="<?= route_to('landingpage'); ?>">Safiah_Wedding 2023</a>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js-materialize/materialize.js"></script>
  <script src="<?= base_url(); ?>/assets/js-materialize/init.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // galerry filter
      var selectedClass = "";
      $(".filter").click(function() {
        selectedClass = $(this).attr("data-rel");
        $("#gallery").fadeTo(100, 0.1);
        $("#gallery div").not("." + selectedClass).fadeOut().removeClass('animation');
        setTimeout(function() {
          $("." + selectedClass).fadeIn().addClass('animation');
          $("#gallery").fadeTo(300, 1);
        }, 300);
      });
    });
  </script>

</body>

</html>