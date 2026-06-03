<x-filament-panels::page>
    <style>
        .ledger-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .ledger-header {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: white;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.18);
        }

        .ledger-header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: bold;
        }

        .ledger-header p {
            margin-top: 8px;
            font-size: 15px;
            opacity: 0.95;
        }

        .account-card {
            background: #111827;
            border: 1px solid #374151;
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.18);
        }

        .account-header {
            padding: 22px 24px;
            border-bottom: 1px solid #374151;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .account-title h2 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            color: white;
        }

        .account-title p {
            margin-top: 6px;
            color: #9ca3af;
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .table-area {
            overflow-x: auto;
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

        th.right,
        td.right {
            text-align: right;
        }

        tr:hover {
            background: #1f2937;
        }

        .debit {
            color: #22c55e;
            font-weight: bold;
        }

        .kredit {
            color: #ef4444;
            font-weight: bold;
        }

        .saldo {
            color: #3b82f6;
            font-weight: bold;
        }

        tfoot {
            background: #1f2937;
        }

        tfoot td {
            font-weight: bold;
        }

        .empty-row {
            text-align: center;
            color: #9ca3af;
            padding: 24px;
        }

        .summary-box {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            padding: 20px 24px;
            background: #0f172a;
            border-top: 1px solid #374151;
        }

        .summary-item {
            background: #111827;
            border: 1px solid #374151;
            border-radius: 12px;
            padding: 16px;
        }

        .summary-item .label {
            color: #9ca3af;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .summary-item .value {
            font-size: 20px;
            font-weight: bold;
        }

        .empty-card {
            background: #111827;
            border: 1px solid #374151;
            border-radius: 16px;
            padding: 24px;
            color: #9ca3af;
            text-align: center;
        }

        @media (max-width: 768px) {
            .account-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-box {
                grid-template-columns: 1fr;
            }

            table {
                min-width: 700px;
            }
        }
    </style>

    <div class="ledger-wrapper">

        <div class="ledger-header">
            <h1>Buku Besar</h1>
            <p>Sistem Informasi Akuntansi Toko Elektronik</p>
        </div>

        @forelse ($accounts as $account)
            @php
                $totalDebit = 0;
                $totalKredit = 0;
            @endphp

            <div class="account-card">
                <div class="account-header">
                    <div class="account-title">
                        <h2>{{ $account->kode_akun }} - {{ ucwords($account->nama_akun) }}</h2>
                        <p>Ringkasan transaksi berdasarkan akun.</p>
                    </div>

                    <span class="badge">
                        {{ $account->jenis }}
                    </span>
                </div>

                <div class="table-area">
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jenis Transaksi</th>
                                <th class="right">Debit</th>
                                <th class="right">Kredit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($account->transactions as $transaction)
                                @php
                                    $debit = $transaction->jenis_transaksi === 'Pemasukan' ? $transaction->nominal : 0;
                                    $kredit = $transaction->jenis_transaksi === 'Pengeluaran' ? $transaction->nominal : 0;

                                    $totalDebit += $debit;
                                    $totalKredit += $kredit;
                                @endphp

                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        {{ $transaction->keterangan }}
                                    </td>

                                    <td>
                                        {{ $transaction->jenis_transaksi }}
                                    </td>

                                    <td class="right debit">
                                        Rp {{ number_format($debit, 0, ',', '.') }}
                                    </td>

                                    <td class="right kredit">
                                        Rp {{ number_format($kredit, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-row">
                                        Belum ada transaksi pada akun ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" class="right">Total</td>
                                <td class="right debit">
                                    Rp {{ number_format($totalDebit, 0, ',', '.') }}
                                </td>
                                <td class="right kredit">
                                    Rp {{ number_format($totalKredit, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="summary-box">
                    <div class="summary-item">
                        <div class="label">Total Debit</div>
                        <div class="value debit">
                            Rp {{ number_format($totalDebit, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="summary-item">
                        <div class="label">Total Kredit</div>
                        <div class="value kredit">
                            Rp {{ number_format($totalKredit, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="summary-item">
                        <div class="label">Saldo Akun</div>
                        <div class="value saldo">
                            Rp {{ number_format($totalDebit - $totalKredit, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-card">
                Belum ada data akun.
            </div>
        @endforelse

    </div>
</x-filament-panels::page>