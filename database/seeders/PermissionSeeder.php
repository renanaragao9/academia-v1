<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Ver Usuários',     'code' => 'user.view',   'group' => 'user'],
            ['name' => 'Editar Usuários',  'code' => 'user.edit',   'group' => 'user'],
            ['name' => 'Atualizar Usuários', 'code' => 'user.update', 'group' => 'user'],
            ['name' => 'Deletar Usuários', 'code' => 'user.delete', 'group' => 'user'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['code' => $permission['code']],
                $permission
            );
        }
    }
}
