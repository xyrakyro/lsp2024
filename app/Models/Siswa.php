<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    //
    use HasFactory;
    protected $table = 'siswas';
    protected $fillable = ['nis','password','nama_siswa'];
    protected $guarded = ['id'];
    protected $hidden = ['passsword'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
