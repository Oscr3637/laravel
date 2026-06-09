<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{

/**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Editor']);
        Permission::create(['name' => 'editor.post.index']);
        Permission::create(['name' => 'editor.post.create']);
        Permission::create(['name' => 'editor.post.update']);
        Permission::create(['name' => 'editor.post.destroy']);
        Permission::create(['name' => 'editor.category.index']);
        Permission::create(['name' => 'editor.category.create']);
        Permission::create(['name' => 'editor.category.update']);
        Permission::create(['name' => 'editor.category.destroy']);*/
        //
        //$user = User::find(11);
        //$user->assignRole('Admin'); // asignar un rol, en terminal php artisan db:seed --class=RoleSeeder
        //$user->removeRole('admin'); // remover un rol, en terminal php artisan db:seed --class=RoleSeeder
        //$user->syncRoles(['Admin', 'Editor']); // sincronizar dos roles, en terminal php artisan db:seed --class=RoleSeeder
        //$user->syncRoles(['Admin']); // asignar un rol y elminar otro, en terminal php artisan db:seed --class=RoleSeeder
//
        //Permission::find(1)->assignRole(Role::find(1));
        //Permission::find(2)->assignRole(Role::find(1));
        //Permission::find(3)->assignRole(Role::find(1));
    //
        User::find(11)->givePermissionTo(Permission::find(1));

    }
}

