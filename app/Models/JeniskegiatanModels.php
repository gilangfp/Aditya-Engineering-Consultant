<?php

namespace App\Models;
use App\Models\JeniskegiatanModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JeniskegiatanModels extends Model
{

    
    use HasFactory;
    protected $table = 'jenis_kegiatan';
    protected $guarded = [];
    //protected $primaryKey = 'id';

}
