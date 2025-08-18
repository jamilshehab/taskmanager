<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     User::create([   
        'name'=>'Jamil Shehab',
        'email' => 'shehab@manager.com',
        'password' => bcrypt('password'),
        'role' => 'manager',
    ]);

     
    }
}
