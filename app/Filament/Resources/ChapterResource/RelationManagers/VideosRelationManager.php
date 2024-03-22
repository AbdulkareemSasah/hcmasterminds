<?php

namespace App\Filament\Resources\ChapterResource\RelationManagers;

use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideosRelationManager extends RelationManager
{
    use Translatable;
    protected static string $relationship = 'videos';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('model_type')
                    ->default('App\\Models\\Chapter')
                    ->required()
                    ->hidden(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description'),
                FileUpload::make('attachment')
                    ->required()
                    ->preserveFilenames(),
                TextInput::make('type')
                    ->required()
                    ->default("video")
                    ->hidden(),
                KeyValue::make('translations')

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Stack::make([
                    Tables\Columns\ImageColumn::make('attachment'),
                    Tables\Columns\TextColumn::make('name'),
                ])
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->afterFormValidated(function () {
                    }),
                Tables\Actions\LocaleSwitcher::make(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->contentGrid([
                'md' => 2,
                'xl' => 3,
            ]);
    }
}
