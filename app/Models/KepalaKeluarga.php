<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaKeluarga extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'rt_rw_id', 'jumlah_muzaki', 'jumlah_tanggungan'];

    public function rtRw()
    {
        return $this->belongsTo(RtRw::class, 'rt_rw_id');
    }

    public function zakats()
    {
        return $this->hasMany(Zakat::class, 'kepala_keluarga_id');
    }
}
