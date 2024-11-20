<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Daftar permissions
        $permissions = [
            'can-list',
            'can-create',
            'can-edit',
            'can-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        // Membuat permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Membuat user admin
        $user = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Administrator',
            'password' => bcrypt('qweqwe')
        ]);

        // Membuat role Admin
        $role = Role::firstOrCreate(['name' => 'Admin']);

        // Mendapatkan semua permissions
        $allPermissions = Permission::all();

        // Menyinkronkan permissions ke role
        $role->syncPermissions($allPermissions);

        // Menyinkronkan role ke user
        $user->assignRole($role);
    }
}
