<?php

namespace App\Filament\Resources\Users\Schemas;

use Dom\Text;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use League\Flysystem\Visibility;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextInput::make('name')
                   ->required(),
                TextInput::make('email')
                ->email(),
                TextInput::make('password')
                ->password()
                ->visibleOn('create'),
            ]);
    }
}