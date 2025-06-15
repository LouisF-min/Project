<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
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
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-link:hover {
            background:rgb(1, 89, 184);
        }
        .logout-link {
            background: #dc3545;
        }
        .logout-link:hover {
            background: #c82333;
        }
        .transaction-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .empty-transaction {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        .empty-transaction h3 {
            color: #333;
            margin-bottom: 15px;
        }
        .transaction-list {
            list-style: none;
            padding: 0;
        }
        .transaction-item {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .transaction-id {
            font-weight: bold;
            color: #007bff;
            font-size: 16px;
        }
        .transaction-total {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            margin: 5px 0;
        }
        .transaction-date {
            color: #666;
            font-size: 14px;
        }
        .transaction-method {
            color: #666;
            font-size: 14px;
            font-style: italic;
        }
        .btn-view-detail {
            padding: 8px 15px;
            background: #17a2b8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s;
        }
        .btn-view-detail:hover {
            background: #138496;
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
        <h2>Riwayat Transaksi</h2>
    </div>

    <div class="navigation">
        <a href="/produk" class="nav-link">← Kembali ke Produk</a>
        <a href="/keranjang" class="nav-link">Lihat Keranjang</a>
        <a href="/logout" class="nav-link logout-link">Logout</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="transaction-container">
        <?php if (empty($transaksi)): ?>
            <div class="empty-transaction">
                <h3>Belum ada transaksi.</h3>
                <p>Kamu belum pernah melakukan transaksi. Yuk mulai berbelanja!</p>
                <a href="/produk" class="btn-shop">Mulai Belanja</a>
            </div>
        <?php else: ?>
            <h3>Daftar Transaksi Anda:</h3>
            <ul class="transaction-list">
                <?php foreach ($transaksi as $t): ?>
                <li class="transaction-item">
                    <div>
                        <div class="transaction-id">Transaksi #<?= $t['id']; ?></div>
                        <div class="transaction-total">Total: Rp<?= number_format($t['total_harga'], 0, ',', '.'); ?></div>
                        <div class="transaction-method">Metode: <?= ucwords(str_replace('_', ' ', $t['metode_pembayaran'])); ?></div>
                        <div class="transaction-date">Tanggal: <?= $t['created_at'] ?? '(waktu tidak tersedia)' ?></div>
                    </div>
                    <a href="/transaksi/detail/<?= $t['id']; ?>" class="btn-view-detail">Lihat Detail</a>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
