<?php   namespace App\Models;
use CodeIgniter\Model;

class DetailTransaksiModel extends Model {
    protected $table = 'detail_transaksi';
    protected $allowedFields = ['transaksi_id', 'produk_id', 'jumlah', 'subtotal'];
}