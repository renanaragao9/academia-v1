<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            ['name' => 'Ver Usuários',     'code' => 'user.view',   'group' => 'user'],
            ['name' => 'Editar Usuários',  'code' => 'user.edit',   'group' => 'user'],
            ['name' => 'Atualizar Usuários', 'code' => 'user.update', 'group' => 'user'],
            ['name' => 'Deletar Usuários', 'code' => 'user.delete', 'group' => 'user'],

            // Permissions
            ['name' => 'Ver Permissões',      'code' => 'permission.view',   'group' => 'permission'],
            ['name' => 'Criar Permissões',    'code' => 'permission.create', 'group' => 'permission'],
            ['name' => 'Editar Permissões',   'code' => 'permission.edit',   'group' => 'permission'],
            ['name' => 'Atualizar Permissões', 'code' => 'permission.update', 'group' => 'permission'],
            ['name' => 'Deletar Permissões',  'code' => 'permission.delete', 'group' => 'permission'],

            // Roles
            ['name' => 'Ver Perfis',      'code' => 'role.view',   'group' => 'role'],
            ['name' => 'Criar Perfis',    'code' => 'role.create', 'group' => 'role'],
            ['name' => 'Editar Perfis',   'code' => 'role.edit',   'group' => 'role'],
            ['name' => 'Atualizar Perfis', 'code' => 'role.update', 'group' => 'role'],
            ['name' => 'Deletar Perfis',  'code' => 'role.delete', 'group' => 'role'],

            // Training Divisions
            ['name' => 'Ver Divisões de Treino',     'code' => 'training_division.view',   'group' => 'training_division'],
            ['name' => 'Criar Divisões de Treino',   'code' => 'training_division.create', 'group' => 'training_division'],
            ['name' => 'Editar Divisões de Treino',  'code' => 'training_division.edit',   'group' => 'training_division'],
            ['name' => 'Atualizar Divisões de Treino', 'code' => 'training_division.update', 'group' => 'training_division'],
            ['name' => 'Deletar Divisões de Treino', 'code' => 'training_division.delete', 'group' => 'training_division'],

            // Muscle Groups
            ['name' => 'Ver Grupos Musculares',     'code' => 'muscle_group.view',   'group' => 'muscle_group'],
            ['name' => 'Criar Grupos Musculares',   'code' => 'muscle_group.create', 'group' => 'muscle_group'],
            ['name' => 'Editar Grupos Musculares',  'code' => 'muscle_group.edit',   'group' => 'muscle_group'],
            ['name' => 'Atualizar Grupos Musculares', 'code' => 'muscle_group.update', 'group' => 'muscle_group'],
            ['name' => 'Deletar Grupos Musculares', 'code' => 'muscle_group.delete', 'group' => 'muscle_group'],

            // Measurement Types
            ['name' => 'Ver Tipos de Medição',     'code' => 'measurement_type.view',   'group' => 'measurement_type'],
            ['name' => 'Criar Tipos de Medição',   'code' => 'measurement_type.create', 'group' => 'measurement_type'],
            ['name' => 'Editar Tipos de Medição',  'code' => 'measurement_type.edit',   'group' => 'measurement_type'],
            ['name' => 'Atualizar Tipos de Medição', 'code' => 'measurement_type.update', 'group' => 'measurement_type'],
            ['name' => 'Deletar Tipos de Medição', 'code' => 'measurement_type.delete', 'group' => 'measurement_type'],

            // Payment Types
            ['name' => 'Ver Tipos de Pagamento',     'code' => 'payment_type.view',   'group' => 'payment_type'],
            ['name' => 'Criar Tipos de Pagamento',   'code' => 'payment_type.create', 'group' => 'payment_type'],
            ['name' => 'Editar Tipos de Pagamento',  'code' => 'payment_type.edit',   'group' => 'payment_type'],
            ['name' => 'Atualizar Tipos de Pagamento', 'code' => 'payment_type.update', 'group' => 'payment_type'],
            ['name' => 'Deletar Tipos de Pagamento', 'code' => 'payment_type.delete', 'group' => 'payment_type'],

            // Equipment Types
            ['name' => 'Ver Tipos de Equipamento',     'code' => 'equipment_type.view',   'group' => 'equipment_type'],
            ['name' => 'Criar Tipos de Equipamento',   'code' => 'equipment_type.create', 'group' => 'equipment_type'],
            ['name' => 'Editar Tipos de Equipamento',  'code' => 'equipment_type.edit',   'group' => 'equipment_type'],
            ['name' => 'Atualizar Tipos de Equipamento', 'code' => 'equipment_type.update', 'group' => 'equipment_type'],
            ['name' => 'Deletar Tipos de Equipamento', 'code' => 'equipment_type.delete', 'group' => 'equipment_type'],

            // Plan Types
            ['name' => 'Ver Tipos de Plano',     'code' => 'plan_type.view',   'group' => 'plan_type'],
            ['name' => 'Criar Tipos de Plano',   'code' => 'plan_type.create', 'group' => 'plan_type'],
            ['name' => 'Editar Tipos de Plano',  'code' => 'plan_type.edit',   'group' => 'plan_type'],
            ['name' => 'Atualizar Tipos de Plano', 'code' => 'plan_type.update', 'group' => 'plan_type'],
            ['name' => 'Deletar Tipos de Plano', 'code' => 'plan_type.delete', 'group' => 'plan_type'],

            // Food Types
            ['name' => 'Ver Tipos de Alimentos',     'code' => 'food_type.view',   'group' => 'food_type'],
            ['name' => 'Criar Tipos de Alimentos',   'code' => 'food_type.create', 'group' => 'food_type'],
            ['name' => 'Editar Tipos de Alimentos',  'code' => 'food_type.edit',   'group' => 'food_type'],
            ['name' => 'Atualizar Tipos de Alimentos', 'code' => 'food_type.update', 'group' => 'food_type'],
            ['name' => 'Deletar Tipos de Alimentos', 'code' => 'food_type.delete', 'group' => 'food_type'],

            // Item Types
            ['name' => 'Ver Tipos de Itens',     'code' => 'item_type.view',   'group' => 'item_type'],
            ['name' => 'Criar Tipos de Itens',   'code' => 'item_type.create', 'group' => 'item_type'],
            ['name' => 'Editar Tipos de Itens',  'code' => 'item_type.edit',   'group' => 'item_type'],
            ['name' => 'Atualizar Tipos de Itens', 'code' => 'item_type.update', 'group' => 'item_type'],
            ['name' => 'Deletar Tipos de Itens', 'code' => 'item_type.delete', 'group' => 'item_type'],

            // Meal Types
            ['name' => 'Ver Tipos de Refeição',     'code' => 'meal_type.view',   'group' => 'meal_type'],
            ['name' => 'Criar Tipos de Refeição',   'code' => 'meal_type.create', 'group' => 'meal_type'],
            ['name' => 'Editar Tipos de Refeição',  'code' => 'meal_type.edit',   'group' => 'meal_type'],
            ['name' => 'Atualizar Tipos de Refeição', 'code' => 'meal_type.update', 'group' => 'meal_type'],
            ['name' => 'Deletar Tipos de Refeição', 'code' => 'meal_type.delete', 'group' => 'meal_type'],

            // Expense Types
            ['name' => 'Ver Tipos de Despesa',     'code' => 'expense_type.view',   'group' => 'expense_type'],
            ['name' => 'Criar Tipos de Despesa',   'code' => 'expense_type.create', 'group' => 'expense_type'],
            ['name' => 'Editar Tipos de Despesa',  'code' => 'expense_type.edit',   'group' => 'expense_type'],
            ['name' => 'Atualizar Tipos de Despesa', 'code' => 'expense_type.update', 'group' => 'expense_type'],
            ['name' => 'Deletar Tipos de Despesa', 'code' => 'expense_type.delete', 'group' => 'expense_type'],

            // Exercises
            ['name' => 'Ver Exercícios',     'code' => 'exercise.view',   'group' => 'exercise'],
            ['name' => 'Criar Exercícios',   'code' => 'exercise.create', 'group' => 'exercise'],
            ['name' => 'Editar Exercícios',  'code' => 'exercise.edit',   'group' => 'exercise'],
            ['name' => 'Atualizar Exercícios', 'code' => 'exercise.update', 'group' => 'exercise'],
            ['name' => 'Deletar Exercícios', 'code' => 'exercise.delete', 'group' => 'exercise'],

            // Students
            ['name' => 'Ver Alunos',     'code' => 'student.view',   'group' => 'student'],
            ['name' => 'Criar Alunos',   'code' => 'student.create', 'group' => 'student'],
            ['name' => 'Editar Alunos',  'code' => 'student.edit',   'group' => 'student'],
            ['name' => 'Atualizar Alunos', 'code' => 'student.update', 'group' => 'student'],
            ['name' => 'Deletar Alunos', 'code' => 'student.delete', 'group' => 'student'],

            // Training Sheets
            ['name' => 'Ver Fichas de Treino',     'code' => 'training_sheet.view',   'group' => 'training_sheet'],
            ['name' => 'Criar Fichas de Treino',   'code' => 'training_sheet.create', 'group' => 'training_sheet'],
            ['name' => 'Editar Fichas de Treino',  'code' => 'training_sheet.edit',   'group' => 'training_sheet'],
            ['name' => 'Atualizar Fichas de Treino', 'code' => 'training_sheet.update', 'group' => 'training_sheet'],
            ['name' => 'Deletar Fichas de Treino', 'code' => 'training_sheet.delete', 'group' => 'training_sheet'],

            // Training Sheet Divisions
            ['name' => 'Ver Divisões de Ficha de Treino',     'code' => 'training_sheet_division.view',   'group' => 'training_sheet_division'],
            ['name' => 'Criar Divisões de Ficha de Treino',   'code' => 'training_sheet_division.create', 'group' => 'training_sheet_division'],
            ['name' => 'Editar Divisões de Ficha de Treino',  'code' => 'training_sheet_division.edit',   'group' => 'training_sheet_division'],
            ['name' => 'Atualizar Divisões de Ficha de Treino', 'code' => 'training_sheet_division.update', 'group' => 'training_sheet_division'],
            ['name' => 'Deletar Divisões de Ficha de Treino', 'code' => 'training_sheet_division.delete', 'group' => 'training_sheet_division'],

            // Training Exercises
            ['name' => 'Ver Exercícios de Treino',     'code' => 'training_exercise.view',   'group' => 'training_exercise'],
            ['name' => 'Criar Exercícios de Treino',   'code' => 'training_exercise.create', 'group' => 'training_exercise'],
            ['name' => 'Editar Exercícios de Treino',  'code' => 'training_exercise.edit',   'group' => 'training_exercise'],
            ['name' => 'Atualizar Exercícios de Treino', 'code' => 'training_exercise.update', 'group' => 'training_exercise'],
            ['name' => 'Deletar Exercícios de Treino', 'code' => 'training_exercise.delete', 'group' => 'training_exercise'],

            // Workout Logs
            ['name' => 'Ver Registros de Treino',     'code' => 'workout_log.view',   'group' => 'workout_log'],
            ['name' => 'Criar Registros de Treino',   'code' => 'workout_log.create', 'group' => 'workout_log'],
            ['name' => 'Editar Registros de Treino',  'code' => 'workout_log.edit',   'group' => 'workout_log'],
            ['name' => 'Atualizar Registros de Treino', 'code' => 'workout_log.update', 'group' => 'workout_log'],
            ['name' => 'Deletar Registros de Treino', 'code' => 'workout_log.delete', 'group' => 'workout_log'],

            // Workout Log Exercises
            ['name' => 'Ver Exercícios de Registro de Treino',     'code' => 'workout_log_exercise.view',   'group' => 'workout_log_exercise'],
            ['name' => 'Criar Exercícios de Registro de Treino',   'code' => 'workout_log_exercise.create', 'group' => 'workout_log_exercise'],
            ['name' => 'Editar Exercícios de Registro de Treino',  'code' => 'workout_log_exercise.edit',   'group' => 'workout_log_exercise'],
            ['name' => 'Atualizar Exercícios de Registro de Treino', 'code' => 'workout_log_exercise.update', 'group' => 'workout_log_exercise'],
            ['name' => 'Deletar Exercícios de Registro de Treino', 'code' => 'workout_log_exercise.delete', 'group' => 'workout_log_exercise'],

            // Assessments
            ['name' => 'Ver Avaliações',     'code' => 'assessment.view',   'group' => 'assessment'],
            ['name' => 'Criar Avaliações',   'code' => 'assessment.create', 'group' => 'assessment'],
            ['name' => 'Editar Avaliações',  'code' => 'assessment.edit',   'group' => 'assessment'],
            ['name' => 'Atualizar Avaliações', 'code' => 'assessment.update', 'group' => 'assessment'],
            ['name' => 'Deletar Avaliações', 'code' => 'assessment.delete', 'group' => 'assessment'],

            // Foods
            ['name' => 'Ver Alimentos',     'code' => 'food.view',   'group' => 'food'],
            ['name' => 'Criar Alimentos',   'code' => 'food.create', 'group' => 'food'],
            ['name' => 'Editar Alimentos',  'code' => 'food.edit',   'group' => 'food'],
            ['name' => 'Atualizar Alimentos', 'code' => 'food.update', 'group' => 'food'],
            ['name' => 'Deletar Alimentos', 'code' => 'food.delete', 'group' => 'food'],

            // Meal Plans
            ['name' => 'Ver Planos de Refeição',     'code' => 'meal_plan.view',   'group' => 'meal_plan'],
            ['name' => 'Criar Planos de Refeição',   'code' => 'meal_plan.create', 'group' => 'meal_plan'],
            ['name' => 'Editar Planos de Refeição',  'code' => 'meal_plan.edit',   'group' => 'meal_plan'],
            ['name' => 'Atualizar Planos de Refeição', 'code' => 'meal_plan.update', 'group' => 'meal_plan'],
            ['name' => 'Deletar Planos de Refeição', 'code' => 'meal_plan.delete', 'group' => 'meal_plan'],

            // Meal Plan Meals
            ['name' => 'Ver Refeições do Plano',     'code' => 'meal_plan_meal.view',   'group' => 'meal_plan_meal'],
            ['name' => 'Criar Refeições do Plano',   'code' => 'meal_plan_meal.create', 'group' => 'meal_plan_meal'],
            ['name' => 'Editar Refeições do Plano',  'code' => 'meal_plan_meal.edit',   'group' => 'meal_plan_meal'],
            ['name' => 'Atualizar Refeições do Plano', 'code' => 'meal_plan_meal.update', 'group' => 'meal_plan_meal'],
            ['name' => 'Deletar Refeições do Plano', 'code' => 'meal_plan_meal.delete', 'group' => 'meal_plan_meal'],

            // Meal Plan Foods
            ['name' => 'Ver Alimentos do Plano de Refeição',     'code' => 'meal_plan_food.view',   'group' => 'meal_plan_food'],
            ['name' => 'Criar Alimentos do Plano de Refeição',   'code' => 'meal_plan_food.create', 'group' => 'meal_plan_food'],
            ['name' => 'Editar Alimentos do Plano de Refeição',  'code' => 'meal_plan_food.edit',   'group' => 'meal_plan_food'],
            ['name' => 'Atualizar Alimentos do Plano de Refeição', 'code' => 'meal_plan_food.update', 'group' => 'meal_plan_food'],
            ['name' => 'Deletar Alimentos do Plano de Refeição', 'code' => 'meal_plan_food.delete', 'group' => 'meal_plan_food'],

            // Monthly Fees
            ['name' => 'Ver Mensalidades',     'code' => 'monthly_fee.view',   'group' => 'monthly_fee'],
            ['name' => 'Criar Mensalidades',   'code' => 'monthly_fee.create', 'group' => 'monthly_fee'],
            ['name' => 'Editar Mensalidades',  'code' => 'monthly_fee.edit',   'group' => 'monthly_fee'],
            ['name' => 'Atualizar Mensalidades', 'code' => 'monthly_fee.update', 'group' => 'monthly_fee'],
            ['name' => 'Deletar Mensalidades', 'code' => 'monthly_fee.delete', 'group' => 'monthly_fee'],

            // Expenses
            ['name' => 'Ver Despesas',     'code' => 'expense.view',   'group' => 'expense'],
            ['name' => 'Criar Despesas',   'code' => 'expense.create', 'group' => 'expense'],
            ['name' => 'Editar Despesas',  'code' => 'expense.edit',   'group' => 'expense'],
            ['name' => 'Atualizar Despesas', 'code' => 'expense.update', 'group' => 'expense'],
            ['name' => 'Deletar Despesas', 'code' => 'expense.delete', 'group' => 'expense'],

            // Booking Types
            ['name' => 'Ver Tipos de Reserva',     'code' => 'booking_type.view',   'group' => 'booking_type'],
            ['name' => 'Criar Tipos de Reserva',   'code' => 'booking_type.create', 'group' => 'booking_type'],
            ['name' => 'Editar Tipos de Reserva',  'code' => 'booking_type.edit',   'group' => 'booking_type'],
            ['name' => 'Atualizar Tipos de Reserva', 'code' => 'booking_type.update', 'group' => 'booking_type'],
            ['name' => 'Deletar Tipos de Reserva', 'code' => 'booking_type.delete', 'group' => 'booking_type'],

            // Bookings
            ['name' => 'Ver Reservas',     'code' => 'booking.view',   'group' => 'booking'],
            ['name' => 'Criar Reservas',   'code' => 'booking.create', 'group' => 'booking'],
            ['name' => 'Editar Reservas',  'code' => 'booking.edit',   'group' => 'booking'],
            ['name' => 'Atualizar Reservas', 'code' => 'booking.update', 'group' => 'booking'],
            ['name' => 'Deletar Reservas', 'code' => 'booking.delete', 'group' => 'booking'],

            // Booking Students
            ['name' => 'Ver Alunos de Reserva',     'code' => 'booking_student.view',   'group' => 'booking_student'],
            ['name' => 'Criar Alunos de Reserva',   'code' => 'booking_student.create', 'group' => 'booking_student'],
            ['name' => 'Editar Alunos de Reserva',  'code' => 'booking_student.edit',   'group' => 'booking_student'],
            ['name' => 'Atualizar Alunos de Reserva', 'code' => 'booking_student.update', 'group' => 'booking_student'],
            ['name' => 'Deletar Alunos de Reserva', 'code' => 'booking_student.delete', 'group' => 'booking_student'],

            // Field Types
            ['name' => 'Ver Tipos de Campo',     'code' => 'field_type.view',   'group' => 'field_type'],
            ['name' => 'Criar Tipos de Campo',   'code' => 'field_type.create', 'group' => 'field_type'],
            ['name' => 'Editar Tipos de Campo',  'code' => 'field_type.edit',   'group' => 'field_type'],
            ['name' => 'Atualizar Tipos de Campo', 'code' => 'field_type.update', 'group' => 'field_type'],
            ['name' => 'Deletar Tipos de Campo', 'code' => 'field_type.delete', 'group' => 'field_type'],

            // Items
            ['name' => 'Ver Itens',     'code' => 'item.view',   'group' => 'item'],
            ['name' => 'Criar Itens',   'code' => 'item.create', 'group' => 'item'],
            ['name' => 'Editar Itens',  'code' => 'item.edit',   'group' => 'item'],
            ['name' => 'Atualizar Itens', 'code' => 'item.update', 'group' => 'item'],
            ['name' => 'Deletar Itens', 'code' => 'item.delete', 'group' => 'item'],

            // Item Field Types
            ['name' => 'Ver Campos de Itens',     'code' => 'item_field_type.view',   'group' => 'item_field_type'],
            ['name' => 'Criar Campos de Itens',   'code' => 'item_field_type.create', 'group' => 'item_field_type'],
            ['name' => 'Editar Campos de Itens',  'code' => 'item_field_type.edit',   'group' => 'item_field_type'],
            ['name' => 'Atualizar Campos de Itens', 'code' => 'item_field_type.update', 'group' => 'item_field_type'],
            ['name' => 'Deletar Campos de Itens', 'code' => 'item_field_type.delete', 'group' => 'item_field_type'],

            // Sales
            ['name' => 'Ver Vendas',     'code' => 'sale.view',   'group' => 'sale'],
            ['name' => 'Criar Vendas',   'code' => 'sale.create', 'group' => 'sale'],
            ['name' => 'Editar Vendas',  'code' => 'sale.edit',   'group' => 'sale'],
            ['name' => 'Atualizar Vendas', 'code' => 'sale.update', 'group' => 'sale'],
            ['name' => 'Deletar Vendas', 'code' => 'sale.delete', 'group' => 'sale'],

            // Sale Items
            ['name' => 'Ver Itens de Venda',     'code' => 'sale_item.view',   'group' => 'sale_item'],
            ['name' => 'Criar Itens de Venda',   'code' => 'sale_item.create', 'group' => 'sale_item'],
            ['name' => 'Editar Itens de Venda',  'code' => 'sale_item.edit',   'group' => 'sale_item'],
            ['name' => 'Atualizar Itens de Venda', 'code' => 'sale_item.update', 'group' => 'sale_item'],
            ['name' => 'Deletar Itens de Venda', 'code' => 'sale_item.delete', 'group' => 'sale_item'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['code' => $permission['code']],
                $permission
            );
        }
    }
}
