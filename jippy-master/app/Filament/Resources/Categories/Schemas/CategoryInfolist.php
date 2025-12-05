<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('name')
                    ->label('Category Name')
                    ->weight('bold')
                    ->columnSpan(2),
                TextEntry::make('slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray'),
                TextEntry::make('products_count')
                    ->label('Total Products')
                    ->counts('products')
                    ->badge()
                    ->color('success'),
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
