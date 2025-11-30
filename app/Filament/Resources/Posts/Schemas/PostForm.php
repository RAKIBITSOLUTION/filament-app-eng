<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
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
                TextInput::make('title')->required(),
                TextInput::make('slug')->required(),
                MarkdownEditor::make('content')->required(),
                FileUpload::make('thumbnail')->disk('public')->directory('thumbnails'),
                ColorPicker::make('color')->required(),
                Select::make('category_id')->relationship('category', 'name')->required(),
                TagsInput::make('tags')->required(),
                Checkbox::make('is_published')->required(),
            ]);
    }
}
