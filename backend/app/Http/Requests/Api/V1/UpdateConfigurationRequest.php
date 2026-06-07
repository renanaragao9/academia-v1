<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigurationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                            => ['sometimes', 'required', 'string', 'max:255'],
            'cnpj'                            => ['sometimes', 'nullable', 'string', 'max:18'],
            'email'                           => ['sometimes', 'nullable', 'email', 'max:255'],
            'phone'                           => ['sometimes', 'nullable', 'string', 'max:20'],
            'whatsapp'                        => ['sometimes', 'nullable', 'string', 'max:20'],
            'emergency_phone'                 => ['sometimes', 'nullable', 'string', 'max:20'],
            'zip_code'                        => ['sometimes', 'nullable', 'string', 'max:10'],
            'address'                         => ['sometimes', 'nullable', 'string', 'max:255'],
            'number'                          => ['sometimes', 'nullable', 'string', 'max:20'],
            'complement'                      => ['sometimes', 'nullable', 'string', 'max:255'],
            'neighborhood'                    => ['sometimes', 'nullable', 'string', 'max:255'],
            'city'                            => ['sometimes', 'nullable', 'string', 'max:255'],
            'state'                           => ['sometimes', 'nullable', 'string', 'max:2'],
            'website'                         => ['sometimes', 'nullable', 'url', 'max:255'],
            'instagram'                       => ['sometimes', 'nullable', 'string', 'max:255'],
            'facebook'                        => ['sometimes', 'nullable', 'string', 'max:255'],
            'youtube'                         => ['sometimes', 'nullable', 'string', 'max:255'],
            'logo'                            => ['sometimes', 'nullable', 'string', 'max:255'],
            'favicon'                         => ['sometimes', 'nullable', 'string', 'max:255'],
            'description'                     => ['sometimes', 'nullable', 'string'],
            'notes'                           => ['sometimes', 'nullable', 'string'],
            'opening_hours'                   => ['sometimes', 'nullable', 'string'],
            'opening_time'                    => ['sometimes', 'nullable', 'date_format:H:i'],
            'closing_time'                    => ['sometimes', 'nullable', 'date_format:H:i'],
            'default_training_duration_days'  => ['sometimes', 'nullable', 'integer', 'min:1'],
            'default_assessment_duration_days'=> ['sometimes', 'nullable', 'integer', 'min:1'],
            'max_workouts_per_student'        => ['sometimes', 'nullable', 'integer', 'min:1'],
            'allow_student_registration'      => ['sometimes', 'boolean'],
            'allow_online_assessments'        => ['sometimes', 'boolean'],
            'send_email_notifications'        => ['sometimes', 'boolean'],
            'send_whatsapp_notifications'     => ['sometimes', 'boolean'],
            'is_active'                       => ['sometimes', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'                             => 'nome',
            'cnpj'                             => 'CNPJ',
            'email'                            => 'e-mail',
            'phone'                            => 'telefone',
            'whatsapp'                         => 'WhatsApp',
            'emergency_phone'                  => 'telefone de emergência',
            'zip_code'                         => 'CEP',
            'address'                          => 'endereço',
            'number'                           => 'número',
            'complement'                       => 'complemento',
            'neighborhood'                     => 'bairro',
            'city'                             => 'cidade',
            'state'                            => 'estado',
            'website'                          => 'site',
            'opening_time'                     => 'horário de abertura',
            'closing_time'                     => 'horário de fechamento',
            'default_training_duration_days'   => 'duração padrão do treino (dias)',
            'default_assessment_duration_days' => 'duração padrão da avaliação (dias)',
            'max_workouts_per_student'         => 'máximo de treinos por aluno',
            'allow_student_registration'       => 'permitir cadastro de alunos',
            'allow_online_assessments'         => 'permitir avaliações online',
            'send_email_notifications'         => 'enviar notificações por e-mail',
            'send_whatsapp_notifications'      => 'enviar notificações por WhatsApp',
        ];
    }
}
