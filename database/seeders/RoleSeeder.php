<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::updateOrCreate(
            ['name' => 'Admin'],
            ['description' => 'Acesso total ao sistema']
        );

        // Associa todas as permissions de user ao role Admin
        $userPermissions = Permission::where('group', 'user')->pluck('id');
        $admin->permissions()->sync($userPermissions);
    }
}
