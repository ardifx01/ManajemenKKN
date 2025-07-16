<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    protected $guarded = ['id'];

    public function proker()
    {
        return $this->belongsTo(Proker::class, 'proker_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pemimpin_rapat()
    {
        return $this->belongsTo(User::class, 'pemimpin_rapat_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function notulensi()
    {
        return $this->hasOne(Notulensi::class);
    }
    public function berita_acara()
    {
        return $this->hasOne(BeritaAcara::class);
    }
}
