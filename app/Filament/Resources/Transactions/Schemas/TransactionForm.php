<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Account;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->label('Tanggal Transaksi')
                    ->required(),

                Select::make('account_id')
                    ->label('Account')
                    ->options(Account::pluck('nama_akun', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('keterangan')
                    ->label('Keterangan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nominal')
                    ->label('Nominal')
                    ->prefix('Rp')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('Contoh: 9000000')
                    ->helperText('Tulis angka tanpa titik. Contoh: 9000000 untuk Rp 9.000.000')
                    ->required(),

                Select::make('jenis_transaksi')
                    ->label('Jenis Transaksi')
                    ->options([
                        'Pemasukan' => 'Pemasukan',
                        'Pengeluaran' => 'Pengeluaran',
                    ])
                    ->required(),
            ]);
    }
}