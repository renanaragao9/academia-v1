<?php

namespace App\Filament\Resources\Configurations\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConfigurationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                // Informações básicas
                Section::make('Informações Básicas')
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nome da Academia')
                            ->columnSpanFull(),

                        TextEntry::make('cnpj')
                            ->label('CNPJ')
                            ->placeholder('-'),

                        TextEntry::make('email')
                            ->label('E-mail')
                            ->placeholder('-'),

                        TextEntry::make('phone')
                            ->label('Telefone')
                            ->placeholder('-'),

                        TextEntry::make('whatsapp')
                            ->label('WhatsApp')
                            ->placeholder('-'),

                        TextEntry::make('emergency_phone')
                            ->label('Telefone de Emergência')
                            ->placeholder('-'),

                        TextEntry::make('website')
                            ->label('Website')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->label('Descrição')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                // Logo
                Section::make('Imagens')
                    ->columnSpan(1)
                    ->schema([
                        ImageEntry::make('logo')
                            ->label('Logo'),

                        ImageEntry::make('favicon')
                            ->label('Favicon'),
                    ]),

                // Endereço
                Section::make('Endereço')
                    ->columnSpan(3)
                    ->columns(3)
                    ->schema([
                        TextEntry::make('zip_code')
                            ->label('CEP')
                            ->placeholder('-'),

                        TextEntry::make('address')
                            ->label('Endereço')
                            ->placeholder('-')
                            ->columnSpan(2),

                        TextEntry::make('number')
                            ->label('Número')
                            ->placeholder('-'),

                        TextEntry::make('complement')
                            ->label('Complemento')
                            ->placeholder('-')
                            ->columnSpan(2),

                        TextEntry::make('neighborhood')
                            ->label('Bairro')
                            ->placeholder('-'),

                        TextEntry::make('city')
                            ->label('Cidade')
                            ->placeholder('-'),

                        TextEntry::make('state')
                            ->label('Estado')
                            ->placeholder('-'),
                    ]),

                // Redes Sociais
                Section::make('Redes Sociais')
                    ->columnSpan(3)
                    ->columns(3)
                    ->schema([
                        TextEntry::make('instagram')
                            ->label('Instagram')
                            ->placeholder('-'),

                        TextEntry::make('facebook')
                            ->label('Facebook')
                            ->placeholder('-'),

                        TextEntry::make('youtube')
                            ->label('YouTube')
                            ->placeholder('-'),
                    ]),

                // Horários
                Section::make('Horários de Funcionamento')
                    ->columnSpan(3)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('opening_time')
                            ->label('Horário de Abertura')
                            ->placeholder('-'),

                        TextEntry::make('closing_time')
                            ->label('Horário de Fechamento')
                            ->placeholder('-'),

                        TextEntry::make('opening_hours')
                            ->label('Horários de Funcionamento')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                // Configurações
                Section::make('Configurações Gerais')
                    ->columnSpan(3)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('default_training_duration_days')
                            ->label('Duração Padrão de Treino (dias)'),

                        TextEntry::make('default_assessment_duration_days')
                            ->label('Duração Padrão de Avaliação (dias)'),

                        TextEntry::make('max_workouts_per_student')
                            ->label('Máximo de Treinos por Aluno')
                            ->placeholder('-'),

                        TextEntry::make('allow_student_registration')
                            ->label('Permitir Registro de Alunos')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sim' : 'Não'),

                        TextEntry::make('allow_online_assessments')
                            ->label('Permitir Avaliações Online')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sim' : 'Não'),

                        TextEntry::make('send_email_notifications')
                            ->label('Enviar Notificações por E-mail')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sim' : 'Não'),

                        TextEntry::make('send_whatsapp_notifications')
                            ->label('Enviar Notificações por WhatsApp')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sim' : 'Não'),

                        TextEntry::make('is_active')
                            ->label('Ativo')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sim' : 'Não'),
                    ]),

                // Auditoria
                Section::make('Auditoria')
                    ->columnSpan(3)
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime('d/m/Y H:i'),
                    ]),

                // Notas
                Section::make('Notas')
                    ->columnSpan(3)
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Notas Internas')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
