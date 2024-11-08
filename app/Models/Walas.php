<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Walas extends Model
{
    //
    use HasFactory;
    protected $table = 'walas';
    protected $fillable = ['nig','password','nama_walas'];
    protected $guarded = ['id'];
    protected $hidden = ['passsword'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'walas_id');
    }
}
