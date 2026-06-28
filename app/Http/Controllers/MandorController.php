<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\LokasiProyek;
use Carbon\Carbon;

class MandorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        $lokasi = LokasiProyek::first(); 
        
        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('waktu_masuk', $today)
            ->first();

        $history = Absensi::where('user_id', $user->id)
            ->with('lokasi')
            ->orderBy('waktu_masuk', 'desc')
            ->take(7)
            ->get();

        return view('mandor.dashboard', compact('absensiHariIni', 'lokasi', 'history'));
    }

    public function profil()
    {
        $user = Auth::user();
        $totalHadir = Absensi::where('user_id', $user->id)->count();
        return view('mandor.profil', compact('user', 'totalHadir'));
    }

    public function absenMasuk(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'lokasi_id' => 'required|exists:lokasi_proyeks,id'
        ]);

        $lokasi = LokasiProyek::find($request->lokasi_id);
        
        $distance = $this->haversineGreatCircleDistance($request->lat, $request->lng, $lokasi->lat, $lokasi->lng);
        
        if ($distance > $lokasi->radius_meter) {
            return back()->with('error', 'Anda di luar radius proyek ('.round($distance).'m). Harus dalam '.$lokasi->radius_meter.'m.');
        }

        Absensi::create([
            'user_id' => Auth::id(),
            'lokasi_id' => $lokasi->id,
            'waktu_masuk' => now(),
            'koordinat_masuk' => $request->lat . ',' . $request->lng,
        ]);

        return back()->with('success', 'Berhasil absen masuk.');
    }

    public function absenPulang(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'absensi_id' => 'required|exists:absensis,id'
        ]);

        $absensi = Absensi::where('id', $request->absensi_id)->where('user_id', Auth::id())->firstOrFail();
        
        $absensi->update([
            'waktu_pulang' => now(),
            'koordinat_pulang' => $request->lat . ',' . $request->lng,
        ]);

        return back()->with('success', 'Berhasil absen pulang.');
    }

    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        
        return $angle * $earthRadius;
    }
}
