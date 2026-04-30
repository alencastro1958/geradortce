<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaga_id',
        'estagiario_id',
        'status'
    ];

    public function vaga()
    {
        return $this->belongsTo(Vaga::class);
    }

    public function estagiario()
    {
        return $this->belongsTo(Estagiario::class);
    }
}
