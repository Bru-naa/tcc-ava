<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Regional;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Regional::updateOrCreate(
           ['reg_codigo' => 'REG001'],
            [
                'reg_nome' => 'Regional Teste 01',
                
                'reg_telefone' => '(61) 98888-8888',
                'reg_email' => 'regionaltestes@gov.br',
                'reg_endereco' => 'SGAN 605 Módulo C Lote 3',
                'reg_cidade' => 'Brasília',
                'reg_estado' => 'DF',
                'reg_responsavel_nome' => 'Responsável Teste 01',   

            ]
            );
    }
}
