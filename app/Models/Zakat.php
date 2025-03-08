<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;
    protected $fillable = ['kepala_keluarga_id', 'zakat_fitrah_beras', 'zakat_fitrah_uang', 'zakat_mal', 'zakat_penghasilan', 'infaq'];

    public function kepalaKeluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class, 'kepala_keluarga_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
