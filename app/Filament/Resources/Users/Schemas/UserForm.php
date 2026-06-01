<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->nullable(),
                Select::make('role_id')
                    ->label('Role')
                    ->options(Role::pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                DateTimePicker::make('email_verified_at')
                    ->label('Email verified at'),
                TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null)
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),
            ]);
    }
}
