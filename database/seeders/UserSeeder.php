<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user = User::where('email', "manirujjamanakash@gmail.com");
        if (is_null($user)) {
            $user = new User();
            $user->name = "Maniruzzaman Akash";
            $user->email = "manirujjamanakash@gmail.com";
            $user->password = Hash::make('123456');
            $user->save();
        }
    }
}
