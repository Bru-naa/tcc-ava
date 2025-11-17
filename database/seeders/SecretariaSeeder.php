<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
        ['email'=>'teste@secretaria.gov.br'],
            ['name' => 'Secretaria User',
                'password' => Hash::make('secretaria123#'),
                'escola_id' => null,
                'role_id' => 2, // Secretaria

        ]);
    }
}
