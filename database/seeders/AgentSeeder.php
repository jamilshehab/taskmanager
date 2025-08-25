<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'=>'Ali Ibrahim',
            'email'=>'ali@agent.com',
            'job'=>'Sr. Software Engineer',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);
        User::create([
            'name'=>'Abbas Kassem',
            'email'=>'abbas@agent.com',
            'job'=>'Social Media Manager',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);
         User::create([
            'name'=>'Mohammad Itani',
            'email'=>'itani@agent.com',
            'job'=>'Marketing Specialist',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);
           User::create([
            'name'=>'Hassan Itani',
            'email'=>'hassan@agent.com',
            'job'=>'Accountant',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);

    }
}
