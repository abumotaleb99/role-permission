<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::where('email', 'abumotaleb1111@gmail.com')->first();
        
        if(is_null($admin)) {
            $admin = new Admin();
            $admin->username = "abumotaleb";
            $admin->name = "Abu Motaleb";
            $admin->email = "abumotaleb1111@gmail.com";
            $admin->password = Hash::make("12345678");
            $admin->save();
        }
    }
}
