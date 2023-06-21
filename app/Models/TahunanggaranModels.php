<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunanggaranModels extends Model

{
    public function tahunanggaran()
    {
        return $this->belongsTo(ProyekModels::class);
    }
    use HasFactory;
    protected $table = 'tahun_anggaran';
    protected $guarded = [];
}
