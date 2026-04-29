<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function estagiario()
    {
        return $this->belongsTo(Estagiario::class);
    }

    public function empresaConcedente()
    {
        return $this->belongsTo(EmpresaConcedente::class);
    }

    public function instituicaoEnsino()
    {
        return $this->belongsTo(InstituicaoEnsino::class);
    }

    public function seguradora()
    {
        return $this->belongsTo(Seguradora::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
