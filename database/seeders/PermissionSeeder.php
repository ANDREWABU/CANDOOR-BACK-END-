<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 2,
                'name' => 'Advisor',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 3,
                'name' => 'Advisee',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],

        ];
        Permission::insert($permissions);
    }
}
