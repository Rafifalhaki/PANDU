<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LokasiProyek;
use App\Models\UnitAlatBerat;
use App\Models\Absensi;
use App\Models\LaporanHarian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1 Admin
        User::create([
            'name' => 'Admin Pimpinan',
            'email' => 'admin@pupr-depok.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'pimpinan',
        ]);

        // 2 Mandor
        $mandor1 = User::create([
            'name' => 'Mandor Budi',
            'email' => 'budi@pupr.go.id',
            'password' => Hash::make('password123'),
            'role' => 'mandor',
        ]);

        $mandor2 = User::create([
            'name' => 'Mandor Joko',
            'email' => 'joko@pupr.go.id',
            'password' => Hash::make('password123'),
            'role' => 'mandor',
        ]);

        // 2 Locations
        $locCilodong = LokasiProyek::create([
            'nama' => 'Proyek Jalan Cilodong',
            'lat' => -6.3890,
            'lng' => 106.8350,
            'radius_meter' => 50,
        ]);

        $locSukamaju = LokasiProyek::create([
            'nama' => 'Proyek Irigasi Sukamaju',
            'lat' => -6.3820,
            'lng' => 106.8440,
            'radius_meter' => 50,
        ]);

        // 5 Units
        UnitAlatBerat::create(['nama_unit' => 'Excavator PC200-1', 'tipe' => 'Excavator', 'lokasi_id' => $locCilodong->id, 'status' => 'aktif', 'last_seen' => now()]);
        UnitAlatBerat::create(['nama_unit' => 'Bulldozer D65-1', 'tipe' => 'Bulldozer', 'lokasi_id' => $locCilodong->id, 'status' => 'idle', 'last_seen' => now()->subHours(4)]);
        UnitAlatBerat::create(['nama_unit' => 'Dump Truck Hino-1', 'tipe' => 'Dump Truck', 'lokasi_id' => $locCilodong->id, 'status' => 'aktif', 'last_seen' => now()]);
        
        UnitAlatBerat::create(['nama_unit' => 'Excavator PC200-2', 'tipe' => 'Excavator', 'lokasi_id' => $locSukamaju->id, 'status' => 'aktif', 'last_seen' => now()]);
        UnitAlatBerat::create(['nama_unit' => 'Motor Grader GD535', 'tipe' => 'Motor Grader', 'lokasi_id' => $locSukamaju->id, 'status' => 'offline', 'last_seen' => now()->subDays(2)]);

        // 7 days of attendance
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Mandor 1 at Cilodong
            Absensi::create([
                'user_id' => $mandor1->id,
                'lokasi_id' => $locCilodong->id,
                'waktu_masuk' => $date->copy()->setTime(7, rand(0, 30)),
                'waktu_pulang' => $date->copy()->setTime(17, rand(0, 30)),
                'koordinat_masuk' => '-6.3891,106.8351',
                'koordinat_pulang' => '-6.3892,106.8352',
            ]);

            // Mandor 2 at Sukamaju
            Absensi::create([
                'user_id' => $mandor2->id,
                'lokasi_id' => $locSukamaju->id,
                'waktu_masuk' => $date->copy()->setTime(7, rand(0, 30)),
                'waktu_pulang' => $date->copy()->setTime(17, rand(0, 30)),
                'koordinat_masuk' => '-6.3821,106.8441',
                'koordinat_pulang' => '-6.3822,106.8442',
            ]);

            // Laporan
            LaporanHarian::create([
                'lokasi_id' => $locCilodong->id,
                'tanggal' => $date->toDateString(),
                'total_hadir' => 1,
                'total_unit_aktif' => 2,
                'total_unit_idle' => 1,
            ]);

            LaporanHarian::create([
                'lokasi_id' => $locSukamaju->id,
                'tanggal' => $date->toDateString(),
                'total_hadir' => 1,
                'total_unit_aktif' => 1,
                'total_unit_idle' => 0,
            ]);
        }
    }
}
