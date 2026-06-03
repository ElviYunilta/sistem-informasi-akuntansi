<?php

namespace App\Filament\Pages;

use App\Models\Transaction;
use Filament\Pages\Page;

class LaporanLabaRugi extends Page
{
    protected string $view = 'filament.pages.laporan-laba-rugi';

    protected static ?string $navigationLabel = 'Laporan Laba Rugi';

    protected static ?string $title = 'Laporan Laba Rugi';

    protected static ?int $navigationSort = 3;

    public function getViewData(): array
    {
        $pendapatan = Transaction::whereHas('account', function ($query) {
            $query->where('jenis', 'Pendapatan');
        })->sum('nominal');

        $beban = Transaction::whereHas('account', function ($query) {
            $query->where('jenis', 'Beban');
        })->sum('nominal');

        $labaBersih = $pendapatan - $beban;

        $dataPendapatan = Transaction::with('account')
            ->whereHas('account', function ($query) {
                $query->where('jenis', 'Pendapatan');
            })
            ->get();

        $dataBeban = Transaction::with('account')
            ->whereHas('account', function ($query) {
                $query->where('jenis', 'Beban');
            })
            ->get();

        return [
            'pendapatan' => $pendapatan,
            'beban' => $beban,
            'labaBersih' => $labaBersih,
            'dataPendapatan' => $dataPendapatan,
            'dataBeban' => $dataBeban,
        ];
    }
}