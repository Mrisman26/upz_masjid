<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtRw extends Model
{
    use HasFactory;
    protected $fillable = ['rw', 'rt'];

    public function kepalaKeluargas()
    {
        return $this->hasMany(KepalaKeluarga::class, 'rt_rw_id');
    }

    public function mustahiks()
    {
        return $this->hasMany(Mustahik::class, 'rt_rw_id');
    }
}
