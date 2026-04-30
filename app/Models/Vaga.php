<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_vaga',
        'empresa_id',
        'titulo',
        'descricao',
        'area_atuacao',
        'bolsa_auxilio',
        'horario',
        'ativa'
    ];

    protected static function booted()
    {
        static::creating(function ($vaga) {
            // Gera um código único tipo VAG-2026-0001
            $ultimoId = static::max('id') ?? 0;
            $vaga->codigo_vaga = 'VAG-' . date('Y') . '-' . str_pad($ultimoId + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    public function empresa()
    {
        return $this->belongsTo(EmpresaConcedente::class, 'empresa_id');
    }

    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class);
    }
}
