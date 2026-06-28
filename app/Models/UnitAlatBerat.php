<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitAlatBerat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_unit', 'tipe', 'lokasi_id', 'status', 'last_seen'];

    protected function casts(): array
    {
        return [
            'last_seen' => 'datetime',
        ];
    }

    public function lokasi()
    {
        return $this->belongsTo(LokasiProyek::class);
    }
}
