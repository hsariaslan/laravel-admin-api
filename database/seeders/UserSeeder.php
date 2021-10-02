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
        User::create([
            'username'  => 'admin',
            'email'     => 'admin@sariaslan.com',
            'password'  =>  Hash::make('123456'),
            'name'      => 'Admino',
            'surname'   => 'Sariyaslani',
        ]);

        User::create([
            'username'  => 'editor',
            'email'     => 'editor@sariaslan.com',
            'password'  =>  Hash::make('123456'),
            'name'      => 'Editorio',
            'surname'   => 'Dormitory',
        ]);

        User::create([
            'username'  => 'member',
            'email'     => 'member@sariaslan.com',
            'password'  =>  Hash::make('123456'),
            'name'      => 'Mousa',
            'surname'   => 'Membere',
        ]);
    }
}
