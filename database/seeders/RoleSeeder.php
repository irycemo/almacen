<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Delegado(a) Administrativo']);
        $role2 = Role::create(['name' => 'Contador(a)']);
        $role3 = Role::create(['name' => 'Jefe(a) de Departamento']);
        $role4 = Role::create(['name' => 'Almacenista']);

        Permission::create(['name' => 'user.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'user.delete'])->syncRoles([$role1, $role2]);
    }
}
