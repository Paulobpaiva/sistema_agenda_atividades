<?php

namespace Database\Seeders;

use App\Models\Atividade;
use App\Models\Colaborador;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sistema.com'],
            [
                'name' => 'root',
                'password' => Hash::make('12345678'),
                'perfil' => 'admin',
                'ativo' => true,
            ]
        );

        $paulo = Colaborador::firstOrCreate([
            'nome' => 'Paulo Paiva',
        ]);

        $maria = Colaborador::firstOrCreate([
            'nome' => 'Maria Silva',
        ]);

        $joao = Colaborador::firstOrCreate([
            'nome' => 'João Santos',
        ]);

        Atividade::firstOrCreate([
            'data' => '2025-02-05',
            'titulo' => 'Reunião de planejamento',
            'colaborador_id' => $paulo->id,
        ]);

        Atividade::firstOrCreate([
            'data' => '2025-02-12',
            'titulo' => 'Visita técnica',
            'colaborador_id' => $maria->id,
        ]);

        Atividade::firstOrCreate([
            'data' => '2025-02-20',
            'titulo' => 'Treinamento interno',
            'colaborador_id' => $joao->id,
        ]);
    }
}