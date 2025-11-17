<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Escola;

class EscolaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
    Escola::insert([
        [
            'esc_name' => 'Escola Teste 01',
            'esc_address' => 'QNN 28 Conjunto J Lote 12',
            'esc_phone' => '(61) 99999-9999',
            'esc_email' => 'escola.teste01@gov.br',
            'esc_codigo' => 'TEST001',
        ]
    ]);
}

}
