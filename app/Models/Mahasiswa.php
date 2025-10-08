<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function progress_terakhir()
    {
        return $this->hasOne(Progress::class, 'mahasiswas_id', 'id')->latest();
    }
}
