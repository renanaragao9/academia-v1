<?php

namespace Database\Seeders;

use App\Models\PlanType;
use Illuminate\Database\Seeder;

class PlanTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Mensal',      'description' => 'Plano com vigência de 1 mês'],
            ['name' => 'Trimestral',  'description' => 'Plano com vigência de 3 meses'],
            ['name' => 'Semestral',   'description' => 'Plano com vigência de 6 meses'],
            ['name' => 'Anual',       'description' => 'Plano com vigência de 12 meses'],
            ['name' => 'Diário',      'description' => 'Acesso avulso por dia'],
            ['name' => 'Semanal',     'description' => 'Plano com vigência de 7 dias'],
            ['name' => 'Personal',    'description' => 'Plano com acompanhamento de personal trainer'],
            ['name' => 'Corporativo', 'description' => 'Plano para empresas e convênios'],
            ['name' => 'Estudante',   'description' => 'Plano com desconto para estudantes'],
        ];

        foreach ($types as $type) {
            PlanType::updateOrCreate(
                ['name' => $type['name']],
                array_merge($type, ['is_active' => true])
            );
        }
    }
}
