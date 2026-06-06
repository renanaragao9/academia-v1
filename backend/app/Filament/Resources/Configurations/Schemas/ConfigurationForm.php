<?php

namespace App\Filament\Resources\Configurations\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConfigurationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // Informações básicas
                Section::make('Informações Básicas')
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome da Academia')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('cnpj')
                            ->label('CNPJ')
                            ->mask('##.###.###/####-##')
                            ->nullable(),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->nullable(),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->mask('(##) ####-####')
                            ->nullable(),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->mask('(##) #####-####')
                            ->nullable(),

                        TextInput::make('emergency_phone')
                            ->label('Telefone de Emergência')
                            ->mask('(##) #####-####')
                            ->nullable(),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->nullable(),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                // Logo e Favicon
                Section::make('Imagens')
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->nullable(),

                        FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->nullable(),
                    ]),

                // Endereço
                Section::make('Endereço')
                    ->columnSpan(3)
                    ->columns(3)
                    ->schema([
                        TextInput::make('zip_code')
                            ->label('CEP')
                            ->mask('#####-###')
                            ->nullable(),

                        TextInput::make('address')
                            ->label('Endereço')
                            ->nullable()
                            ->columnSpan(2),

                        TextInput::make('number')
                            ->label('Número'),

                        TextInput::make('complement')
                            ->label('Complemento')
                            ->nullable()
                            ->columnSpan(2),

                        TextInput::make('neighborhood')
                            ->label('Bairro')
                            ->nullable(),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->nullable(),

                        TextInput::make('state')
                            ->label('Estado')
                            ->maxLength(2)
                            ->nullable(),
                    ]),

                // Redes Sociais
                Section::make('Redes Sociais')
                    ->columnSpan(3)
                    ->columns(3)
                    ->schema([
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->prefix('@')
                            ->nullable(),

                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->nullable(),

                        TextInput::make('youtube')
                            ->label('YouTube')
                            ->prefix('@')
                            ->nullable(),
                    ]),

                // Horários
                Section::make('Horários de Funcionamento')
                    ->columnSpan(3)
                    ->columns(2)
                    ->schema([
                        TimePicker::make('opening_time')
                            ->label('Horário de Abertura')
                            ->nullable(),

                        TimePicker::make('closing_time')
                            ->label('Horário de Fechamento')
                            ->nullable(),

                        Textarea::make('opening_hours')
                            ->label('Horários de Funcionamento (Descrição)')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                // Configurações
                Section::make('Configurações Gerais')
                    ->columnSpan(3)
                    ->columns(2)
                    ->schema([
                        TextInput::make('default_training_duration_days')
                            ->label('Duração Padrão de Treino (dias)')
                            ->numeric()
                            ->default(30),

                        TextInput::make('default_assessment_duration_days')
                            ->label('Duração Padrão de Avaliação (dias)')
                            ->numeric()
                            ->default(90),

                        TextInput::make('max_workouts_per_student')
                            ->label('Máximo de Treinos por Aluno')
                            ->numeric()
                            ->nullable(),

                        Checkbox::make('allow_student_registration')
                            ->label('Permitir Registro de Alunos')
                            ->default(true),

                        Checkbox::make('allow_online_assessments')
                            ->label('Permitir Avaliações Online')
                            ->default(true),

                        Checkbox::make('send_email_notifications')
                            ->label('Enviar Notificações por E-mail')
                            ->default(true),

                        Checkbox::make('send_whatsapp_notifications')
                            ->label('Enviar Notificações por WhatsApp')
                            ->default(false),

                        Checkbox::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                    ]),

                // Notas
                Section::make('Notas')
                    ->columnSpan(3)
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notas Internas')
                            ->rows(4)
                            ->nullable(),
                    ]),
            ]);
    }
}
