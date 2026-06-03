<?php

namespace App\Filament\Resources\Accounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_akun')
                    ->label('Kode Akun')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nama_akun')
                    ->label('Nama Akun')
                    ->required()
                    ->maxLength(255),

                Select::make('jenis')
                    ->label('Jenis Akun')
                    ->options([
                        'Aset' => 'Aset',
                        'Kewajiban' => 'Kewajiban',
                        'Modal' => 'Modal',
                        'Pendapatan' => 'Pendapatan',
                        'Beban' => 'Beban',
                    ])
                    ->required(),
            ]);
    }
}