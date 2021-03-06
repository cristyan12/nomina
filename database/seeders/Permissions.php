<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {}
    // {
    //     // Users
    //     Permission::create([
    //     	'name' => 'Listar usuarios',
    //     	'slug' => 'users.index',
    //     	'description' => 'Lista todos los usuarios',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de usuarios',
    //         'slug' => 'users.create',
    //         'description' => 'Crea un nuevo usuario',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Ver detalle del usuario',
    //     	'slug' => 'users.show',
    //     	'description' => 'Ver en detalle los datos de cada usuario',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Edición de usuarios',
    //     	'slug' => 'users.edit',
    //     	'description' => 'Editar cualquier dato de los usuarios',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Eliminar usuarios',
    //     	'slug' => 'users.destroy',
    //     	'description' => 'Elimina cualquier usuario del sistema',
    //     ]);

    //     // Nominas
    //     Permission::create([
    //         'name' => 'Listar tipos de nominas',
    //         'slug' => 'nomina.index',
    //         'description' => 'Lista todas los tipos nominas',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle del tipo de nomina',
    //         'slug' => 'nomina.show',
    //         'description' => 'Ver en detalle los datos de cada tupo de nomina',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de tipos de nominas',
    //         'slug' => 'nomina.create',
    //         'description' => 'Podría crear nuevos tipos de nominas',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de tipos de nominas',
    //         'slug' => 'nomina.edit',
    //         'description' => 'Podría editar cualquier dato de un tipo de nomina',
    //     ]);

    //     // Roles
    //     Permission::create([
    //     	'name' => 'Listar roles',
    //     	'slug' => 'roles.index',
    //     	'description' => 'Lista todos los roles',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Ver detalle del rol',
    //     	'slug' => 'roles.show',
    //     	'description' => 'Ver en detalle los datos de cada rol',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Creación de roles',
    //     	'slug' => 'roles.create',
    //     	'description' => 'Podría crear nuevos roles en el sistema',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Edición de roles',
    //     	'slug' => 'roles.edit',
    //     	'description' => 'Podría editar cualquier dato de un rol del sistema',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Eliminar roles',
    //     	'slug' => 'roles.destroy',
    //     	'description' => 'Podría eliminar cualquier rol del sistema',
    //     ]);

    //     // Positions (Cargos)
    //     Permission::create([
    //     	'name' => 'Listar Cargos',
    //     	'slug' => 'positions.index',
    //     	'description' => 'Lista todos los Cargos',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Ver detalle del cargo',
    //     	'slug' => 'positions.show',
    //     	'description' => 'Ver en detalle los datos de cada cargo',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Creación de Cargos',
    //     	'slug' => 'positions.create',
    //     	'description' => 'Podría crear nuevos Cargos en el sistema',
    //     ]);

    //     Permission::create([
    //     	'name' => 'Edición de Cargos',
    //     	'slug' => 'positions.edit',
    //     	'description' => 'Podría editar cualquier dato de un rol del sistema',
    //     ]);

    //     // Branches (Sucursales)
    //     Permission::create([
    //         'name' => 'Listar Sucursales',
    //         'slug' => 'branches.index',
    //         'description' => 'Lista todas los Sucursales',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle del sucursal',
    //         'slug' => 'branches.show',
    //         'description' => 'Ver en detalle los datos de cada sucursal',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de Sucursales',
    //         'slug' => 'branches.create',
    //         'description' => 'Podría crear nuevos Sucursales en el sistema',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de Sucursales',
    //         'slug' => 'branches.edit',
    //         'description' => 'Podría editar cualquier dato de un sucursal del sistema',
    //     ]);

    //     // Departments (Departamentos)
    //     Permission::create([
    //         'name' => 'Listar Departamentos',
    //         'slug' => 'departments.index',
    //         'description' => 'Lista todas los Departamentos',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle del departamento',
    //         'slug' => 'departments.show',
    //         'description' => 'Ver en detalle los datos de cada departamento',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de Departamentos',
    //         'slug' => 'departments.create',
    //         'description' => 'Podría crear nuevos Departamentos en el sistema',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de Departamentos',
    //         'slug' => 'departments.edit',
    //         'description' => 'Podría editar cualquier dato de un departamento del sistema',
    //     ]);

    //     // Units (Unidades)
    //     Permission::create([
    //         'name' => 'Listar Unidades',
    //         'slug' => 'units.index',
    //         'description' => 'Lista todas los Unidades',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle de la Unidad',
    //         'slug' => 'units.show',
    //         'description' => 'Ver en detalle los datos de cada Unidad',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de Unidades',
    //         'slug' => 'units.create',
    //         'description' => 'Podría crear nuevos Unidades',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de Unidades',
    //         'slug' => 'units.edit',
    //         'description' => 'Podría editar cualquier dato de un Unidad',
    //     ]);

    //     // Professions (Profesiones)
    //     Permission::create([
    //         'name' => 'Listar Profesiones',
    //         'slug' => 'professions.index',
    //         'description' => 'Lista todas los Profesiones',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle de la Profeción',
    //         'slug' => 'professions.show',
    //         'description' => 'Ver en detalle los datos de cada Profeción',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de Profesiones',
    //         'slug' => 'professions.create',
    //         'description' => 'Podría crear nuevos Profesiones',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de Profesiones',
    //         'slug' => 'professions.edit',
    //         'description' => 'Podría editar cualquier dato de un Profeción',
    //     ]);

    //     // Employees (Empleados)
    //     Permission::create([
    //         'name' => 'Listar Empleados',
    //         'slug' => 'employees.index',
    //         'description' => 'Lista todas los Empleados',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle del Empleado',
    //         'slug' => 'employees.show',
    //         'description' => 'Ver en detalle los datos de cada Empleado',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de Empleados',
    //         'slug' => 'employees.create',
    //         'description' => 'Podría crear nuevos Empleados',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de Empleados',
    //         'slug' => 'employees.edit',
    //         'description' => 'Podría editar cualquier dato de un Empleado',
    //     ]);

    //     Permission::create([
    //         'name' => 'Eliminación de Empleados',
    //         'slug' => 'employees.destroy',
    //         'description' => 'Podría eliminar cualquier Empleado',
    //     ]);

    //     // Bank Accounts
    //     Permission::create([
    //         'name' => 'Listar las cuentas bancarias de la empresa',
    //         'slug' => 'accounts.index',
    //         'description' => 'Lista todas las cuentas bancarias de la empresa',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle de la cuenta bancaria',
    //         'slug' => 'accounts.show',
    //         'description' => 'Ver en detalle los datos de cada cuenta bancaria',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de las cuentas bancarias de la empresa',
    //         'slug' => 'accounts.create',
    //         'description' => 'Podría crear nuevos las cuentas bancarias de la empresa',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de las cuentas bancarias de la empresa',
    //         'slug' => 'accounts.edit',
    //         'description' => 'Podría editar cualquier dato de una cuenta bancaria',
    //     ]);

    //     // Companies
    //     Permission::create([
    //         'name' => 'Lista la empresa',
    //         'slug' => 'companies.index',
    //         'description' => 'Lista las empresas asociadas',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle de la empresa',
    //         'slug' => 'companies.show',
    //         'description' => 'Ver en detalle los datos de la empresa',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de empresas',
    //         'slug' => 'companies.create',
    //         'description' => 'Podría crear nuevos registros de las empresas',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de la empresa',
    //         'slug' => 'companies.edit',
    //         'description' => 'Podría editar algunos datos de la empresa',
    //     ]);

    //     // Some Specials
    //     Permission::create([
    //         'name' => 'Seguridad',
    //         'slug' => 'security',
    //         'description' => 'Modulo de seguridad',
    //     ]);

    //     // Concepts
    //     Permission::create([
    //         'name' => 'Listar los conceptos salariales',
    //         'slug' => 'concepts.index',
    //         'description' => 'Lista todas los conceptos salariales',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle del concepto',
    //         'slug' => 'concepts.show',
    //         'description' => 'Ver en detalle los datos de cada concepto',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de conceptos',
    //         'slug' => 'concepts.create',
    //         'description' => 'Podría crear nuevos de conceptos',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de conceptos laborales',
    //         'slug' => 'concepts.edit',
    //         'description' => 'Podría editar cualquier dato de un concept',
    //     ]);

    //     // Permission
    //     Permission::create([
    //         'name' => 'Listar permisos',
    //         'slug' => 'permissions.index',
    //         'description' => 'Lista todas los permisos del sistema',
    //     ]);

    //     Permission::create([
    //         'name' => 'Ver detalle del permiso',
    //         'slug' => 'permissions.show',
    //         'description' => 'Ver en detalle los datos de cada permiso',
    //     ]);

    //     Permission::create([
    //         'name' => 'Creación de permisos',
    //         'slug' => 'permissions.create',
    //         'description' => 'Podría crear nuevos permisos',
    //     ]);

    //     Permission::create([
    //         'name' => 'Edición de permisos',
    //         'slug' => 'permissions.edit',
    //         'description' => 'Podría editar cualquier dato de un permiso',
    //     ]);
    // }
}