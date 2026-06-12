<?php

namespace Database\Seeders;

use App\Models\BookingType;
use Illuminate\Database\Seeder;

class BookingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Musculação',           'description' => 'Treino de musculação e aparelhos'],
            ['name' => 'Funcional',            'description' => 'Treino funcional com exercícios variados'],
            ['name' => 'Crossfit',             'description' => 'Treino de alta intensidade estilo crossfit'],
            ['name' => 'Spinning',             'description' => 'Aula de ciclismo indoor em bicicletas estacionárias'],
            ['name' => 'Jump',                 'description' => 'Aula de jump com mini trampolins'],
            ['name' => 'Zumba',                'description' => 'Dança fitness com coreografias latinas'],
            ['name' => 'Fit Dance',            'description' => 'Aula de dança coreografada ao som de músicas atuais'],
            ['name' => 'Ballet Fit',           'description' => 'Treino inspirado no ballet clássico'],
            ['name' => 'Pilates',              'description' => 'Pilates solo ou com aparelhos'],
            ['name' => 'Yoga',                 'description' => 'Prática de yoga para corpo e mente'],
            ['name' => 'Alongamento',          'description' => 'Aula de alongamento e flexibilidade'],
            ['name' => 'Body Pump',            'description' => 'Treino com barras e anilhas ao som de música'],
            ['name' => 'Localizada',           'description' => 'Treino de musculação localizada por grupos musculares'],
            ['name' => 'Step',                 'description' => 'Aula aeróbica com plataforma step'],
            ['name' => 'GAP',                  'description' => 'Treino focado em glúteos, abdômen e pernas'],
            ['name' => 'HIIT',                 'description' => 'Treino intervalado de alta intensidade'],
            ['name' => 'Muay Thai',            'description' => 'Arte marcial tailandesa'],
            ['name' => 'Jiu-Jitsu',            'description' => 'Arte marcial japonesa de grappling e submissão'],
            ['name' => 'Judô',                 'description' => 'Arte marcial japonesa de projeções e quedas'],
            ['name' => 'Karatê',               'description' => 'Arte marcial japonesa de golpes'],
            ['name' => 'Taekwondo',            'description' => 'Arte marcial coreana focada em chutes'],
            ['name' => 'Boxe',                 'description' => 'Boxe olímpico e condicionamento'],
            ['name' => 'Kickboxing',           'description' => 'Arte marcial que combina chutes e socos'],
            ['name' => 'Capoeira',             'description' => 'Arte marcial brasileira que mistura dança e música'],
            ['name' => 'Personal Trainer',     'description' => 'Treino personalizado com acompanhamento individual'],
        ];

        foreach ($types as $type) {
            BookingType::updateOrCreate(
                ['name' => $type['name']],
                array_merge($type, ['is_active' => true])
            );
        }
    }
}
