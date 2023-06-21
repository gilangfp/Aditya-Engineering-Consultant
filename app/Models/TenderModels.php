<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderModels extends Model
{
    use HasFactory;
    protected $table = 'tender';
    protected $guarded = [];
}
