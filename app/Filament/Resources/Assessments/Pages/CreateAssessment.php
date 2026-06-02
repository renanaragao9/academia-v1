<?php

namespace App\Filament\Resources\Assessments\Pages;

use App\Filament\Resources\Assessments\AssessmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAssessment extends CreateRecord
{
    protected static string $resource = AssessmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function preserveFormDataWhenCreatingAnother(array $data): array
    {
        return [
            'student_id' => $data['student_id'] ?? null,
            'assessed_at' => now()->toDateString(),
        ];
    }

    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        $data = [
            'assessed_at' => now()->toDateString(),
        ];

        if ($studentId = request()->query('student_id')) {
            $data['student_id'] = $studentId;
        }

        $this->form->fill($data);

        $this->callHook('afterFill');
    }
}
