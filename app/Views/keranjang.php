<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
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
            margin: 0;
        }
        .navigation {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .nav-link {
            padding: 10px 20px;
            background:rgb(50, 138, 215);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-link:hover {
            background: #545b62;
        }
        .logout-link {
            background: #dc3545;
        }
        .logout-link:hover {
            background: #c82333;
        }
        .cart-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .empty-cart {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        .empty-cart h3 {
            color: #333;
            margin-bottom: 15px;
        }
        .cart-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            background: #f8f9fa;
        }
        .cart-item img {
            max-width: 80px;
            height: auto;
            margin-right: 15px;
            border-radius: 4px;
            vertical-align: middle;
        }
        .cart-item strong {
            color: #333;
        }
        .btn-pay {
            display: inline-block;
            background: #dc3545;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .btn-pay:hover {
            background: #c82333;
        }
        .btn-shop {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-shop:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Keranjang Belanja</h2>
    </div>

    <div class="navigation">
        <a href="/produk" class="nav-link">← Kembali ke Produk</a>
        <a href="/transaksi" class="nav-link">Riwayat Transaksi</a>
        <a href="/logout" class="nav-link logout-link">Logout</a>
    </div>

    <div class="cart-container">
        <?php if (empty($keranjang)): ?>
            <div class="empty-cart">
                <h3>Keranjang kamu kosong.</h3>
                <p>Belum ada produk dalam keranjang. Yuk mulai berbelanja!</p>
                <a href="/produk" class="btn-shop">Mulai Belanja</a>
            </div>
        <?php else: ?>
            <h3>Item dalam Keranjang:</h3>
            <?php foreach ($keranjang as $item): ?>
            <div class="cart-item">
                <?php if (!empty($item['gambar'])): ?>
                    <img src="<?= htmlspecialchars($item['gambar']); ?>" alt="<?= htmlspecialchars($item['nama']); ?>">
                <?php endif; ?>
                <strong><?= htmlspecialchars($item['nama']); ?></strong> - Jumlah: <strong><?= $item['jumlah']; ?></strong> - Harga: Rp<?= number_format($item['harga'], 0, ',', '.'); ?>
            </div>
            <?php endforeach; ?>
            
            <a href="/bayar" class="btn-pay">Bayar Sekarang</a>
        <?php endif; ?>
    </div>
</body>
</html>
