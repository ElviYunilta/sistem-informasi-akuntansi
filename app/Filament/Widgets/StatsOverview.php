<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalPemasukan = Transaction::where('jenis_transaksi', 'Pemasukan')
            ->sum('nominal');

        $totalPengeluaran = Transaction::where('jenis_transaksi', 'Pengeluaran')
            ->sum('nominal');

        $labaBersih = $totalPemasukan - $totalPengeluaran;

        return [
            Stat::make(
                'Total Pemasukan',
                'Rp ' . number_format($totalPemasukan, 0, ',', '.')
            ),

            Stat::make(
                'Total Pengeluaran',
                'Rp ' . number_format($totalPengeluaran, 0, ',', '.')
            ),

            Stat::make(
                'Laba Bersih',
                'Rp ' . number_format($labaBersih, 0, ',', '.')
            ),
        ];
    }
}