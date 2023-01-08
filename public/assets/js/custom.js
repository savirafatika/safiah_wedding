/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

const flashData = $('.flash-data').data('flashdata'); // CRUD success
const flashDanger = $('.flash-data-danger').data('flashdanger'); //CRUD errors


if (flashData) {
     Swal.fire({
          icon: 'success',
          title: 'Berhasil Disimpan.',
          html: flashData,
          timer: 3000
     })
  } else if (flashDanger) {
     Swal.fire({
          icon: 'error',
          title: 'Gagal Disimpan.',
          html: flashDanger,
          timer: 5000
     })
  }

// tombol hapus
$('.buttonDelete').on('click', function (e){
     e.preventDefault();
     const href = $(this).attr('href');
  
     Swal.fire({
     title: 'Apakah anda yakin?',
     text: "Data ini akan terhapus dan tidak bisa dikembalikan!",
     icon: 'warning',
     timer: 5000,
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Ya, Lanjut menghapus'
     }).then((result) => {
          if (result.value) {
          document.location.href = href;
          }
     })
});

$('.buttonResetPasUser').on('click', function (e){
     e.preventDefault();
     const href = $(this).attr('href');
  
     Swal.fire({
     title: 'Yakin ingin melanjutkan?',
     text: "Password pengguna akan direset menjadi password default!",
     icon: 'warning',
     timer: 5000,
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Ya, Lanjut!'
     }).then((result) => {
          if (result.value) {
          document.location.href = href;
          }
     })
});