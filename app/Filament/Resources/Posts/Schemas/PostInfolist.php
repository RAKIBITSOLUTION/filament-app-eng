<?php

namespace App\Filament\Resources\Posts\Schemas;

use Dom\Text;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('thumbnail'),
                TextEntry::make('title'),
                TextEntry::make('color'),
                TextEntry::make('slug'),
                TextEntry::make('category_id')
                    ->numeric(),
                IconEntry::make('is_published')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
