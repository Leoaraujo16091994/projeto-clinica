
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersIfNotExists extends Migration
{
    public function up()
    {
        $password = '$2a$12$/UZvVOYsULXLtOXBhpKISu3Rnr3X09VroTRB/sxZ/Wfl8OTBoUZNy';

        $users = [
            ['id' => 1, 'name' => 'salaA', 'email' => 'salaA@prontorim.com'],
            ['id' => 2, 'name' => 'salaB', 'email' => 'salaB@prontorim.com'],
            ['id' => 3, 'name' => 'salaC', 'email' => 'salaC@prontorim.com'],
            ['id' => 4, 'name' => 'salaD', 'email' => 'salaD@prontorim.com'],
            ['id' => 5, 'name' => 'salaE', 'email' => 'salaE@prontorim.com'],
            ['id' => 6, 'name' => 'recepcao', 'email' => 'recepcao@prontorim.com'],
            ['id' => 7, 'name' => 'salaF', 'email' => 'salaF@prontorim.com'],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'password' => $password,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down()
    {
        // Não excluir usuários.
    }
}
