<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678')
        ]);

        $user->attachRole('admin');

        $user->adminProfile()->create([
            'name' => 'Administrator'
        ]);
    }
}
