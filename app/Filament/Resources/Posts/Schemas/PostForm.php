<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
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
                Section::make('create a post')->description('Create a new blog post')->collapsible()->schema([
                    Group::make()->schema([
                        TextInput::make('title')->rules('min:5|max:10')->required(),
                        TextInput::make('slug')->required(),
                        TagsInput::make('tags')->required(),
                    ])->columns(2),
                ]),

                Section::make('create a post')->description('Create a new blog post')->collapsible()->schema([
                    ColorPicker::make('color')->required(),
                    Select::make('category_id')->relationship('category', 'name')->required(),
                    Checkbox::make('is_published')->required(),
                ]),


                Group::make()->schema([
                    Section::make('Post Content')->description('Write the content of the post and upload a thumbnail image')->collapsible()->schema([
                        MarkdownEditor::make('content')->required(),
                        FileUpload::make('thumbnail'),
                    ]),
                ]),

            ])->columns([
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
                'xl' => 3,
                '2xl' => 3,
            ]);
    }
}
