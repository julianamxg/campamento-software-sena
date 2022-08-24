<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crear un usuario 
        $u=new User();
        $u->name = "Cristian";
        $u->email = "cbo@misena.edu.co";
        $u->password = Hash::make("123456");
        $u->save();

    }
}
