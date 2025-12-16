<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Category;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use function Symfony\Component\String\s;



use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\CheckboxColumn;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('thumbnail'),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                ColorColumn::make('color')->toggleable(),
                TextColumn::make('slug'),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                CheckboxColumn::make('is_published')->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Published on')
                    ->date('F j, Y'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('published')
                    ->query(fn ($query) => $query->where('is_published', true))
                    ->label('Published Posts'),
                    SelectFilter::make('category_id')
                    ->options(Category::all()->pluck('slug', 'id'))
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                ]),
            ]);
    }
}
