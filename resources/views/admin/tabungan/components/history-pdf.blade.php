<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi - {{ $member->memberAccount->account_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-green { color: #28a745; }
        .text-red { color: #dc3545; }
        .text-right { text-align: right; }
        .summary { margin-top: 20px; padding: 10px; background-color: #f8f9fa; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Riwayat Transaksi</h1>
    <p>Nomor Rekening: {{ $member->memberAccount->account_number }}</p>
    <p>Nama: {{ $member->name }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis Transaksi</th>
                <th>Keterangan</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['created_at']->format('d M Y, H:i') }}</td>
                    <td>
                        @if($transaction['type'] === 'deposit')
                            Setoran
                        @else
                            Penarikan
                        @endif
                    </td>
                    <td>
                        @if($transaction['type'] === 'deposit')
                            {{ $transaction['waste_type']->name }} ({{ number_format($transaction['weight_kg'], 2, ',', '.') }} kg)
                        @else
                            Pengajuan Penarikan
                        @endif
                    </td>
                    <td class="text-right @if($transaction['type'] === 'deposit') text-green @else text-red @endif">
                        @if($transaction['type'] === 'deposit')
                            + Rp {{ number_format($transaction['total_price'], 0, ',', '.') }}
                        @else
                            - Rp {{ number_format($transaction['total_price'], 0, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="summary">
        <p>Total Setoran: Rp {{ number_format($totalDeposits, 0, ',', '.') }}</p>
        <p>Total Penarikan: Rp {{ number_format($totalWithdrawals, 0, ',', '.') }}</p>
        <p><strong>Saldo Akhir: Rp {{ number_format($totalBalance, 0, ',', '.') }}</strong></p>
    </div>
    
    <p style="margin-top: 20px;">
        Dicetak pada: {{ $printedAt }}
    </p>
</body>
</html>