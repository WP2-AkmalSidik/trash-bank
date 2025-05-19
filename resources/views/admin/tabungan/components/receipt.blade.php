<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Setoran Sampah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }
        .receipt {
            max-width: 300px;
            margin: 0 auto;
            padding: 10px 0;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 15px;
        }
        .receipt-header h1 {
            font-size: 18px;
            margin: 5px 0;
        }
        .receipt-header p {
            font-size: 12px;
            margin: 5px 0;
        }
        .receipt-content {
            margin-bottom: 20px;
        }
        .receipt-content p {
            margin: 3px 0;
            display: flex;
            justify-content: space-between;
        }
        .receipt-content .label {
            font-weight: bold;
        }
        .receipt-footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }
        .receipt-divider {
            border-top: 1px dashed #ccc;
            margin: 10px 0;
        }
        .right-align {
            text-align: right;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .receipt {
                width: 100%;
                max-width: none;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="receipt-header">
            <h1>BANK SAMPAH</h1>
            <p>Jl. Lingkungan Hidup No. 123</p>
            <p>Telp: 0812-3456-7890</p>
            <div class="receipt-divider"></div>
            <h2>BUKTI SETORAN SAMPAH</h2>
        </div>

        <div class="receipt-content">
            <p>
                <span class="label">No. Bukti:</span>
                <span>{{ sprintf('STR%06d', $deposit->id) }}</span>
            </p>
            <p>
                <span class="label">Tanggal:</span>
                <span>{{ $deposit->created_at->format('d/m/Y H:i') }}</span>
            </p>
            <p>
                <span class="label">No. Rekening:</span>
                <span>{{ $deposit->memberAccount->account_number }}</span>
            </p>
            <p>
                <span class="label">Nasabah:</span>
                <span>{{ $deposit->memberAccount->user->name }}</span>
            </p>
            
            <div class="receipt-divider"></div>
            
            <p>
                <span class="label">Jenis Sampah:</span>
                <span>{{ $deposit->wasteType->name }}</span>
            </p>
            <p>
                <span class="label">Berat:</span>
                <span>{{ number_format($deposit->weight_kg, 2, ',', '.') }} kg</span>
            </p>
            <p>
                <span class="label">Harga/kg:</span>
                <span>Rp {{ number_format($deposit->price_per_kg, 0, ',', '.') }}</span>
            </p>
            <p>
                <span class="label">Total:</span>
                <span>Rp {{ number_format($deposit->total_price, 0, ',', '.') }}</span>
            </p>
            
            <div class="receipt-divider"></div>
            
            <p>
                <span class="label">Petugas:</span>
                <span>{{ auth()->user()->name }}</span>
            </p>
        </div>

        <div class="receipt-footer">
            <p>Terima kasih atas partisipasi Anda!</p>
            <p>Kontribusi Anda sangat berarti bagi lingkungan</p>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Cetak</button>
        <button onclick="window.close()">Tutup</button>
    </div>
</body>

</html>