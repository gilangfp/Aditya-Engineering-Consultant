<?php

namespace App\Models;

use App\Models\ProyekModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanKegiatanModels extends Model
{
    use HasFactory;
    protected $table = 'laporan_kegiatan';
    protected $guarded = [];
    public function proyek()
    {
        return $this->belongsTo(ProyekModels::class, 'id_proyek', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_karyawan', 'id');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JeniskegiatanModels::class, 'id_jenis', 'id_jenis');
    }

    public function departemen()
    {
        return $this->belongsTo(DepartemenModels::class, 'id', 'id');
    }

    public function sub()
    {
        return $this->belongsTo(SubModels::class, 'id_sub', 'id_sub');
    }

    public function approve(){
        return $this->belongsTo(ApproveModels::class, 'id_approve','nama');
    }
    public function tahun(){
        return $this->belongsTo(ApproveModels::class, 'id_tahun','tahun');
    }

    
}
