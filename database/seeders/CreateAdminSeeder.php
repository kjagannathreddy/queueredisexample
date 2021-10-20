<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => bcrypt('123456')
        ];
        User::updateOrCreate([
            'email' => 'admin@gmail.com'
        ],
            $admin
        );
    }
}
