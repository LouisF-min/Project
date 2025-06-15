<?php namespace App\Models;
use CodeIgniter\Model;

class TransaksiModel extends Model {
    protected $table = 'transaksi';
    protected $allowedFields = ['user_id', 'total_harga','tanggal','metode_pembayaran'];
    protected $useTimestamps = true;
}