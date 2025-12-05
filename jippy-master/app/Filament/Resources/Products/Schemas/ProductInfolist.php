<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('name')
                    ->label('Product Name')
                    ->weight('bold')
                    ->columnSpan(2),
                TextEntry::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('info'),
                TextEntry::make('price')
                    ->label('Price (IDR)')
                    ->money('IDR', 0)
                    ->color('success'),
                TextEntry::make('description')
                    ->label('Description')
                    ->placeholder('No description provided')
                    ->columnSpan(2),
                TextEntry::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
