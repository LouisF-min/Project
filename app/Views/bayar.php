<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
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
            background:#007bff;
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
        .payment-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .payment-summary {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .payment-summary h3 {
            margin-top: 0;
            color: #333;
        }
        .payment-summary ul {
            list-style: none;
            padding: 0;
        }
        .payment-summary li {
            margin-bottom: 8px;
            font-size: 16px;
            color: #555;
        }
        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            text-align: right;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }
        .payment-method label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        .payment-method select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .btn-process-payment {
            width: 100%;
            padding: 15px;
            background:rgb(35, 155, 61);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-process-payment:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pembayaran</h2>
    </div>

    <div class="navigation">
        <a href="/keranjang" class="nav-link">← Kembali ke Keranjang</a>
        <a href="/produk" class="nav-link">Lihat Produk</a>
        <a href="/transaksi" class="nav-link">Riwayat Transaksi</a>
        <a href="/logout" class="nav-link logout-link">Logout</a>
    </div>

    <div class="payment-container">
        <h3>Ringkasan Belanja Anda:</h3>
        <?php if (!empty($keranjang_items)): ?>
        <div class="payment-summary">
            <ul>
                <?php foreach ($keranjang_items as $item): ?>
                    <li>
                        <?= htmlspecialchars($item['produk_nama']); ?> (x<?= $item['jumlah']; ?>) - Rp<?= number_format($item['subtotal'], 0, ',', '.'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="total-price">
            Total yang harus dibayar: Rp<?= number_format($total_harga, 0, ',', '.'); ?>
        </div>

        <form action="/proses-bayar" method="post">
            <?= csrf_field() ?>
            <div class="payment-method">
                <label for="metode_pembayaran">Pilih Metode Pembayaran:</label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="cod">Cash On Delivery (COD)</option>
                    <option value="bca_virtual_account">Virtual Account BCA</option>
                    <option value="mandiri_virtual_account">Virtual Account Mandiri</option>
                </select>
            </div>
            <button type="submit" class="btn-process-payment">Lanjutkan Pembayaran</button>
        </form>
    </div>
</body>
</html>