<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kas Stasi - Gereja St. Martinus Selorejo</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; color: #111; margin: 20px; }
        .kop { text-align: center; border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 15px; }
        .kop h2 { margin: 0; font-size: 14pt; text-transform: uppercase; font-weight: bold; }
        .kop p { margin: 2px 0; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #333; padding: 5px 8px; font-size: 9.5pt; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .ttd-table { width: 100%; margin-top: 40px; border: none; }
        .ttd-table td { border: none; text-align: center; width: 50%; font-size: 10pt; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 6px 14px; cursor: pointer;">Cetak Laporan</button>
        <button onclick="window.close()" style="padding: 6px 14px; cursor: pointer;">Tutup</button>
    </div>

    <div class="kop">
        <h2>Gereja Katolik St. Martinus Selorejo</h2>
        <p>Laporan Pertanggungjawaban Keuangan Kas Stasi</p>
        <p><small>Periode Transaksi: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</small></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 14%;">Tanggal</th>
                <th style="width: 22%;">Kategori</th>
                <th>Keterangan / Uraian</th>
                <th style="width: 16%;">Pemasukan</th>
                <th style="width: 16%;">Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $i => $item)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->transaction_date)->format('d/m/Y') }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->description }}</td>
                <td class="text-right">{{ $item->type === 'pemasukan' ? 'Rp ' . number_format($item->amount, 0, ',', '.') : '-' }}</td>
                <td class="text-right">{{ $item->type === 'pengeluaran' ? 'Rp ' . number_format($item->amount, 0, ',', '.') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada transaksi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Transaksi Kas:</th>
                <th class="text-right">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                <th class="text-right">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Sisa Saldo Kas Bersih:</th>
                <th colspan="2" class="text-center" style="font-size: 11pt; font-weight: bold;">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </th>
            </tr>
        </tfoot>
    </table>

    <table class="ttd-table">
        <tr>
            <td>
                Mengetahui,<br><strong>Ketua Stasi St. Martinus</strong><br><br><br><br><br>
                ( ___________________________ )
            </td>
            <td>
                Selorejo, {{ now()->translatedFormat('d F Y') }}<br><strong>Bendahara Gereja</strong><br><br><br><br><br>
                ( {{ auth()->user()->name }} )
            </td>
        </tr>
    </table>
</body>
</html>
