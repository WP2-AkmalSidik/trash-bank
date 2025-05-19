<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $reportTitle }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .period {
            font-size: 14px;
            margin-top: 5px;
        }

        .summary {
            margin: 20px 0;
        }

        .summary-item {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">{{ $reportTitle }}</div>
    </div>

    <div class="summary">
        <div class="summary-item"><strong>Total Hari Deposit:</strong> {{ $summary['total_days'] }}</div>
        <div class="summary-item"><strong>Total Transaksi:</strong> {{ number_format($summary['total_transactions']) }}</div>
        <div class="summary-item"><strong>Total Berat Sampah:</strong> {{ number_format($summary['total_weight'], 2) }} kg</div>
        <div class="summary-item"><strong>Total Harga:</strong> Rp {{ number_format($summary['total_price'], 0, ',', '.') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Sampah</th>
                <th>Jumlah Transaksi</th>
                <th>Total Berat (kg)</th>
                <th>Total Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wasteData as $index => $waste)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $waste['name'] }}</td>
                    <td>{{ number_format($waste['transaction_count']) }}</td>
                    <td>{{ number_format($waste['total_weight'], 2) }}</td>
                    <td>Rp {{ number_format($waste['total_price'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data tersedia untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y H:i') }}
    </div>

</body>
</html>
