<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'nama_lengkap' => 'Mutiah Zahra Lubis',
            'email' => 'mutiah123@gmail.com',
            'password' => bcrypt('123'),
            // role sebagai admin
            'role' => '1',
            'divisi' => 'Sumber Daya Manusia',
            'alamat' => 'Jl. Kenangan No.11, Johor',
            'no_hp' => '087654345212'
        ]);
        User::create([
            'nama_lengkap' => 'Darma Firmansyah',
            'email' => 'darma123@gmail.com',
            'password' => bcrypt('123'),
            // role sebagai user
            'role' => '2',
            'divisi' => 'Pengadaan',
            'alamat' => 'Jl. Kolam No.21, Percut Sei Tuan',
            'no_hp' => '081232415623'
        ]);


        Division::create([
            'kode_divisi' => 'KD1',
            'nama_divisi' => 'Sumber Daya Manusia'
        ]);
        Division::create([
            'kode_divisi' => 'KD2',
            'nama_divisi' => 'Pengadaan'
        ]);
    }
}
