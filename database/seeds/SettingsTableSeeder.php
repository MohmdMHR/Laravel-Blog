<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Setting::create([
            'site_name'=>'Laravel\'s blog',
            'address' => 'Morocco, Africa',
            'contact_number' => '00 000 000',
            'contact_email' => 'med@laravel.blog'
        ]);

    }
}
