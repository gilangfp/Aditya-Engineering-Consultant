<?php

namespace App\Models;

use App\Models\DepartemenModels;
use App\Models\SubModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartemenModels extends Model
{
    
    public function departemen()
    {
        return $this->belongsTo(SubModels::class);
    }
 
    use HasFactory;
    protected $table = 'departemen';
    protected $guarded = [];
}
