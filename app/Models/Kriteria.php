<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id_kriteria'];
    protected $primaryKey = 'id_kriteria';
    protected $table = 'kriteria';
}
