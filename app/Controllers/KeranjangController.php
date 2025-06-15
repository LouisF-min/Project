<?php

namespace App\Controllers;
use App\Models\KeranjangModel;

class KeranjangController extends BaseController
{
    public function index()
    {
        $model = new KeranjangModel();
        $data['keranjang'] = $model
            ->select('keranjang.*, produk.nama, produk.harga, produk.gambar')
            ->join('produk', 'produk.id = keranjang.produk_id')
            ->where('user_id', session('user_id'))
            ->findAll();

        return view('keranjang', $data); 
    }

    public function tambah($produk_id)
    {
        $model = new KeranjangModel();
        $model->save([
            'user_id'   => session('user_id'),
            'produk_id' => $produk_id,
            'jumlah'    => 1
        ]);
        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}