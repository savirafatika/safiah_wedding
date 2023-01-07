<?php

/**
 * Validation language strings.
 *
 * @package      CodeIgniter
 * @author       CodeIgniter Dev Team
 * @copyright    2014-2018 British Columbia Institute of Technology (https://bcit.ca/)
 * @license      https://opensource.org/licenses/MIT	MIT License
 * @link         https://codeigniter.com
 * @since        Version 3.0.0
 * @filesource
 * 
 * @codeCoverageIgnore
 */

return [
     // Core Messages
     'noRuleSets'            => 'Tidak ada aturan yang ditentukan dalam konfigurasi Validasi.',
     'ruleNotFound'          => '{0} bukan sebuah aturan yang valid.',
     'groupNotFound'         => '{0} bukan sebuah grup aturan validasi.',
     'groupNotArray'         => '{0} grup aturan harus berupa sebuah array.',
     'invalidTemplate'       => '{0} bukan sebuah template Validasi yang valid.',

     // Rule Messages
     'alpha'                 => '{field} hanya boleh mengandung karakter alfabet.',
     'alpha_dash'            => '{field} hanya boleh berisi karakter alfa-numerik, setrip bawah, dan tanda pisah.',
     'alpha_numeric'         => '{field} hanya boleh berisi karakter alfa-numerik.',
     'alpha_numeric_space'   => '{field} hanya boleh berisi karakter alfa-numerik dan spasi.',
     'alpha_space'                 => '{field} hanya boleh berisi karakter alfabet dan spasi.',
     'decimal'               => '{field} harus mengandung sebuah angka desimal.',
     'differs'               => '{field} harus berbeda dari {param}.',
     'exact_length'          => '{field} harus tepat {param} panjang karakter.',
     'greater_than'          => '{field} harus berisi sebuah angka yang lebih besar dari {param}.',
     'greater_than_equal_to' => '{field} harus berisi sebuah angka yang lebih besar atau sama dengan {param}.',
     'in_list'               => '{field} harus salah satu dari: {param}.',
     'integer'               => '{field} harus mengandung bilangan bulat.',
     'is_natural'            => '{field} hanya boleh berisi angka.',
     'is_natural_no_zero'    => '{field} hanya boleh berisi angka dan harus lebih besar dari nol.',
     'is_unique'             => '{field} harus mengandung sebuah nilai unik.',
     'less_than'             => '{field} harus berisi sebuah angka yang kurang dari {param}.',
     'less_than_equal_to'    => '{field} harus berisi sebuah angka yang kurang dari atau sama dengan {param}.',
     'matches'               => '{field} tidak cocok dengan {param}.',
     'max_length'            => '{field} tidak bisa melebihi {param} panjang karakter.',
     'min_length'            => '{field} setidaknya harus {param} panjang karakter.',
     'numeric'               => '{field} hanya boleh mengandung angka.',
     'regex_match'           => '{field} tidak dalam format yang benar.',
     'required'              => '{field} harus diisi.',
     'required_with'         => '{field} diperlukan saat {param} hadir.',
     'required_without'      => '{field} diperlukan saat {param} tidak hadir.',
     'timezone'              => '{field} harus berupa sebuah zona waktu yang valid.',
     'valid_base64'          => '{field} harus berupa sebuah string base64 yang valid.',
     'valid_email'           => '{field} harus berisi sebuah alamat email yang valid.',
     'valid_emails'          => '{field} harus berisi semua alamat email yang valid.',
     'valid_ip'              => '{field} harus berisi sebuah IP yang valid.',
     'valid_url'             => '{field} harus berisi sebuah URL yang valid.',
     'valid_date'            => '{field} harus berisi sebuah tanggal yang valid.',

     // Credit Cards
     'valid_cc_num'          => '{field} tidak tampak sebagai sebuah nomor kartu kredit yang valid.',

     // Files
     'uploaded'              => '{field} bukan sebuah berkas diunggah yang valid.',
     'max_size'              => '{field} terlalu besar dari sebuah berkas.',
     'is_image'              => '{field} bukan berkas gambar diunggah yang valid.',
     'mime_in'               => '{field} tidak memiliki sebuah tipe mime yang valid.',
     'ext_in'                => '{field} tidak memiliki sebuah ekstensi berkas yang valid.',
     'max_dims'              => '{field} bukan gambar, atau terlalu lebar atau tinggi.',
];
