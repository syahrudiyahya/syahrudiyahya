<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Distributor;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::create([
        //     'name' => 'users1',
        //     'email' => 'user1@gmail.com',
        //     'password' => bcrypt('123456789'),
        //     'point' => '10000',
        // ]);

        
        //Admin::create([
        //    'name' => 'admins',
        //   'username' => 'Admin',
        //   'email' => 'Admin@gmail.com',
        //  'password' => bcrypt('123456789'),
        
        //]);

        // Distributor::create([
        //     'nama_distributor' => 'distributors',
        //     'lokasi' => 'jawa',
        //     'kontak' => '26127128',
        //     'email' => 'distributor@gmail.com',
        
        // ]);
    }
}
