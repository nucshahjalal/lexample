<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
//use App\Models\Role;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $permissions = [

           'role-list',

           'role-create',

           'role-edit',

           'role-delete',
           
           'user-list',

           'user-create',

           'user-edit',

           'user-delete',

           'product-list',

           'product-create',

           'product-edit',

           'product-delete'

        ];

        

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        
         // Roles
//        $admin = Role::firstOrCreate(['name' => 'Admin']);
//        $admin->givePermissionTo(Permission::all());
//
//        $user = Role::firstOrCreate(['name' => 'Manager']);
//        $user->givePermissionTo(['user-list']);
    }
}
