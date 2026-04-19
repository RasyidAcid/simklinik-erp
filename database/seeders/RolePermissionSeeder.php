<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
public function run()
{
    $permissions = [
        'rekening',
        'pengajuan',
        'laporan',
        'user management'
    ];

    foreach ($permissions as $p) {
        Permission::firstOrCreate(['name' => $p]);
    }

    $admin = Role::firstOrCreate(['name' => 'admin']);
    $admin->givePermissionTo($permissions);

    $user = Role::firstOrCreate(['name' => 'user']);
    $user->givePermissionTo(['pengajuan']);
}
}
