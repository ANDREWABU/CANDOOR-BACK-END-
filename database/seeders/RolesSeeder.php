<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                'id'    => 1,
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 2,
                'name' => 'Advisor',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 3,
                'name' => 'Advisee',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],[
                'id'    => 4,
                'name' => 'Recruiter',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],

        ];
        Role::insert($roles);
        $role=Role::find(1);
        $role->givePermissionTo('Admin');

         $role=Role::find(2);
        $role->givePermissionTo('Advisor');

        $role=Role::find(3);
        $role->givePermissionTo('Advisee');

    }
}
