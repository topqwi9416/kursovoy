<?php
namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\{EditAction, DeleteAction};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#')->sortable(),
                TextColumn::make('customer_name')->label('Клиент')->searchable(),
                TextColumn::make('delivery_time')
                    ->dateTime('d.m.Y H:i')->sortable(),
                TextColumn::make('total_amount')
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', ' ') . ' ₽'),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => match($state) {
                        'new'        => 'Новый',
                        'confirmed'  => 'Подтверждён',
                        'delivering' => 'Доставляется',
                        'delivered'  => 'Доставлен',
                        'cancelled'  => 'Отменён',
                    })
                    ->color(fn($state) => match($state) {
                        'new'        => 'info',
                        'confirmed'  => 'success',
                        'delivering' => 'warning',
                        'delivered'  => 'primary',
                        'cancelled'  => 'danger',
                    }),
            ])
            ->recordActions([
                EditAction::make()->label('Изменить'),
                DeleteAction::make()->label('Удалить'),
            ]);
    }
}