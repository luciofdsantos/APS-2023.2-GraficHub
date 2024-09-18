<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nome' => 'admin',
            'apelido' => 'admin',
            'numero_telefone' => '998887777',
            'email' => 'adm@adm.com',
            'password' => 'adm',
        ]);
        $this->call(ReacoesSeeder::class);
        $this->call(SeguidoresSeeder::Seeder::class);
    }
}
