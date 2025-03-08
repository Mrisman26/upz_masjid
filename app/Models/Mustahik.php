<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kriteria', 'rt_rw_id', 'lainnya', 'keterangan'];

    public function rtRw()
    {
        return $this->belongsTo(RtRw::class, 'rt_rw_id');
    }
}
