<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@admin.com',
             'password' => 'admin',
         ]);

        Produto::factory()->create([
            'nome' => 'Produto 1',
            'imagem' => 'https://bootdey.com/img/Content/avatar/avatar1.png',
            'preco' => 910.50,
        ]);

        Produto::factory()->create([
            'nome' => 'Produto 2',
            'imagem' => 'https://bootdey.com/img/Content/avatar/avatar2.png',
            'preco' => 85.15,
        ]);

        Produto::factory()->create([
            'nome' => 'Produto 3',
            'imagem' => 'https://bootdey.com/img/Content/avatar/avatar3.png',
            'preco' => 8,
        ]);
    }
}
