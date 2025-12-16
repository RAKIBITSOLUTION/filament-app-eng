<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\MarkdownEditor;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Post Details')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->components([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required(),
                                ColorPicker::make('color'),
                                Checkbox::make('is_published')
                                    ->label('Published'),
                            ]),
                        Tabs\Tab::make('Content')
                            ->components([
                                MarkdownEditor::make('content')
                                    ->required(),
                                TagsInput::make('tags'),
                            ]),
                        Tabs\Tab::make('Media')
                            ->components([
                                FileUpload::make('thumbnail')
                                    ->image()
                                    ->maxSize(1024),
                            ]),
                    ]),
            ]);
    }
}