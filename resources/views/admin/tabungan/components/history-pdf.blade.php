<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .header-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-info td {
            padding: 5px;
            vertical-align: top;
        }

        .header-info .label {
            font-weight: bold;
            width: 120px;
        }

        table.transactions {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.transactions th,
        table.transactions td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 10px;
            text-align: left;
        }

        table.transactions th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .summary {
            margin-top: 20px;
            text-align: right;
        }

        .summary table {
            width: 300px;
            margin-left: auto;
            border-collapse: collapse;
        }

        .summary td {
            padding: 5px;
        }

        .summary .label {
            font-weight: bold;
            text-align: left;
        }

        .summary .total {
            font-weight: bold;
            border-top: 1px solid #000;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
        }

        .positive {
            color: green;
        }

        .negative {
            color: red;
        }
    </style>
</head>

<body>
    <h1>RIWAYAT TRANSAKSI TABUNGAN SAMPAH</h1>

    <div class="header-info">
        <table>
            <tr>
                <td class="label">Nomor Rekening</td>
                <td>: {{ $member->memberAccount->account_number }}</td>
            </tr>
            <tr>
                <td class="label">Nama Nasabah</td>
                <td>: {{ $member->name }}</td>
            </tr>
            <tr>
                <td class="label">Total Saldo</td>
                <td>: Rp {{ number_format($totalBalance, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Dicetak pada</td>
                <td>: {{ $printedAt }}</td>
            </tr>
        </table>
    </div>

    <table class="transactions">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Transaksi</th>
                <th>Keterangan</th>
                <th>Jumlah (Kg)</th>
                <th>Harga/Kg</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction['created_at']->format('d/m/Y H:i') }}</td>
                    <td>{{ $transaction['type'] == 'deposit' ? 'Setoran' : 'Penarikan' }}</td>
                    <td>
                        @if ($transaction['type'] == 'deposit')
                            {{ $transaction['waste_type'] ? $transaction['waste_type']->name : 'Sampah' }}
                        @else
                            Penarikan Tabungan
                        @endif
                    </td>
                    <td>
                        @if ($transaction['type'] == 'deposit')
                            {{ number_format($transaction['weight_kg'], 2, ',', '.') }} kg
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($transaction['type'] == 'deposit')
                            Rp {{ number_format($transaction['price_per_kg'], 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($transaction['type'] == 'deposit')
                            <span class="positive">+ Rp {{ number_format($transaction['total_price'], 0, ',', '.') }}</span>
                        @else
                            <span class="negative">- Rp {{ number_format($transaction['total_price'], 0, ',', '.') }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td class="label">Total Setoran</td>
                <td>: Rp {{ number_format($totalDeposits, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Total Penarikan</td>
                <td>: Rp {{ number_format($totalWithdrawals, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td class="label">Saldo Akhir</td>
                <td>: Rp {{ number_format($totalBalance, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Bank Sampah | {{ date('Y') }} &copy; All Rights Reserved</p>
    </div>
</body>

</html>