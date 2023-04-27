<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \DB::connection('old_mysql')->table('users')->get();
        foreach($users as $user){
            User::create([
                'id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'password'=>$user->password,
                'is_admin'=>$user->is_admin,
                'created_at'=>$user->created_at,
                'updated_at'=>$user->updated_at
            ]);
        }
    }
}
