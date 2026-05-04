<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => 'Super Admin',
            'lastname' => 'Admin',
            'email' => 'super@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user->syncRoles('Super Admin');
        
        $advisee = User::create([
            'firstname' => 'Advisee',
            'lastname' => 'Advisee',
            'email' => 'advisee@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $advisee->syncRoles('Advisor');
    }
}
