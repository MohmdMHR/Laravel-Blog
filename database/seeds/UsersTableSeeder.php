<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=App\User::create([
            'name'=>'Med Med',
            'email'=>'med@med.med',
            'password'=>bcrypt('password'),
            'admin'=>1
        ]);

        App\Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/1.png',
            'about'=>'Enthusiastically promote client-centered initiatives before functionalized channels.',
            'facebook' => 'fb.com',
            'youtube'=>'youtu.be'
        ]);

    }
}
