<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnitAlatBerat;
use App\Models\Absensi;
use App\Models\LokasiProyek;
use App\Models\LaporanHarian;
use Carbon\Carbon;

class PimpinanController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $totalHadir = Absensi::whereDate('waktu_masuk', $today)->distinct('user_id')->count();
        $totalUnitAktif = UnitAlatBerat::where('status', 'aktif')->count();
        $idleUnits = UnitAlatBerat::where('status', 'idle')->get();
        
        $idleCount = 0;
        $idleAlerts = [];
        foreach ($idleUnits as $unit) {
            if ($unit->last_seen && $unit->last_seen->diffInHours(now()) >= 3) {
                $idleCount++;
                $idleAlerts[] = $unit;
            }
        }
        
        $totalLokasi = LokasiProyek::count();

        $chartData = [
            'labels' => LokasiProyek::pluck('nama')->toArray(),
            'actual' => [],
            'planned' => array_fill(0, LokasiProyek::count(), 5)
        ];
        
        foreach (LokasiProyek::all() as $lokasi) {
            $chartData['actual'][] = Absensi::where('lokasi_id', $lokasi->id)->whereDate('waktu_masuk', $today)->distinct('user_id')->count();
        }

        $recentAbsensi = Absensi::with(['user', 'lokasi'])->orderBy('waktu_masuk', 'desc')->take(5)->get();

        return view('pimpinan.dashboard', compact('totalHadir', 'totalUnitAktif', 'idleCount', 'idleAlerts', 'totalLokasi', 'chartData', 'recentAbsensi'));
    }

    public function tracking()
    {
        $units = UnitAlatBerat::with('lokasi')->get();
        return view('pimpinan.tracking', compact('units'));
    }

    public function absensi(Request $request)
    {
        $query = Absensi::with(['user', 'lokasi']);
        if ($request->lokasi_id) {
            $query->where('lokasi_id', $request->lokasi_id);
        }
        $absensis = $query->orderBy('waktu_masuk', 'desc')->get();
        $lokasis = LokasiProyek::all();
        return view('pimpinan.absensi', compact('absensis', 'lokasis'));
    }

    public function laporan()
    {
        $laporans = LaporanHarian::with('lokasi')->orderBy('tanggal', 'desc')->get();
        return view('pimpinan.laporan', compact('laporans'));
    }

    public function pengaturan()
    {
        $users = User::all();
        $lokasis = LokasiProyek::all();
        return view('pimpinan.pengaturan', compact('users', 'lokasis'));
    }
}
