<x-filament-panels::page>
    <style>
        .report-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .report-header {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: white;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.18);
        }

        .report-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: bold;
        }

        .report-header p {
            margin-top: 8px;
            font-size: 15px;
            opacity: 0.95;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: #111827;
            border: 1px solid #374151;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.18);
        }

        .summary-card .label {
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .summary-card .amount {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .green {
            color: #22c55e;
        }

        .red {
            color: #ef4444;
        }

        .blue {
            color: #3b82f6;
        }

        .summary-card .desc {
            color: #9ca3af;
            font-size: 13px;
        }

        .table-card {
            background: #111827;
            border: 1px solid #374151;
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.18);
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #374151;
        }

        .table-header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            color: white;
        }

        .table-header p {
            margin-top: 6px;
            color: #9ca3af;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #1f2937;
        }

        th {
            color: #d1d5db;
            padding: 14px 18px;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
            border-bottom: 1px solid #374151;
        }

        td {
            padding: 14px 18px;
            color: #f9fafb;
            border-bottom: 1px solid #374151;
            font-size: 14px;
        }

        td.right,
        th.right {
            text-align: right;
        }

        tr:hover {
            background: #1f2937;
        }

        .badge-green {
            display: inline-block;
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-red {
            display: inline-block;
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        tfoot {
            background: #1f2937;
        }

        tfoot td {
            font-weight: bold;
        }

        .result-card {
            background: #111827;
            border: 1px solid #374151;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.18);
        }

        .result-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .result-card h2 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            color: white;
        }

        .result-card p {
            margin-top: 6px;
            color: #9ca3af;
            font-size: 14px;
        }

        .result-amount {
            text-align: right;
        }

        .result-amount span {
            display: block;
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .result-amount strong {
            font-size: 32px;
        }

        .empty-row {
            text-align: center;
            color: #9ca3af;
            padding: 24px;
        }

        @media (max-width: 768px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .result-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .result-amount {
                text-align: left;
            }

            table {
                font-size: 12px;
            }
        }
    </style>

    <div class="report-wrapper">

        <div class="report-header">
            <h1>Laporan Laba Rugi</h1>
            <p>Sistem Informasi Akuntansi Toko Elektronik</p>
        </div>

        <div class="summary-grid">
            <div class="summary-card">
                <div class="label">Total Pendapatan</div>
                <div class="amount green">
                    Rp {{ number_format($pendapatan, 0, ',', '.') }}
                </div>
                <div class="desc">Seluruh transaksi dari akun pendapatan.</div>
            </div>

            <div class="summary-card">
                <div class="label">Total Beban</div>
                <div class="amount red">
                    Rp {{ number_format($beban, 0, ',', '.') }}
                </div>
                <div class="desc">Seluruh transaksi dari akun beban.</div>
            </div>

            <div class="summary-card">
                <div class="label">Laba Bersih</div>
                <div class="amount {{ $labaBersih >= 0 ? 'blue' : 'red' }}">
                    Rp {{ number_format($labaBersih, 0, ',', '.') }}
                </div>
                <div class="desc">Total pendapatan dikurangi total beban.</div>
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h2>Rincian Pendapatan</h2>
                <p>Daftar transaksi dari akun berjenis Pendapatan.</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Akun</th>
                        <th>Keterangan</th>
                        <th class="right">Nominal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dataPendapatan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge-green">
                                    {{ $item->account->nama_akun ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="right green">
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-row">
                                Belum ada data pendapatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" class="right">Total Pendapatan</td>
                        <td class="right green">
                            Rp {{ number_format($pendapatan, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="table-card">
            <div class="table-header">
                <h2>Rincian Beban</h2>
                <p>Daftar transaksi dari akun berjenis Beban.</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Akun</th>
                        <th>Keterangan</th>
                        <th class="right">Nominal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dataBeban as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge-red">
                                    {{ $item->account->nama_akun ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $item->keterangan }}</td>
                            <td class="right red">
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-row">
                                Belum ada data beban.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" class="right">Total Beban</td>
                        <td class="right red">
                            Rp {{ number_format($beban, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="result-card">
            <div class="result-flex">
                <div>
                    <h2>Hasil Laporan</h2>
                    <p>Laba Bersih = Total Pendapatan - Total Beban</p>
                </div>

                <div class="result-amount">
                    <span>Laba Bersih</span>
                    <strong class="{{ $labaBersih >= 0 ? 'blue' : 'red' }}">
                        Rp {{ number_format($labaBersih, 0, ',', '.') }}
                    </strong>
                </div>
            </div>
        </div>

    </div>
</x-filament-panels::page>