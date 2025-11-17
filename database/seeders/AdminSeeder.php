<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // procura a role pelo campo 'slug'
        $adminRoleId = DB::table('roles')->where('slug', 'admin')->value('id');

        if (! $adminRoleId) {
            // cria a role admin caso não exista 
            $adminRoleId = DB::table('roles')->insertGetId([
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrador do sistema',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // evita duplicar o usuário ao rodar o seeder várias vezes
        User::updateOrCreate(
            ['email' => 'teste@admin.gov.br'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123#'),
                'escola_id' => null,
                'role_id' => $adminRoleId,
            ]
        );
    }
}
