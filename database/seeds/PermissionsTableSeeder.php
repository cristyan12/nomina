<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users
        Permission::create([
        	'name' => 'Listar usuarios',
        	'slug' => 'users.index',
        	'description' => 'Lista todos los usuarios',
        ]);

        Permission::create([
        	'name' => 'Ver detalle del usuario',
        	'slug' => 'users.show',
        	'description' => 'Ver en detalle los datos de cada usuario',
        ]);

        Permission::create([
        	'name' => 'Edición de usuarios',
        	'slug' => 'users.edit',
        	'description' => 'Editar cualquier dato de los usuarios',
        ]);

        Permission::create([
        	'name' => 'Eliminar usuarios',
        	'slug' => 'users.destroy',
        	'description' => 'Elimina cualquier usuario del sistema',
        ]);

        // Roles
        Permission::create([
        	'name' => 'Listar roles',
        	'slug' => 'roles.index',
        	'description' => 'Lista todos los roles',
        ]);

        Permission::create([
        	'name' => 'Ver detalle del rol',
        	'slug' => 'roles.show',
        	'description' => 'Ver en detalle los datos de cada rol',
        ]);

        Permission::create([
        	'name' => 'Creación de roles',
        	'slug' => 'roles.create',
        	'description' => 'Podría crear nuevos roles en el sistema',
        ]);

        Permission::create([
        	'name' => 'Edición de roles',
        	'slug' => 'roles.edit',
        	'description' => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
        	'name' => 'Eliminar roles',
        	'slug' => 'roles.destroy',
        	'description' => 'Podría eliminar cualquier rol del sistema',
        ]);

        // Positions (Cargos)
        Permission::create([
        	'name' => 'Listar Cargos',
        	'slug' => 'positions.index',
        	'description' => 'Lista todos los Cargos',
        ]);

        Permission::create([
        	'name' => 'Ver detalle del rol',
        	'slug' => 'positions.show',
        	'description' => 'Ver en detalle los datos de cada rol',
        ]);

        Permission::create([
        	'name' => 'Creación de Cargos',
        	'slug' => 'positions.create',
        	'description' => 'Podría crear nuevos Cargos en el sistema',
        ]);

        Permission::create([
        	'name' => 'Edición de Cargos',
        	'slug' => 'positions.edit',
        	'description' => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        // Branches (Sucursales)
        Permission::create([
            'name' => 'Listar Sucursales',
            'slug' => 'branches.index',
            'description' => 'Lista todas los Sucursales',
        ]);

        Permission::create([
            'name' => 'Ver detalle del sucursal',
            'slug' => 'branches.show',
            'description' => 'Ver en detalle los datos de cada sucursal',
        ]);

        Permission::create([
            'name' => 'Creación de Sucursales',
            'slug' => 'branches.create',
            'description' => 'Podría crear nuevos Sucursales en el sistema',
        ]);

        Permission::create([
            'name' => 'Edición de Sucursales',
            'slug' => 'branches.edit',
            'description' => 'Podría editar cualquier dato de un sucursal del sistema',
        ]);

        // Departments (Departamentos)
        Permission::create([
            'name' => 'Listar Departamentos',
            'slug' => 'departments.index',
            'description' => 'Lista todas los Departamentos',
        ]);

        Permission::create([
            'name' => 'Ver detalle del departamento',
            'slug' => 'departments.show',
            'description' => 'Ver en detalle los datos de cada departamento',
        ]);

        Permission::create([
            'name' => 'Creación de Departamentos',
            'slug' => 'departments.create',
            'description' => 'Podría crear nuevos Departamentos en el sistema',
        ]);

        Permission::create([
            'name' => 'Edición de Departamentos',
            'slug' => 'departments.edit',
            'description' => 'Podría editar cualquier dato de un departamento del sistema',
        ]);

        // Units (Unidades)
        Permission::create([
            'name' => 'Listar Unidades',
            'slug' => 'units.index',
            'description' => 'Lista todas los Unidades',
        ]);

        Permission::create([
            'name' => 'Ver detalle de la Unidad',
            'slug' => 'units.show',
            'description' => 'Ver en detalle los datos de cada Unidad',
        ]);

        Permission::create([
            'name' => 'Creación de Unidades',
            'slug' => 'units.create',
            'description' => 'Podría crear nuevos Unidades',
        ]);

        Permission::create([
            'name' => 'Edición de Unidades',
            'slug' => 'units.edit',
            'description' => 'Podría editar cualquier dato de un Unidad',
        ]);

        // Professions (Profesiones)
        Permission::create([
            'name' => 'Listar Profesiones',
            'slug' => 'professions.index',
            'description' => 'Lista todas los Profesiones',
        ]);

        Permission::create([
            'name' => 'Ver detalle de la Profeción',
            'slug' => 'professions.show',
            'description' => 'Ver en detalle los datos de cada Profeción',
        ]);

        Permission::create([
            'name' => 'Creación de Profesiones',
            'slug' => 'professions.create',
            'description' => 'Podría crear nuevos Profesiones',
        ]);

        Permission::create([
            'name' => 'Edición de Profesiones',
            'slug' => 'professions.edit',
            'description' => 'Podría editar cualquier dato de un Profeción',
        ]);

        // Employees (Empleados)
        Permission::create([
            'name' => 'Listar Empleados',
            'slug' => 'employees.index',
            'description' => 'Lista todas los Empleados',
        ]);

        Permission::create([
            'name' => 'Ver detalle del Empleado',
            'slug' => 'employees.show',
            'description' => 'Ver en detalle los datos de cada Empleado',
        ]);

        Permission::create([
            'name' => 'Creación de Empleados',
            'slug' => 'employees.create',
            'description' => 'Podría crear nuevos Empleados',
        ]);

        Permission::create([
            'name' => 'Edición de Empleados',
            'slug' => 'employees.edit',
            'description' => 'Podría editar cualquier dato de un Empleado',
        ]);

        Permission::create([
            'name' => 'Eliminación de Empleados',
            'slug' => 'employees.destroy',
            'description' => 'Podría eliminar cualquier Empleado',
        ]);
    }
}