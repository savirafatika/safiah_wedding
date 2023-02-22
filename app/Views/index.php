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
  <style>
    .parallax-container {
      height: 30vh !important;
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

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons deep-purple-text">flash_on</i></h2>
            <h5 class="center">Reservasi Online</h5>

            <p class="light" style="text-align: justify; text-indent: 0.5in;">Selain On Call dan via chat wa, sekarang safiah wedding sudah bisa reservasi lewat website ini loh. Tapi jangan lupa ya setelah reservasi kamu konfirmasi ke kontak kami jika kami tidak menghubungi > 2 hari setelah reservasi.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons deep-purple-text">group</i></h2>
            <h5 class="center">Royaliti untuk Member</h5>

            <p class="light" style="text-align: justify; text-indent: 0.5in;">Ada yang menarik lagi, disini kamu bisa dapat harga spesial jika sudah menjadi member. Kamu bisa klaim hadiah dan gunakan direservasi berikutnya. Kamu juga bisa melihat riwayat reservasimu setelah masuk ke akun member. Masih Banyak yang seru-seru berhadiah pokoknya. Daftarnya gampang kok cuma butuh email dan isi form daftarmu setelaah klik Daftar</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons deep-purple-text">settings</i></h2>
            <h5 class="center">Informasi Produk Mudah</h5>

            <p class="light" style="text-align: justify; text-indent: 0.5in;">Kami menyediakan daftar produk di instagram dan di website ini. Akses informasimu lebih mudah dan secara real time menampilkan produk terbaru yang ada di WO kami, jadi kamu bisa lihat produk nya dari rumah sobat.</p>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12" style="font-weight: 600; text-shadow: 15px;">Sewa baju pengantin? OK. Jasa rias pengantin? OK. Sewa properti pernikahan? OK. Kami Siap!</h5>
        </div>
      </div>
    </div>
    <div style="background-color: black; opacity: 80%;" class="parallax"><img src="<?= base_url(); ?>/assets/img-materialize/a.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h4>Tentang Kami</h4>
          <p class="light" style="text-align: justify; text-indent: 0.7in;">Safiah Wedding didirikan oleh Safiah pada tahun 2013 yang berada di Kabupaten Ketapang, beralamat di jalan Arif Rahman Hakim, Desa Tuan-Tuan, Kecamatan Benua Kayong, Kota Ketapang, Kalimantan Barat. Toko ini awalnya hanya menyediakan penyewaan baju pengantin dan dekorasi. Seiring dengan berjalannya waktu Safiah Wedding mengalami perkembangan usaha jasa yang awalnya hanya menyediakan jasa penyewaan baju pengantin sekarang berkembang pesat dengan menyediakan penyewaan diberbagai macam diantaranya jasa make-up, penyewaan tenda, penyewaan tempat prasmanan, penyewaan jamang dengan berbgai macam jamang yang diinginkan dan semua yang dibutuhkan dalam wedding organizer.</p>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12" style="font-weight: 600; text-shadow: 15px;">Mau dapat potongan harga? Daftar member syaratnya punya email!</h5>
        </div>
      </div>
    </div>
    <div style="background-color: black; opacity: 80%;" class="parallax"><img src="<?= base_url(); ?>/assets/img-materialize/b.jpg" alt="Unsplashed background img 3"></div>
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
  <script src="text/javascript">
    $(document).ready(function() {
      $('.parallax').parallax();
    });
  </script>

</body>

</html>