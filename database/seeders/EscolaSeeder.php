<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Escola;

class EscolaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Escola::updateOrCreate(
            ['esc_codigo' => 'ESC001'],
            [
                'esc_nome'       => 'Escola Teste 01',
                'esc_endereco'   => 'Rua Exemplo, 123',
                'esc_telefone'   => '(61) 99999-9999',
                'esc_email'      => 'escola@example.com',
                'ativo'          => true,
                'esc_tipo'       => 'Publica',
                'regional_id'    => 1, // ajuste conforme existirem regionais
            ]
        );
    }
}
