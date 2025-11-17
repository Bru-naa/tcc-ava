<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'secretaria',
            'professor',
            'coordenador',
            'direcao',
        ];

        foreach ($roles as $roleNome){
             Role::updateOrCreate(
                ['slug'=> Str::slug($roleNome)],
                ['name'=>ucfirst($roleNome)]
             );
        }
    }
}
