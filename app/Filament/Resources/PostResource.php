<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Outerweb\FilamentImageLibrary\Filament\Forms\Components\ImageLibraryPicker;
use Parallax\FilamentComments\Infolists\Components\CommentsEntry;
use Filament\Forms\Components\Tabs;

class PostResource extends Resource
{
    use Translatable;
    protected static ?string $model = Post::class;
    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $title = "title";
    protected static ?int $navigationSort = 1;
    protected static ?string $description = "description";
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make("Information")->schema([
                            Select::make('user_id')
                                ->relationship('author', 'name')
                                ->default(Filament::auth()->user()->id)
                                ->searchable()
                                ->hidden()
                                ->required(),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->required(),
                            TextInput::make('title')
                                ->required()
                                ->columnSpanFull(),
                            TextInput::make('slug')
                                ->required()
                                ->columnSpanFull(),
                            Textarea::make('description')
                                ->required()
                                ->columnSpanFull(),
                            FileUpload::make('image'),
                            Toggle::make('published')
                                ->required(),
                            Toggle::make('featured')
                                ->required(),
                        ]),
                        Tabs\Tab::make('content')->schema([
                            Builder::make('content')
                                ->blocks([
                                    Builder\Block::make('heading')
                                        ->schema([
                                            TextInput::make('content')
                                                ->label('Heading')
                                                ->required(),
                                            Select::make('level')
                                                ->options([
                                                    'h1' => 'Heading 1',
                                                    'h2' => 'Heading 2',
                                                    'h3' => 'Heading 3',
                                                    'h4' => 'Heading 4',
                                                    'h5' => 'Heading 5',
                                                    'h6' => 'Heading 6',
                                                ])
                                                ->required(),
                                        ])
                                        ->columns(2),
                                    Builder\Block::make('paragraph')
                                        ->schema([
                                            Textarea::make('content')
                                                ->label('Paragraph')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('image')
                                        ->schema([
                                            FileUpload::make('url')
                                                ->label('Image')
                                                ->image()
                                                ->required(),
                                            TextInput::make('alt')
                                                ->label('Alt text')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('richfield')
                                        ->schema([
                                            RichEditor::make('content')
                                                ->required(),
                                        ]),
                                    Builder\Block::make('markdown')
                                        ->schema([
                                            MarkdownEditor::make('content')
                                                ->required(),
                                        ]),
                                ])
                                ->columnSpanFull(),
                        ]),
                    ])

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->sortable(),
                ImageColumn::make('image'),
                IconColumn::make('published')
                    ->boolean(),
                IconColumn::make('featured')
                    ->boolean(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                CommentsEntry::make('filament_comments'),
            ]);
    }
}
