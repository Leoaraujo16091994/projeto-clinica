<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersIfNotExists extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

            // Insere os usuários fixos
            DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'salaA',
                    'email' => 'salaA@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 2,
                    'name' => 'salaB',
                    'email' => 'salaB@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 3,
                    'name' => 'salaC',
                    'email' => 'salaC@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 4,
                    'name' => 'salaD',
                    'email' => 'salaD@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 5,
                    'name' => 'salaE',
                    'email' => 'salaE@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 6,
                    'name' => 'recepcao',
                    'email' => 'recepcao@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 7,
                    'name' => 'salaF',
                    'email' => 'salaF@prontorim.com',
                    'password' => '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

    public function down()
    {
        // Sem exclusão de tabela no down
    }
}
