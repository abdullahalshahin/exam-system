<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = User::create([
            'user_type'     => "ADMIN",
            'name'          => "Administrator",
            'mobile_number' => "01XXXXXXXXX",
            'email'         => "admin@gmail.com",
            'password'      => bcrypt('123456'),
            'security'      => 123456,
            'gender'        => "Male",
        ]);
    }
}
