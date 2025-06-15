<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk Septa</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 20px;
            background: #f8f9fa;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .header h2 {
            color: #333;
            margin: 0 0 10px 0;
        }
        .navigation {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .nav-link {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-link:hover {
            background: #0056b3;
        }
        .logout-link {
            background: #dc3545;
        }
        .logout-link:hover {
            background: #c82333;
        }
        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .product-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 15px;
        }
        .btn-add {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .btn-add:hover {
            background: #218838;
        }
        .no-products {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar Produk Sepatu Store</h2>
        <p>Selamat datang! Pilih produk yang ingin Anda beli</p>
    </div>

    <div class="navigation">
        <a href="/keranjang" class="nav-link">Lihat Keranjang</a>
        <a href="/transaksi" class="nav-link">Riwayat Transaksi</a>
        <a href="/logout" class="nav-link logout-link">Logout</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($produk)): ?>
        <div class="no-products">
            <h3>Belum Ada Produk</h3>
            <p>Produk sedang dalam proses penambahan. Silakan cek kembali nanti.</p>
        </div>
    <?php else: ?>
        <div class="products-container">
            <?php foreach ($produk as $p): ?>
            <div class="product-card">
                <?php if (!empty($p['gambar'])): ?>
                    <img src="<?= base_url($p['gambar']); ?>" alt="<?= htmlspecialchars($p['nama']); ?>" class="product-image">
                <?php else: ?>
                    <img src="<?= base_url('images/placeholder.png'); ?>" alt="Tidak ada gambar" class="product-image">
                <?php endif; ?>
                
                <div class="product-name"><?= htmlspecialchars($p['nama']); ?></div>
                
                <?php if (!empty($p['deskripsi'])): ?>
                    <p class="product-description"><?= htmlspecialchars($p['deskripsi']); ?></p>
                <?php else: ?>
                    <p class="product-description">Deskripsi produk ini belum tersedia.</p>
                <?php endif; ?>

                <div class="product-price">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></div>
                
                <form action="/keranjang/tambah/<?= $p['id']; ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn-add">Tambah ke Keranjang</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
