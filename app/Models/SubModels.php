<?php

namespace App\Models;

use App\Models\SubModels;
use App\Models\JeniskegiatanModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubModels extends Model
{


    public function sub()
    {
        return $this->belongsTo(JeniskegiatanModels::class);
    }
    use HasFactory;
    protected $table = 'sub';
    protected $guarded = [];
}
