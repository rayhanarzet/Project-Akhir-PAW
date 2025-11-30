<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;



class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->description('Basic details about the product')
                    ->icon('heroicon-o-shopping-cart')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter product name')
                            ->minLength(3)
                            ->maxLength(255)
                            ->columnSpan(2),

                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR')
                            ->minValue(0)
                            ->step(1000),

                        FileUpload::make('image')
                            ->image()
                            ->directory('products')
                            ->label('Product Image')
                            ->required()
                            ->columnSpan(2),
                    ]),

                Section::make('Description')
                    ->description('Detailed information about the product')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(5)
                            ->placeholder('Enter product description')
                            ->helperText('Provide detailed information about the product'),
                    ]),
            ]);
    }
}
