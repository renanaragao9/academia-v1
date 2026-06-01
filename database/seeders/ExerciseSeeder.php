<?php

namespace Database\Seeders;

use App\Models\EquipmentType;
use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        // Helpers para buscar IDs pelo nome
        $muscle = fn (string $name) => MuscleGroup::where('name', $name)->value('id');
        $equip = fn (string $name) => EquipmentType::where('name', $name)->value('id');

        $exercises = [
            // Peito
            ['name' => 'Supino Reto com Barra',       'muscle' => 'Peito',      'equipment' => 'Barra',    'description' => 'Exercício composto para peitoral maior com barra olímpica no banco reto.'],
            ['name' => 'Supino Inclinado com Haltere', 'muscle' => 'Peito',      'equipment' => 'Haltere',  'description' => 'Supino inclinado com halteres para ênfase na porção superior do peitoral.'],
            ['name' => 'Crucifixo na Máquina',         'muscle' => 'Peito',      'equipment' => 'Máquina',  'description' => 'Exercício de isolamento para o peitoral em máquina de crucifixo.'],
            ['name' => 'Crossover no Cabo',            'muscle' => 'Peito',      'equipment' => 'Cabo e Polia', 'description' => 'Exercício de isolamento para o peitoral utilizando cabos e polias.'],

            // Costas
            ['name' => 'Puxada Frontal',               'muscle' => 'Costas',     'equipment' => 'Máquina',  'description' => 'Exercício composto para latíssimo do dorso na polia alta.'],
            ['name' => 'Remada Curvada com Barra',     'muscle' => 'Costas',     'equipment' => 'Barra',    'description' => 'Remada com tronco inclinado para espessura das costas.'],
            ['name' => 'Remada Unilateral com Haltere', 'muscle' => 'Costas',     'equipment' => 'Haltere',  'description' => 'Remada unilateral apoiada no banco para costas e bíceps.'],
            ['name' => 'Pulldown no Cabo',             'muscle' => 'Costas',     'equipment' => 'Cabo e Polia', 'description' => 'Puxada no cabo para latíssimo do dorso.'],

            // Ombros
            ['name' => 'Desenvolvimento com Barra',    'muscle' => 'Ombros',     'equipment' => 'Barra',    'description' => 'Exercício composto para deltoides com barra acima da cabeça.'],
            ['name' => 'Elevação Lateral com Haltere', 'muscle' => 'Ombros',     'equipment' => 'Haltere',  'description' => 'Isolamento para deltoides medial com halteres.'],
            ['name' => 'Elevação Frontal no Cabo',     'muscle' => 'Ombros',     'equipment' => 'Cabo e Polia', 'description' => 'Elevação frontal no cabo para deltoides anterior.'],

            // Bíceps
            ['name' => 'Rosca Direta com Barra',       'muscle' => 'Bíceps',     'equipment' => 'Barra',    'description' => 'Exercício clássico de isolamento para bíceps com barra.'],
            ['name' => 'Rosca Alternada com Haltere',  'muscle' => 'Bíceps',     'equipment' => 'Haltere',  'description' => 'Rosca alternada unilateral para bíceps com halteres.'],
            ['name' => 'Rosca no Cabo',                'muscle' => 'Bíceps',     'equipment' => 'Cabo e Polia', 'description' => 'Rosca bíceps na polia baixa para tensão constante.'],

            // Tríceps
            ['name' => 'Tríceps Pulley',               'muscle' => 'Tríceps',    'equipment' => 'Cabo e Polia', 'description' => 'Extensão de tríceps na polia alta com corda ou barra.'],
            ['name' => 'Tríceps Francês com Haltere',  'muscle' => 'Tríceps',    'equipment' => 'Haltere',  'description' => 'Extensão de tríceps acima da cabeça com haltere.'],
            ['name' => 'Mergulho no Banco',            'muscle' => 'Tríceps',    'equipment' => 'Peso Corporal', 'description' => 'Exercício de peso corporal para tríceps apoiado no banco.'],

            // Quadríceps
            ['name' => 'Agachamento Livre',            'muscle' => 'Quadríceps', 'equipment' => 'Barra',    'description' => 'Exercício composto fundamental para membros inferiores.'],
            ['name' => 'Leg Press 45°',                'muscle' => 'Quadríceps', 'equipment' => 'Máquina',  'description' => 'Exercício composto para quadríceps e glúteos na máquina leg press.'],
            ['name' => 'Extensora',                    'muscle' => 'Quadríceps', 'equipment' => 'Máquina',  'description' => 'Isolamento para quadríceps na cadeira extensora.'],

            // Posterior de Coxa
            ['name' => 'Mesa Flexora',                 'muscle' => 'Posterior de Coxa', 'equipment' => 'Máquina', 'description' => 'Isolamento para isquiotibiais na mesa flexora.'],
            ['name' => 'Stiff com Barra',              'muscle' => 'Posterior de Coxa', 'equipment' => 'Barra',   'description' => 'Exercício para isquiotibiais e lombar com barra.'],

            // Glúteos
            ['name' => 'Hip Thrust com Barra',         'muscle' => 'Glúteos',    'equipment' => 'Barra',    'description' => 'Exercício de elevação pélvica para glúteos com barra.'],
            ['name' => 'Abdução no Cabo',              'muscle' => 'Glúteos',    'equipment' => 'Cabo e Polia', 'description' => 'Abdução de quadril no cabo para glúteo médio.'],

            // Panturrilha
            ['name' => 'Panturrilha em Pé na Máquina', 'muscle' => 'Panturrilha', 'equipment' => 'Máquina', 'description' => 'Elevação de panturrilha em pé na máquina específica.'],
            ['name' => 'Panturrilha Sentado',          'muscle' => 'Panturrilha', 'equipment' => 'Máquina', 'description' => 'Elevação de panturrilha sentado para ênfase no sóleo.'],

            // Abdômen
            ['name' => 'Abdominal Crunch',             'muscle' => 'Abdômen',    'equipment' => 'Peso Corporal', 'description' => 'Exercício clássico de flexão de tronco para reto abdominal.'],
            ['name' => 'Prancha',                      'muscle' => 'Core',       'equipment' => 'Peso Corporal', 'description' => 'Exercício isométrico de estabilização do core.'],
            ['name' => 'Abdominal na Polia',           'muscle' => 'Abdômen',    'equipment' => 'Cabo e Polia', 'description' => 'Crunch com resistência na polia alta.'],
        ];

        foreach ($exercises as $data) {
            $muscleId = $muscle($data['muscle']);
            $equipId = $equip($data['equipment']);

            if (! $muscleId || ! $equipId) {
                continue;
            }

            Exercise::updateOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'muscle_group_id' => $muscleId,
                    'equipment_type_id' => $equipId,
                    'is_active' => true,
                ]
            );
        }
    }
}
