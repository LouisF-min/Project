<?php namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model {
    protected $table = 'produk';
    
    protected $allowedFields = ['nama', 'deskripsi', 'harga', 'stok', 'gambar'];
     protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}