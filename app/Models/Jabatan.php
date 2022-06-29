<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $guarded = ['id_jabatan'];

    public function user()
    {
        return $this->hasMany(User::class, 'id_jabatan');
    }
}
