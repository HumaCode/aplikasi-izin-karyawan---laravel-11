<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserKaryawanDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $it = Divisi::create([
            'nama'      => 'it',
            'active'    => 1,
        ]);

        $finance = Divisi::create([
            'nama'      => 'finance',
            'active'    => 1,
        ]);

        $hrd = Divisi::create([
            'nama'      => 'hrd',
            'active'    => 1,
        ]);

        $staff_it = User::factory()->create([
            'nama'  => 'Staff IT',
            'email' => 'staff_it@example.com',
        ]);

        $supervisor_it = User::factory()->create([
            'nama'  => 'Supervisor IT',
            'email' => 'supervisor_it@example.com',
        ]);

        $manager_it = User::factory()->create([
            'nama'  => 'Manager IT',
            'email' => 'manager_it@example.com',
        ]);

        $staff_it->atasan()->attach([
            $supervisor_it->id      => ['level' => 1],
            $manager_it->id         => ['level' => 2],
        ]);

        $supervisor_it->karyawan()->create([
            'nama'              => $supervisor_it->nama,
            'divisi_id'         => $it->id,
            'nama_divisi'       => $it->nama,
            'status_karyawan'   => 'tetap',
            'tanggal_masuk'     => now(),
            'jenis_kelamin'     => 'L',
        ]);

        $manager_it->karyawan()->create([
            'nama'              => $manager_it->nama,
            'divisi_id'         => $it->id,
            'nama_divisi'       => $it->nama,
            'status_karyawan'   => 'tetap',
            'tanggal_masuk'     => now(),
            'jenis_kelamin'     => 'L',
        ]);

        $staff_it->karyawan()->create([
            'nama'              => $staff_it->nama,
            'divisi_id'         => $it->id,
            'nama_divisi'       => $it->nama,
            'status_karyawan'   => 'tetap',
            'tanggal_masuk'     => now(),
            'jenis_kelamin'     => 'L',
        ]);
    }
}
