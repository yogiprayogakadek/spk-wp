<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $guarded = ['id_nilai'];
    protected $primaryKey = 'id_nilai';
    protected $table = 'nilai';

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }
}
