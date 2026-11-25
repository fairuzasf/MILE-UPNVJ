<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        
        $statuses = ['terdaftar', 'diverifikasi', 'diterima', 'ditolak'];

        // 20 mahasiswa pendukung
        $students = [];
        for ($i = 1; $i <= 20; $i++) {
            $students[$i] = User::updateOrCreate(
                ['email' => "mhs{$i}@test.com"],
                ['name' => "Mahasiswa {$i}", 'role' => 'mahasiswa', 'password' => Hash::make('password')]
            );
        }

        // 4 kegiatan pendukung (diperlukan karena registrations punya foreign key ke events)
        $events = [];
        foreach (['lentera', 'seminar_mpr', 'bimtek', 'seminar_nasional'] as $k => $type) {
            $events[$k] = Event::updateOrCreate(
                ['title' => 'Kegiatan '.ucfirst(str_replace('_', ' ', $type))],
                [
                    'type' => $type,
                    'starts_at' => now()->addDays(20 + $k),
                    'registration_deadline' => now()->addDays(10 + $k),
                    'quota' => 50,
                ]
            );
        }

        // 40 pendaftaran: tiap mahasiswa mendaftar ke 2 kegiatan berbeda
        foreach ($students as $i => $student) {
            foreach ([$i % 4, ($i + 1) % 4] as $j => $eventIndex) {
                $status = $statuses[($i + $j) % 4];

                Registration::updateOrCreate(
                    ['event_id' => $events[$eventIndex]->id, 'user_id' => $student->id],
                    [
                        'status' => $status,
                        'reject_reason' => $status === 'ditolak' ? 'Dokumen persyaratan tidak lengkap' : null,
                        'attended' => $status === 'diterima' && $i % 2 === 0,
                    ]
                );
            }
        }
    }
}