<?php

namespace App\Controllers;

use App\Models\HadiahModel;
use App\Models\KategoriModel;
use App\Models\KlaimHadiahModel;
use App\Models\ProdukModel;
use App\Models\ProdukReservasiModel;
use App\Models\ReservasiModel;
use Config\Database;

class Home extends BaseController
{
    protected $reservasi, $db;

    public function __construct()
    {
        $this->reservasi = new ReservasiModel();
        $this->db = Database::connect();
    }

    public function index()
    {
        $data['title'] = 'Official Website';
        return view('index', $data);
    }

    public function order()
    {
        $produk = new ProdukModel();
        $data['title'] = 'Reservasi Sekarang';
        $data['produk'] = $produk->findAll();
        return view('reservasi', $data);
    }

    public function save_order()
    {
        $hadiahId = 0;
        $potongan_harga = 0;
        // lakukan validasi
        $rules = $this->reservasi->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $memberId = $this->request->getPost('member_id') ?? NULL;
        $kodeHadiah = $this->request->getPost('kode_hadiah') ?? '';

        $hadiahModel = new HadiahModel();
        $klaimHadiahModel = new KlaimHadiahModel();
        $query = $hadiahModel->where('kode_hadiah', $kodeHadiah)->first();
        $hadiahId = isset($query['id_hadiah']) ? $query['id_hadiah'] : NULL;
        $query2 = $klaimHadiahModel->where('hadiah_id', $hadiahId)->where('user_id', $memberId)->first();
        $hadiahIdKlaimHadiah = isset($query2['hadiah_id']) ? $query2['hadiah_id'] : NULL;

        $allowedPostFields = [
            'tgl_acara' => $this->request->getPost('tgl_acara'),
            'nama_pemesan' => $this->request->getPost('nama_pemesan'),
            'no_wa' => $this->request->getPost('no_wa'),
            'alamat' => $this->request->getPost('alamat'),
            'member_id' => $memberId,
            'hadiah_id' => $hadiahId
        ];

        if (!$this->reservasi->save($allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->reservasi->errors());
        }
        $reservasi_id = $this->reservasi->getInsertID();

        $produkReservasiModel = new ProdukReservasiModel();
        $produkModel = new ProdukModel();
        if ($this->request->getPost('produk_id') !== null) {
            $produkId = count($this->request->getPost('produk_id'));
            $total = 0;

            for ($i = 0; $i < $produkId; $i++) {
                $id_produks = $this->request->getPost('produk_id[' . $i . ']');
                $qtys = $this->request->getPost('qty[' . $i . ']');

                $query2 = $produkModel->where(
                    'id_produk',
                    $id_produks
                )->first();
                $hargas = isset($query2['harga']) ? $query2['harga'] : 0;
                $subtotals[$i] = $hargas * $qtys;

                $datas[$i] = array(
                    'reservasi_id' => $reservasi_id,
                    'produk_id' => $id_produks,
                    'qty' => $qtys,
                    'subtotal' => $subtotals[$i]
                );

                if (!$produkReservasiModel->save($datas[$i])) {
                    return redirect()->back()->withInput()->with('errors', $produkReservasiModel->errors());
                }
                $total += $subtotals[$i];
            }

            $total_bayar = $total;
            if ($hadiahId !== NULL) {
                $status_hadiah = $query['status'];
                $jenis_hadiah = $query['jenis_hadiah'];
                $nilai_hadiah = $query['nilai_hadiah'];

                if ($status_hadiah === 'on' && $hadiahId === $hadiahIdKlaimHadiah) {
                    if ($jenis_hadiah === 'khusus') {
                        $potongan_harga = 0;
                    } elseif ($jenis_hadiah === 'diskon_persen') {
                        $potongan_harga = ($nilai_hadiah / 100) * $total;
                    } elseif ($jenis_hadiah === 'diskon_rupiah') {
                        $potongan_harga = $nilai_hadiah;
                    }
                }

                $total_bayar = ($total - $potongan_harga);
            }
            // echo '<pre>';
            // print_r($potongan_harga);
            // die;

            $allowUpdate = [
                'potongan_harga' => $potongan_harga,
                'total_bayar' => $total_bayar,
            ];
            if (!$this->reservasi->update($reservasi_id, $allowUpdate)) {
                return redirect()->back()->withInput()->with('errors', $this->reservasi->errors());
            }
        }
        // Success!
        session()->setFlashdata('message', 'Anda berhasil membuat reservasi. Silahkan hubungi pihak WO!');
        return redirect()->to(base_url('reservasi_sekarang'));
    }

    public function galeri_sw()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        $data['title'] = 'Galeri Produk';
        $data['produk'] = $produkModel->findAll();
        $data['kategori'] = $kategoriModel->findAll();
        return view('galeri_sw', $data);
    }
}
