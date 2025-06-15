<?php namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\ProdukModel; 
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class TransaksiController extends BaseController 
{
    public function bayar() {
        $keranjangModel = new KeranjangModel();
        $produkModel = new ProdukModel();
        $items = $keranjangModel->where('user_id', session('user_id'))->findAll();
        
        $data['keranjang_items'] = [];
        $total_harga = 0;
        foreach ($items as $item) {
            $produk = $produkModel->find($item['produk_id']);
            if ($produk) {
                $subtotal = $item['jumlah'] * $produk['harga'];
                $total_harga += $subtotal;
                $data['keranjang_items'][] = [
                    'produk_nama' => $produk['nama'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $produk['harga'],
                    'subtotal' => $subtotal
                ];
            }
        }
        $data['total_harga'] = $total_harga;

        return view('bayar', $data); 
    }

    public function prosesBayar() {
        $keranjang = new KeranjangModel();
        $produkModel = new ProdukModel();
        $items = $keranjang->where('user_id', session('user_id'))->findAll();

        if (empty($items)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = 0;
        foreach ($items as $i) {
            $produk = $produkModel->find($i['produk_id']);
            if ($produk) {
                $total += $i['jumlah'] * $produk['harga'];
            }
        }

        $metode_pembayaran = $this->request->getPost('metode_pembayaran'); 

        $transaksi = new TransaksiModel();
        $transaksi->save([
            'user_id' => session('user_id'),
            'total_harga' => $total,
            'metode_pembayaran' => $metode_pembayaran 
        ]);
        $idTransaksi = $transaksi->insertID();

        $detail = new DetailTransaksiModel();
        foreach ($items as $i) {
            $produk = $produkModel->find($i['produk_id']);
            if ($produk) {
                $detail->save([
                    'transaksi_id' => $idTransaksi,
                    'produk_id' => $i['produk_id'],
                    'jumlah' => $i['jumlah'],
                    'subtotal' => $i['jumlah'] * $produk['harga']
                ]);
            }
        }

        $keranjang->where('user_id', session('user_id'))->delete();

        return redirect()->to('/transaksi')->with('success', 'Pembayaran berhasil! Transaksi Anda sedang diproses.');
    }

    public function index() {
        $transaksi = new TransaksiModel();
        $data['transaksi'] = $transaksi->where('user_id', session('user_id'))->findAll();
        return view('transaksi', $data);
    }

    public function detail($transaksi_id) {
        $transaksiModel = new TransaksiModel();
        $detailTransaksiModel = new DetailTransaksiModel();
        $produkModel = new ProdukModel();

        $transaksi = $transaksiModel->find($transaksi_id);

        if (!$transaksi || $transaksi['user_id'] != session('user_id')) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $data['transaksi'] = $transaksi;
        $detail_items = $detailTransaksiModel->where('transaksi_id', $transaksi_id)->findAll();

        $data['detail_transaksi'] = [];
        foreach ($detail_items as $item) {
            $produk = $produkModel->find($item['produk_id']);
            if ($produk) {
                $data['detail_transaksi'][] = [
                    'produk_nama' => $produk['nama'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $produk['harga'],
                    'subtotal' => $item['subtotal']
                ];
            }
        }
        return view('detail_transaksi', $data);
    }
}