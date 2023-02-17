<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Traits\PermissionTrait;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    use PermissionTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seeding 10 users with 10 more order every user
         */
        User::factory()
        ->count(10)
        ->has(Order::factory()->count(10))
        ->create();

        /**
         * create "Super Admin" role
         */
        $role = Role::create([
            "name" => "Super Admin",
            "guard_name" => "admin",
        ]);

        /**
         * create permission and set permission to "Super Admin" role
         */
        $permissions = $this->permission_list();
        foreach($permissions as $permission) {
            $per_array = ['index', 'create', 'update', 'destory'];
            foreach($per_array as $per) {
                $create_permisison = Permission::firstOrCreate([
                    'name' => $permission."-".$per,
                    'guard_name' => 'admin',
                ]);
                $role->givePermissionTo($create_permisison);
            }
        }

        /**
         * create a super admin user
         */
        $admin = Admin::create([
            'name' => "Admin",
            "email" => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole($role->name); // assign role

        /**
         * seeding 10 more user
         */
        Admin::factory(10)->create();

        Category::factory(10)->create();
        Blog::factory(50)->hascategories(2)->create();

    }
}
