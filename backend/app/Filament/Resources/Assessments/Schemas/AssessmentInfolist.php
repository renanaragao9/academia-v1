<?php

namespace App\Filament\Resources\Assessments\Schemas;

use App\Models\Assessment;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssessmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Dados da Avaliação')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('student.name')
                            ->label('Aluno'),

                        TextEntry::make('measurementType.name')
                            ->label('Tipo de Medição'),

                        TextEntry::make('value')
                            ->label('Valor')
                            ->numeric(),

                        TextEntry::make('assessed_at')
                            ->label('Data da Avaliação')
                            ->date('d/m/Y'),

                        TextEntry::make('user.name')
                            ->label('Avaliador')
                            ->placeholder('-'),

                        TextEntry::make('notes')
                            ->label('Observações')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Section::make('Auditoria')
                    ->columns(2)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('deleted_at')
                            ->label('Excluído em')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('-')
                            ->visible(fn (Assessment $record): bool => $record->trashed()),
                    ]),
            ]);
    }
}
