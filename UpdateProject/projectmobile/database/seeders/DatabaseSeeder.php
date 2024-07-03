<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $kelas = [
            '10 IPA I',
            '10 IPA II',
            '11 IPA I',
            '11 IPA II',
            '10 IPS I',
            '10 IPS II',
            '11 IPS I',
            '11 IPS II',
            '12 IPA I',
            '12 IPA II',
            '12 IPS I',
            '12 IPS II',
        ];

        // \App\Models\User::factory(10)->create();

        foreach ($kelas as $nama_kelas) {
            \App\Models\Kelas::factory()->create([
                'nama_kelas' => $nama_kelas,
            ]);
        }
    }
}
