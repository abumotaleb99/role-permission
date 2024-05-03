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
     */
    public function run(): void
    {
        $user = User::where('email', 'abumotaleb1111@gmail.com')->first();
        
        if(is_null($user)) {
            $user = new User();
            $user->name = "Abu Motaleb";
            $user->email = "abumotaleb1111@gmail.com";
            $user->password = Hash::make("12345678");
            $user->save();
        }
    }
}
