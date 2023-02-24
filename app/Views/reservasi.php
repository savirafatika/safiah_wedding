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
    /* label focus color */
    .input-field input:focus+label,
    .materialize-textarea:focus:not([readonly])+label {
      color: #673ab7 !important;
    }

    /* label underline focus color */
    .row .input-field input:focus,
    .materialize-textarea:focus:not([readonly]) {
      border-bottom: 1px solid #673ab7 !important;
      box-shadow: 0 1px 0 0 #673ab7 !important
    }

    [type="checkbox"]:checked+span:not(.lever):before {
      border-right: 2px solid #673ab7 !important;
      border-bottom: 2px solid #673ab7 !important;
    }

    .datepicker-date-display {
      background-color: #673ab7
    }

    .datepicker-day-button:focus {
      color: white !important;
      background-color: #673ab7
    }

    .datepicker-done,
    .datepicker-cancel,
    .select-dropdown li>span,
    .is-today {
      color: #673ab7 !important
    }

    td.is-selected,
    .month-prev:active,
    .month-prev:focus,
    .month-next:active,
    .month-next:focus {
      background-color: #673ab7 !important
    }

    td.is-selected.is-today {
      color: white !important
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
      <a href="#" data-target="nav-mobile" class="sidenav-trigger deep-purple-text"><i class="material-icons">menu</i></a>
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
          <h4>Formulir Reservasi</h4><br><br>
          <?php if (session()->has('message')) : ?>
            <div class="flash-data" data-flashdata="<?= session('message'); ?>"></div>
          <?php endif ?>
          <?php if (session()->has('errors')) : ?>
            <div class="alert">
              <ul class="alert alert-danger collection">
                <?php foreach (session('errors') as $error) : ?>
                  <li class="collection-item"><?= $error ?></li>
                <?php endforeach ?>
              </ul>
            </div>
          <?php endif ?>
          <form class="needs-validation" novalidate="" action="<?= route_to('save_order') ?>" method="post">
            <?= csrf_field(); ?>

            <div class="input-field col s12">
              <input id="nama_pemesan" name="nama_pemesan" type="text" class="validate">
              <label for="nama_pemesan">Nama Pemesan</label>
              <span class="helper-text" data-error="<?= session('errors.nama_pemesan'); ?>" data-success="right"></span>
            </div>
            <div class="input-field col s12">
              <input id="no_wa" name="no_wa" type="text" class="validate" onkeypress="return isNumberKey(event)">
              <label for="no_wa">Nomor Whatsapp</label>
            </div>
            <div class="input-field col s12">
              <textarea id="alamat" name="alamat" class="materialize-textarea validate"></textarea>
              <label for="alamat">Alamat</label>
            </div>
            <div class="input-field col s12">
              <select name="produk_id[]" id="produk_reservasi" class="icons" multiple>
                <option value="" disabled selected>Pilih Produk</option>
                <?php foreach ($produk as $p) : ?>
                  <option value="<?= $p['id_produk']; ?>" data-icon="<?= base_url('images/katalog/' . $p['foto_produk']); ?>" class="left">
                    <?= $p['nama_produk']; ?> &ensp; | Rp.
                    <?= number_format($p['harga'], 0, '', '.'); ?>
                  </option>
                <?php endforeach ?>
              </select>
              <label>Produk</label>
              <div class="table-responsive">
                <table class="responsive-table tabelProduk">
                  <thead>
                    <tr>
                      <th>Produk</th>
                      <th>QTY</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
            <div class="input-field col s12">
              <input id="tgl_acara" name="tgl_acara" type="text" class="datepicker validate">
              <label for="tgl_acara">Tanggal Acara</label>
            </div>
            <button class="btn btn-large waves-effect waves-light deep-purple lighten-1 col s12" type="submit" name="action">Kirim Sekarang</button>

          </form>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?= base_url(); ?>/assets/js/custom.js"></script>
  <script src="<?= base_url(); ?>/assets/js-materialize/materialize.js"></script>
  <script src="<?= base_url(); ?>/assets/js-materialize/init.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.datepicker');
      var instances = M.Datepicker.init(elems, {
        format: 'yyyy-mm-dd'
      });
      var elems2 = document.querySelectorAll('select');
      var instances2 = M.FormSelect.init(elems2, {
        isMultiple: true
      });
    });

    // Or with jQuery
    $(document).ready(function() {
      $('.datepicker').datepicker();
      $('select').formSelect();
      $('.tabelProduk').hide();

      $('#produk_reservasi').on('change', function(e) {
        var dataId = $(this).val();
        var dataText = $('#produk_reservasi option:selected').text();
        // console.log(dataId);

        var tr = '<tr class="' + dataId + '" id="rowData">' +
          '<td>' + dataText + '</td>' +
          '<td class="input-field col s12"><input type="number" class="validate' +
          '" name="qty[]" id="qty" placeholder="0">' +
          '</td>' +
          '<td>' +
          '<button class="btn-floating waves-effect waves-light deep-purple lighten-1" type="button" id="removeProduk" onclick="hapusItem(' + dataId + ')"><i class="material-icons">remove</i></button>' +
          '</td>' +
          '<tr>';

        if (dataId.length > 0) {
          $('.tabelProduk').show();
          $('.tabelProduk').find('tbody').append(tr);
        } else {
          $('.tabelProduk').hide();
        }
      });
    });

    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      if (charCode === 44 || charCode === 46 || (48 <= charCode && charCode <= 57)) {
        return true;
      }
      return false;
    }

    function hapusItem(dataId) {
      // console.log(dataId);
      $('.' + dataId).remove();
    }
  </script>

</body>

</html>