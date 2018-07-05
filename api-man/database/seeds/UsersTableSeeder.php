<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'nume'           => 'Adminescu',
                'prenume'        => 'Admin',
                'email'          => 'admin@admin.com',
                'parola'         => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
                'active'         => 1
            ]);

            $role = Role::where('name', 'user')->firstOrFail();

            User::create([
                'nume'           => 'Userescu',
                'prenume'        => 'User',
                'email'          => 'user@user.com',
                'parola'         => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id'        => $role->id,
                'active'         => 1
            ]);
        }
    }
}
