<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;

    protected $fillable = ['lokasi_id', 'tanggal', 'total_hadir', 'total_unit_aktif', 'total_unit_idle'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function lokasi()
    {
        return $this->belongsTo(LokasiProyek::class);
    }
}
