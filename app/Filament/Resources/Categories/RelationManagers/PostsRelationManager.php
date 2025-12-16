<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\DissociateBulkAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\RelationManagers\RelationManager;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Schema $schema): Schema
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('thumbnail'),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                ColorColumn::make('color'),
                TextColumn::make('slug'),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                CheckboxColumn::make('is_published'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Published on'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),


            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
