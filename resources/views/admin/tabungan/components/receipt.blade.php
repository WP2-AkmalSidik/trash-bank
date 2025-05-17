<!-- resources/views/admin/transaksi/receipt.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Setoran Sampah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            line-height: 1.5;
        }
        .receipt {
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .receipt-header h1 {
            font-size: 16px;
            margin: 0 0 5px;
        }
        .receipt-header p {
            margin: 0;
            font-size: 12px;
        }
        .receipt-body {
            margin-bottom: 20px;
        }
        .receipt-info {
            margin-bottom: 20px;
        }
        .receipt-info p {
            margin: 5px 0;
        }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .receipt-footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .text-right {
            text-align: right;
        }
        .font-bold {
            font-weight: bold;
        }
        @media print {
            body {
                width: 80mm;
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
            <p>Jl. Contoh No. 123, Kota</p>
            <p>Telp: 021-1234567</p>
        </div>
        
        <div class="receipt-body">
            <div class="receipt-info">
                <p>No. Transaksi: #{{ $deposit->id }}</p>
                <p>Tanggal: {{ $deposit->created_at->format('d/m/Y H:i') }}</p>
                <p>Nasabah: {{ $deposit->memberAccount->user->name }}</p>
                <p>No. Rekening: {{ $deposit->memberAccount->account_number }}</p>
            </div>
            
            <table class="receipt-table">
                <tr>
                    <td colspan="2">{{ $deposit->wasteType->name }}</td>
                </tr>
                <tr>
                    <td>{{ number_format($deposit->weight_kg, 2, ',', '.') }} kg x Rp {{ number_format($deposit->wasteType->price_per_kg, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($deposit->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td class="font-bold">TOTAL</td>
                    <td class="text-right font-bold">Rp {{ number_format($deposit->total_price, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        
        <div class="receipt-footer">
            <p>Terima kasih telah berkontribusi menjaga lingkungan</p>
            <p>dengan menabung di Bank Sampah</p>
        </div>
    </div>
    
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print();" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cetak Bukti
        </button>
        <button onclick="window.close();" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>
    
    <script>
        window.onload = function() {
            // Auto print when page loads
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>