<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<!-- Main Content -->
<div class="main-content">
     <section class="section">
          <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                         <div class="card-stats">
                              <div class="card-stats-title">Statistik Reservasi</div>
                              <div class="card-stats-items">
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countTodayStatReservasi; ?></div>
                                        <div class="card-stats-item-label">Hari Ini</div>
                                   </div>
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countThisMonthStatReservasi; ?></div>
                                        <div class="card-stats-item-label">Satu Bulan</div>
                                   </div>
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countThisYearStatReservasi; ?></div>
                                        <div class="card-stats-item-label">Satu Tahun</div>
                                   </div>
                              </div>
                         </div>
                         <div class="card-icon shadow-primary bg-primary">
                              <i class="fas fa-archive"></i>
                         </div>
                         <div class="card-wrap">
                              <div class="card-header">
                                   <h4>Total Reservasi</h4>
                              </div>
                              <div class="card-body">
                                   <?= $countAllStatReservasi; ?>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                         <div class="card-stats">
                              <div class="card-stats-title">Statistik Member Terdaftar</div>
                              <div class="card-stats-items">
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countTodayStatMember; ?></div>
                                        <div class="card-stats-item-label">Hari Ini</div>
                                   </div>
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countThisMonthStatMember; ?></div>
                                        <div class="card-stats-item-label">Satu Bulan</div>
                                   </div>
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countThisYearStatMember; ?></div>
                                        <div class="card-stats-item-label">Satu Tahun</div>
                                   </div>
                              </div>
                         </div>
                         <div class="card-icon shadow-primary bg-primary">
                              <i class="fas fa-user"></i>
                         </div>
                         <div class="card-wrap">
                              <div class="card-header">
                                   <h4>Total Member</h4>
                              </div>
                              <div class="card-body">
                                   <?= $countAllStatMember; ?>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                         <div class="card-stats">
                              <div class="card-stats-title">Statistik Produk Reservasi</div>
                              <div class="card-stats-items">
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countTodayStatProdukReservasi; ?></div>
                                        <div class="card-stats-item-label">Hari Ini</div>
                                   </div>
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countThisMonthProdukReservasi; ?></div>
                                        <div class="card-stats-item-label">Satu Bulan</div>
                                   </div>
                                   <div class="card-stats-item">
                                        <div class="card-stats-item-count"><?= $countThisYearProdukReservasi; ?></div>
                                        <div class="card-stats-item-label">Satu Tahun</div>
                                   </div>
                              </div>
                         </div>
                         <div class="card-icon shadow-primary bg-primary">
                              <i class="fas fa-shopping-bag"></i>
                         </div>
                         <div class="card-wrap">
                              <div class="card-header">
                                   <h4>Total Produk Reservasi</h4>
                              </div>
                              <div class="card-body">
                                   <?= $countAllProdukReservasi; ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-lg-6 col-md-12 col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>Kategori Produk Reservasi Terpopuler</h4>
                         </div>
                         <div class="card-body">
                              <?php foreach ($kategoriProdukPopuler as $kpp) : ?>
                                   <div class="mb-4">
                                        <div class="text-small float-right font-weight-bold text-muted"><?= $kpp['total']; ?></div>
                                        <div class="font-weight-bold mb-1"><?= $kpp['nama_kategori']; ?></div>
                                        <div class="progress" data-height="3">
                                             <div class="progress-bar" role="progressbar" data-width="<?= round(($kpp['total'] / $totalKategoriProdukPopuler) * 100, 1); ?>%" aria-valuenow="<?= round(($kpp['total'] / $totalKategoriProdukPopuler) * 100, 1); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                   </div>
                              <?php endforeach; ?>
                         </div>
                    </div>
               </div>
               <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>Produk Terlaris</h4>
                         </div>
                         <div class="card-body">
                              <div class="row pb-3">
                                   <?php foreach ($produkTerlaris as $pt) : ?>
                                        <div class="col-6 col-sm-3 col-lg-3 mb-md-0">
                                             <div class="foto_produk" style="width: 100%; height: 100%; overflow: hidden; border-radius: 3%;">
                                                  <img alt="image_produk" src="<?= base_url('images/katalog/' . $pt['foto_produk']); ?>" style="height: 100%; width: 100%; object-fit: cover">
                                             </div>
                                             <div class="nama_dan_jumlah">
                                                  <b style="text-transform: uppercase;"><?= $pt['nama_produk']; ?></b> (<?= $pt['jumlah']; ?>)
                                             </div>
                                        </div>
                                   <?php endforeach; ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</div>

<?= $this->endSection(); ?>