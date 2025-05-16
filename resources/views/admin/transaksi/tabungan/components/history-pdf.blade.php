<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Riwayat Transaksi - {{ $member->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-bottom: 10px; }
        .info { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f8f9fa; text-align: left; padding: 8px; border: 1px solid #dee2e6; }
        td { padding: 8px; border: 1px solid #dee2e6; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total { font-weight: bold; margin-top: 10px; }
        .footer { margin-top: 30px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">RIWAYAT TRANSAKSI TABUNGAN SAMPAH</div>
        <div class="subtitle">Bank Sampah {{ config('app.name') }}</div>
    </div>
    
    <div class="info">
        <div><strong>Nama Nasabah:</strong> {{ $member->name }}</div>
        <div><strong>No. Rekening:</strong> {{ $member->memberAccount->account_number }}</div>
        <div><strong>Tanggal Cetak:</strong> {{ $printedAt }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Sampah</th>
                <th>Berat (kg)</th>
                <th>Harga/Kg</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $index => $deposit)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $deposit->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $deposit->wasteType->name }}</td>
                <td>{{ number_format($deposit->weight_kg, 2) }}</td>
                <td>Rp {{ number_format($deposit->wasteType->price_per_kg, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($deposit->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total text-right">
        Total Saldo: Rp {{ number_format($totalBalance, 0, ',', '.') }}
    </div>
    
    <div class="footer">
        Dicetak oleh sistem pada {{ $printedAt }}
    </div>
</body>
</html>