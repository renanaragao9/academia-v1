<?php

namespace App\Filament\Resources\Sales\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_sale')
                    ->label('Data da Venda')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('student.name')
                    ->label('Aluno')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->placeholder('-')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'paid' => 'Pago',
                        'open' => 'Aberto',
                        'canceled' => 'Cancelado',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'paid' => 'success',
                        'open' => 'warning',
                        'canceled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('saleItems_count')
                    ->label('Itens')
                    ->counts('saleItems')
                    ->badge()
                    ->sortable(),

                TextColumn::make('amount_price')
                    ->label('Subtotal')
                    ->money('BRL')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('discount_amount')
                    ->label('Desconto')
                    ->money('BRL')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('BRL')
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('user.name')
                    ->label('Vendedor')
                    ->placeholder('-')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('date_sale', 'desc')
            ->filters([
                SelectFilter::make('student')
                    ->label('Aluno')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('user')
                    ->label('Vendedor')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('has_discount')
                    ->label('Com desconto')
                    ->query(fn (Builder $query) => $query->where('discount_amount', '>', 0)),

                TrashedFilter::make()
                    ->label('Registros excluídos'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
