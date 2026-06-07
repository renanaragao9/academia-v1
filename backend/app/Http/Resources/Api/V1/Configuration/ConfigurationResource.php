<?php

namespace App\Http\Resources\Api\V1\Configuration;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'description' => $this->description,

            'contact' => [
                'email' => $this->email,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'emergency_phone' => $this->emergency_phone,
            ],

            'address' => [
                'zip_code' => $this->zip_code,
                'street' => $this->address,
                'number' => $this->number,
                'complement' => $this->complement,
                'neighborhood' => $this->neighborhood,
                'city' => $this->city,
                'state' => $this->state,
                'full' => $this->buildFullAddress(),
            ],

            'social' => [
                'website' => $this->website,
                'instagram' => $this->instagram,
                'facebook' => $this->facebook,
                'youtube' => $this->youtube,
            ],

            'branding' => [
                'logo' => $this->logo,
                'favicon' => $this->favicon,
            ],

            'schedule' => [
                'opening_hours' => $this->opening_hours,
                'opening_time' => $this->opening_time?->format('H:i'),
                'closing_time' => $this->closing_time?->format('H:i'),
            ],

            'settings' => [
                'default_training_duration_days' => $this->default_training_duration_days,
                'default_assessment_duration_days' => $this->default_assessment_duration_days,
                'max_workouts_per_student' => $this->max_workouts_per_student,
                'allow_student_registration' => $this->allow_student_registration,
                'allow_online_assessments' => $this->allow_online_assessments,
                'send_email_notifications' => $this->send_email_notifications,
                'send_whatsapp_notifications' => $this->send_whatsapp_notifications,
            ],

            'notes' => $this->notes,
            'is_active' => $this->is_active,

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function buildFullAddress(): ?string
    {
        $parts = array_filter([
            $this->address,
            $this->number,
            $this->complement,
            $this->neighborhood,
            $this->city && $this->state ? "{$this->city} - {$this->state}" : ($this->city ?? $this->state),
            $this->zip_code ? "CEP {$this->zip_code}" : null,
        ]);

        return $parts ? implode(', ', $parts) : null;
    }
}
