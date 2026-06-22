<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Manga;
use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::create([
            'name' => 'Admin Geral',
            'email' => 'admin@mangastore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'cpf' => '111.111.111-11',
            'phone' => '(11) 99999-9999',
            'active' => true,
        ]);

        // 2. Seed Employee User
        User::create([
            'name' => 'Funcionário Um',
            'email' => 'funcionario@mangastore.com',
            'password' => Hash::make('password'),
            'role' => 'funcionario',
            'cpf' => '222.222.222-22',
            'phone' => '(11) 88888-8888',
            'active' => true,
        ]);

        // 3. Seed Sample Mangas
        Manga::create([
            'titulo' => 'One Piece - Vol. 1',
            'autor' => 'Eiichiro Oda',
            'editora' => 'Panini',
            'preco' => 34.90,
            'estoque' => 15,
            'sinopse' => 'Houve um homem que conquistou tudo aquilo que o mundo tinha a oferecer, o lendário Rei dos Piratas, Gold Roger. Antes de morrer, suas últimas palavras enviaram multidões aos mares: "Minhas riquezas e tesouros? Se vocês quiserem, eu os deixo pegar. Procurem por ele, eu deixei tudo naquele lugar!".',
            'capa' => null,
        ]);

        Manga::create([
            'titulo' => 'Naruto - Vol. 1',
            'autor' => 'Masashi Kishimoto',
            'editora' => 'Panini',
            'preco' => 29.90,
            'estoque' => 3, // Low stock for dashboard alert testing
            'sinopse' => 'Naruto Uzumaki é um jovem shinobi travesso com um talento incomum para travessuras. Ele tem um grande sonho: tornar-se o Hokage, o maior ninja da Vila da Folha, e ser reconhecido por todos.',
            'capa' => null,
        ]);

        Manga::create([
            'titulo' => 'Demon Slayer - Vol. 1',
            'autor' => 'Koyoharu Gotouge',
            'editora' => 'Panini',
            'preco' => 32.90,
            'estoque' => 20,
            'sinopse' => 'Japão, era Taisho. Tanjiro, um jovem bondoso que vende carvão para sustentar sua família, encontra seus entes queridos assassinados por um demônio. Para piorar, sua irmã mais nova, Nezuko, a única sobrevivente, foi transformada em um demônio.',
            'capa' => null,
        ]);

        Manga::create([
            'titulo' => 'Attack on Titan - Vol. 1',
            'autor' => 'Hajime Isayama',
            'editora' => 'Panini',
            'preco' => 35.00,
            'estoque' => 0, // Out of stock for testing
            'sinopse' => 'Há mais de um século, a humanidade foi devorada por gigantes conhecidos como Titãs. Para escapar da destruição, os sobreviventes se isolaram atrás de três enormes muralhas. Mas a paz relativa é quebrada pelo aparecimento de um Titã Colossal.',
            'capa' => null,
        ]);

        Manga::create([
            'titulo' => 'Death Note - Edição Black Edition Vol. 1',
            'autor' => 'Tsugumi Ohba',
            'editora' => 'JBC',
            'preco' => 49.90,
            'estoque' => 12,
            'sinopse' => 'Light Yagami é um estudante brilhante que descobre um misterioso caderno que mata qualquer pessoa cujo nome seja escrito nele. Light decide usar o caderno para livrar o mundo do mal.',
            'capa' => null,
        ]);

        // 4. Seed Sample Clientes
        Cliente::create([
            'nome' => 'Gabriel Barbosa',
            'email' => 'gabriel@gmail.com',
            'telefone' => '(21) 98765-4321',
            'cpf' => '123.456.789-00',
            'endereco' => 'Rua das Flores, 123 - Rio de Janeiro, RJ',
        ]);

        Cliente::create([
            'nome' => 'Ana Souza',
            'email' => 'ana.souza@outlook.com',
            'telefone' => '(11) 97777-6666',
            'cpf' => '987.654.321-11',
            'endereco' => 'Av. Paulista, 1000 - São Paulo, SP',
        ]);

        Cliente::create([
            'nome' => 'Lucas Lima',
            'email' => 'lucas.lima@gmail.com',
            'telefone' => '(31) 96543-2109',
            'cpf' => '456.789.123-22',
            'endereco' => 'Rua da Bahia, 45 - Belo Horizonte, MG',
        ]);
    }
}
