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
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);
        User::create([
            'name'=>'Abbas Kassem',
            'email'=>'abbas@agent.com',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);
         User::create([
            'name'=>'Mohammad Itani',
            'email'=>'itani@agent.com',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);
           User::create([
            'name'=>'Hassan Itani',
            'email'=>'hassan@agent.com',
            'password'=>bcrypt('password'),
            'role'=>'agent'
        ]);

    }
}
