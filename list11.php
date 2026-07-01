<?php
namespace App\Filament\Resources\Bouquets\Tables;

use Filament\Actions\{EditAction, DeleteAction};
use Filament\Tables\Columns\{TextColumn, IconColumn};
use Filament\Tables\Table;

class BouquetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Цена')
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', ' ') . ' ₽')
                    ->sortable(),
                IconColumn::make('is_available')
                    ->label('Доступен')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make()->label('Изменить'),
                DeleteAction::make()->label('Удалить'),
            ]);
    }
}