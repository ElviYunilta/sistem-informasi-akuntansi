<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y'),

                TextColumn::make('account.nama_akun')
                    ->label('Account')
                    ->searchable(),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->searchable(),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->alignRight()
                    ->formatStateUsing(function ($state) {
                        return 'Rp ' . number_format((float) $state, 0, ',', '.');
                    }),

                TextColumn::make('jenis_transaksi')
                    ->label('Jenis Transaksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pemasukan' => 'success',
                        'Pengeluaran' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}