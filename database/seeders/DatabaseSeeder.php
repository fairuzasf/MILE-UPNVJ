<?php

namespace Database\Seeders;

use App\Models\Deadline;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@test.com'], [
            'name' => 'Admin MKWK', 'role' => 'admin', 'password' => Hash::make('password'),
        ]);
        User::updateOrCreate(['email' => 'dosen@test.com'], [
            'name' => 'Dosen Uji', 'role' => 'dosen', 'password' => Hash::make('password'),
        ]);
        User::updateOrCreate(['email' => 'mhs@test.com'], [
            'name' => 'Mahasiswa Uji', 'role' => 'mahasiswa', 'password' => Hash::make('password'),
        ]);

        Deadline::updateOrCreate(
            ['title' => 'Pengumpulan Proposal PJBL'],
            ['type' => 'proposal', 'due_at' => now()->addDays(10)]
        );

        $this->call([
            RegistrationSeeder::class,
        ]);
            // anggota lain menambahkan seeder fiturnya sendiri di sini
    }
}