<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Details')
                    ->description('Manage category information')
                    ->icon('heroicon-o-tag')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter category name')
                            ->minLength(3)
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (callable $set, ?string $state) {
                                if ($state !== null) {
                                    $set('slug', \Illuminate\Support\Str::slug($state));
                                }
                            })
                            ->columnSpan(2),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('auto-generated-slug')
                            ->helperText('Auto-generated from name')
                            ->minLength(3)
                            ->maxLength(255)
                            ->columnSpan(2),
                    ]),
            ]);
    }
}
