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
        $role3 = Role::create(['name' => 'Contador(a)']);
        $role4 = Role::create(['name' => 'Jefe(a) de Departamento']);
        $role5 = Role::create(['name' => 'Almacenista']);

        Permission::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de categorías', 'area' => 'Categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear categoría', 'area' => 'Categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar categoría', 'area' => 'Categorías'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar categoría', 'area' => 'Categorías'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de artículos', 'area' => 'Artículos'])->syncRoles([$role1, $role2, $role3, $role5]);
        Permission::create(['name' => 'Lista de artículos de catastro', 'area' => 'Artículos'])->syncRoles([$role1, $role2, $role3, $role5]);
        Permission::create(['name' => 'Lista de artículos de rpp', 'area' => 'Artículos'])->syncRoles([$role1, $role2, $role3, $role5]);
        Permission::create(['name' => 'Crear artículo', 'area' => 'Artículos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Editar artículo', 'area' => 'Artículos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Borrar artículo', 'area' => 'Artículos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de solicitudes', 'area' => 'Solicitudes'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'Crear solicitud', 'area' => 'Solicitudes'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'Editar solicitud', 'area' => 'Solicitudes'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'Borrar solicitud', 'area' => 'Solicitudes'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'Aceptar solicitud', 'area' => 'Solicitudes'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'Seguimiento', 'area' => 'Seguimiento'])->syncRoles([$role1, $role2, $role3, $role5]);

        Permission::create(['name' => 'Lista de entradas', 'area' => 'Entradas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Crear entrada', 'area' => 'Entradas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Editar entrada', 'area' => 'Entradas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar entrada', 'area' => 'Entradas'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'Reportes', 'area' => 'Reportes'])->syncRoles([$role1, $role2, $role3]);

    }
}
