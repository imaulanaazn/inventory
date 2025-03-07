<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }

    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Yanul',
                'username' => 'manager',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
            ],
        ]);

        DB::table('bahan_baku')->insert([
            [
                'id' => 'KD001',
                'nama' => 'Pureng Beat',
                'jenis' => 'Pureng',
                'minimal' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'KD002',
                'nama' => 'Plendes Beat',
                'jenis' => 'Plendes',
                'minimal' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
