<?php

namespace App\Filament\Pages;

use App\Models\Account;
use Filament\Pages\Page;

class BukuBesar extends Page
{
    protected string $view = 'filament.pages.buku-besar';

    protected static ?string $navigationLabel = 'Buku Besar';

    protected static ?string $title = 'Buku Besar';

    protected static ?int $navigationSort = 2;

    public function getViewData(): array
    {
        $accounts = Account::with('transactions')->get();

        return [
            'accounts' => $accounts,
        ];
    }
}