<?php

namespace App\Controllers;

use App\Models\HadiahModel;
use App\Models\KlaimHadiahModel;
use App\Models\ProdukModel;
use App\Models\ProdukReservasiModel;
use App\Models\ReservasiModel;
use CodeIgniter\RESTful\ResourcePresenter;
use Config\Database;

class Pesanan extends ResourcePresenter
{
    protected $reservasi, $db;

    public function __construct()
    {
        $this->reservasi = new ReservasiModel();
        $this->db = Database::connect();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = 'Reservasi Pengguna';
        $data['reservasi'] = $this->reservasi->where('member_id', user_id())->findAll();

        $builder = $this->db->table('produk_reservasi as pr')->select('pr.*, pd.nama_produk, pd.harga as harga_produk, r.member_id')
            ->join('produk as pd', 'pd.id_produk = pr.produk_id')
            ->join('reservasi as r', 'r.id_reservasi = pr.reservasi_id')
            ->where('r.member_id', user_id())
            ->get();
        $data['produk_reservasi'] = $builder->getResult();
        // echo '<pre>';
        // print_r($data);
        // die;

        return view('pesanan/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id_reservasi = null)
    {
        $data['title'] = 'Cetak Reservasi';
        $data['reservasi'] = $this->reservasi->select('reservasi.*, users.*, hadiah.*, reservasi.created_at as tgl_reservasi')
            ->join('users', 'users.id = reservasi.member_id', 'left')
            ->join('hadiah', 'hadiah.id_hadiah = reservasi.hadiah_id', 'left')
            ->where('id_reservasi', $id_reservasi)
            ->first();

        $builder = $this->db->table('produk_reservasi as pr')->select('pr.*, pd.nama_produk, pd.harga as harga_produk, r.potongan_harga, r.total_bayar')
            ->join('reservasi as r', 'r.id_reservasi = pr.reservasi_id')
            ->join('produk as pd', 'pd.id_produk = pr.produk_id')
            ->where('reservasi_id', $id_reservasi)
            ->get();
        $data['produk_reservasi'] = $builder->getResultArray();

        return view('pesanan/show', $data);
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $produk = new ProdukModel();
        $data['title'] = 'Tambah Reservasi';
        $data['produk'] = $produk->findAll();
        return view('pesanan/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $hadiahId = 0;
        $hadiahNotActive = '';
        $hadiahIdNotFound = '';
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
                } else {
                    $hadiahNotActive = 'Hadiah tidak aktif! ';
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

        if ($hadiahId === NULL) {
            $hadiahIdNotFound = 'Kode hadiah tidak ditemukan, anda tidak dapat menggunakan untuk transaksi ini! ';
        }
        // Success!
        session()->setFlashdata('message', 'Berhasil membuat reservasi baru. ' . $hadiahIdNotFound . $hadiahNotActive);
        return redirect()->to(base_url('user/reservasi_pengguna'));
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id_reservasi = null)
    {
        if ($id_reservasi != null && $id_reservasi > 0) {
            return $this->delete($id_reservasi);
        }
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id_reservasi = null)
    {
        $this->reservasi->where('id_reservasi', $id_reservasi)->delete();
        session()->setFlashdata('message', 'Berhasil menghapus reservasi');
        return redirect()->to(base_url('user/reservasi_pengguna'));
    }
}
