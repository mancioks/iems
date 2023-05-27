<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            'email' => env('ADMIN_EMAIL'),
            'name' => 'Admin',
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'role' => 'admin',
        ];

        $admin = User::query()->where('email', $data['email'])->first();

        if (!$admin) {
            User::query()->create($data);
            $this->command->info('Admin user created');
        } else {
            $admin->update($data);
            $this->command->info('Admin user updated');
        }
    }
}
