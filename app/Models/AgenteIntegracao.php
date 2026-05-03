<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenteIntegracao extends Model
{
    use HasFactory;

    protected $table = 'agente_integracao';
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'responsavel_legal_data_nascimento' => 'date',
        ];
    }

    public function representantesLegais(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\RepresentanteLegal::class, 'entidade_id')
                    ->where('entidade_tipo', 'agente');
    }
}
