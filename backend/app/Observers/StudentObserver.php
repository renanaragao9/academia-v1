<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Notifications\Student\StudentWellcome;
use Illuminate\Support\Facades\Hash;

class StudentObserver
{
    public function created(Student $student): void
    {
        if ($student->email) {
            $role = Role::where('name', 'Estudante')->first();

            User::create([
                'name' => $student->name,
                'email' => $student->email,
                'password' => Hash::make($student->code),
                'status' => $student->status === 'active' ? 'active' : 'inactive',
                'role_id' => $role?->id,
            ]);
        }

        $student->notify(new StudentWellcome($student));
    }

    public function updated(Student $student): void
    {
        $user = User::where('email', $student->getOriginal('email'))->first();

        if (! $user) {
            if ($student->email) {
                $role = Role::where('name', 'Estudante')->first();

                User::create([
                    'name' => $student->name,
                    'email' => $student->email,
                    'password' => Hash::make($student->code),
                    'status' => $student->status === 'active' ? 'active' : 'inactive',
                    'role_id' => $role?->id,
                ]);
            }

            return;
        }

        $data = [];

        if ($student->isDirty('email')) {
            $data['email'] = $student->email;
        }

        if ($student->isDirty('code')) {
            $data['password'] = Hash::make($student->code);
        }

        if ($student->isDirty('name')) {
            $data['name'] = $student->name;
        }

        if ($student->isDirty('status')) {
            $data['status'] = $student->status === 'active' ? 'active' : 'inactive';
        }

        if (! empty($data)) {
            $user->update($data);
        }
    }
}
