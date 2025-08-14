<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserGroup;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat root user
        $root = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('12345'),
                'is_root'  => true,
                'active'   => true,
            ]
        );

        // Buat admin user
        $admin = User::updateOrCreate(
            ['username' => 'oprator'],
            [
                'name'     => 'Operator',
                'password' => Hash::make('12345'),
                'is_root'  => false,
                'active'   => true,
            ]
        );

        // Buat beberapa dummy user
        $users = User::factory()->count(5)->create();

        // Buat beberapa group
        $groups = UserGroup::factory()->count(3)->create();

        // // Assign root ke semua group
        // $root->groups()->sync($groups->pluck('id'));

        // // Assign admin ke group pertama
        // $admin->groups()->sync([$groups->first()->id]);

        // // Assign user random ke group random
        // foreach ($users as $user) {
        //     $user->groups()->sync(
        //         $groups->random(rand(1, $groups->count()))->pluck('id')->toArray()
        //     );
        // }
    }
}
