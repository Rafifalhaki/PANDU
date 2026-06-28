<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lokasi_id', 'waktu_masuk', 'waktu_pulang', 'koordinat_masuk', 'koordinat_pulang', 'is_offline', 'synced_at'];

    protected function casts(): array
    {
        return [
            'waktu_masuk' => 'datetime',
            'waktu_pulang' => 'datetime',
            'synced_at' => 'datetime',
            'is_offline' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(LokasiProyek::class);
    }
}
