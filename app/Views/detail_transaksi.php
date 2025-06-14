<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
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
            background: #6c757d;
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
        .detail-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .detail-group {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #eee;
        }
        .detail-group:last-child {
            border-bottom: none;
        }
        .detail-group strong {
            color: #333;
            font-size: 1.1em;
            display: block;
            margin-bottom: 5px;
        }
        .detail-group span {
            color: #555;
            font-size: 1em;
        }
        .item-list {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }
        .item-list li {
            background: #f0f2f5;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .item-list li span {
            font-weight: normal;
        }
        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>📄 Detail Transaksi #<?= $transaksi['id']; ?></h2>
    </div>

    <div class="navigation">
        <a href="/transaksi" class="nav-link">← Kembali ke Riwayat Transaksi</a>
        <a href="/produk" class="nav-link">Lihat Produk</a>
        <a href="/keranjang" class="nav-link">🛒 Lihat Keranjang</a>
        <a href="/logout" class="nav-link logout-link">🚪 Logout</a>
    </div>

    <div class="detail-container">
        <div class="detail-group">
            <strong>ID Transaksi:</strong> <span><?= $transaksi['id']; ?></span>
        </div>
        <div class="detail-group">
            <strong>Tanggal Transaksi:</strong> <span><?= $transaksi['created_at'] ?? 'Tidak tersedia'; ?></span>
        </div>
        <div class="detail-group">
            <strong>Metode Pembayaran:</strong> <span><?= ucwords(str_replace('_', ' ', $transaksi['metode_pembayaran'])); ?></span>
        </div>

        <h3>Produk yang Dibeli:</h3>
        <?php if (!empty($detail_transaksi)): ?>
            <ul class="item-list">
                <?php foreach ($detail_transaksi as $item): ?>
                    <li>
                        <span><?= htmlspecialchars($item['produk_nama']); ?></span>
                        <span>Jumlah: <?= $item['jumlah']; ?></span>
                        <span>Subtotal: Rp<?= number_format($item['subtotal'], 0, ',', '.'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Tidak ada detail produk untuk transaksi ini.</p>
        <?php endif; ?>

        <div class="total-price">
            Total Harga: Rp<?= number_format($transaksi['total_harga'], 0, ',', '.'); ?>
        </div>
    </div>
</body>
</html>
