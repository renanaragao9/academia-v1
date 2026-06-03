<?php

namespace Database\Seeders;

use App\Models\PlanType;
use Illuminate\Database\Seeder;

class PlanTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Mensal',      'description' => 'Plano com vigência de 1 mês',                 'period_days' => 30,  'amount_base' => 100.00],
            ['name' => 'Trimestral',  'description' => 'Plano com vigência de 3 meses',               'period_days' => 90,  'amount_base' => 270.00],
            ['name' => 'Semestral',   'description' => 'Plano com vigência de 6 meses',               'period_days' => 180, 'amount_base' => 510.00],
            ['name' => 'Anual',       'description' => 'Plano com vigência de 12 meses',              'period_days' => 365, 'amount_base' => 960.00],
            ['name' => 'Diário',      'description' => 'Acesso avulso por dia',                       'period_days' => 1,   'amount_base' => 15.00],
            ['name' => 'Semanal',     'description' => 'Plano com vigência de 7 dias',                'period_days' => 7,   'amount_base' => 50.00],
            ['name' => 'Personal',    'description' => 'Plano com acompanhamento de personal trainer', 'period_days' => 30,  'amount_base' => 300.00],
            ['name' => 'Corporativo', 'description' => 'Plano para empresas e convênios',             'period_days' => 30,  'amount_base' => 80.00],
            ['name' => 'Estudante',   'description' => 'Plano com desconto para estudantes',          'period_days' => 30,  'amount_base' => 70.00],
        ];

        foreach ($types as $type) {
            PlanType::updateOrCreate(
                ['name' => $type['name']],
                array_merge($type, ['is_active' => true])
            );
        }
    }
}
