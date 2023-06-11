<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@boosterlab.id',
                'is_admin' => '1',
                'password' => bcrypt('12345'),
            ],
            [
                'name' => 'User',
                'email' => 'user@boosterlab.id',
                'is_admin' => '0',
                'password' => bcrypt('12345'),
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
