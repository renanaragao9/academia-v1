<?php

namespace App\Observers;

use App\Models\Student;
use App\Notifications\Student\StudentWellcome;

class StudentObserver
{
    public function created(Student $student): void
    {
        $student->notify(new StudentWellcome($student));
    }
}
