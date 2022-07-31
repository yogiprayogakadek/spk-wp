<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $guarded = ['id_alternatif'];
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_alternatif', 'id_alternatif');
    }
}
