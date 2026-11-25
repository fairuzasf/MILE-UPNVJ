<?php

namespace Database\Seeders;

use App\Models\Deadline;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(['name' => 'Admin MKWK', 'email' => 'admin@test.com', 'role' => 'admin']);
        User::factory()->create(['name' => 'Dosen Uji', 'email' => 'dosen@test.com', 'role' => 'dosen']);
        User::factory()->create(['name' => 'Mahasiswa Uji', 'email' => 'mhs@test.com', 'role' => 'mahasiswa']);

        Event::create([
            'title' => 'Seminar MPR (contoh)',
            'type' => 'seminar_mpr',
            'starts_at' => now()->addDays(14),
            'registration_deadline' => now()->addDays(7),
            'quota' => 50,
        ]);

        Event::create([
            'title' => 'Bimbingan Teknis (contoh)',
            'type' => 'bimtek',
            'starts_at' => now()->addDays(21),
            'registration_deadline' => now()->addDays(10),
            'quota' => 30,
        ]);

        Deadline::create([
            'title' => 'Pengumpulan Proposal PJBL',
            'type' => 'proposal',
            'due_at' => now()->addDays(10),
        ]);
    }
}