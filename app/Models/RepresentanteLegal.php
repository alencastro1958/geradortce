<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepresentanteLegal extends Model
{
    protected $table = 'representantes_legais';

    protected $fillable = [
        'entidade_tipo', 'entidade_id', 'nome', 'cpf', 'rg',
        'rg_orgao_emissor', 'rg_uf', 'cargo', 'nacionalidade',
        'data_nascimento', 'email', 'celular', 'celular2', 'whatsapp',
        'principal', 'ativo', 'assina_documentos', 'observacoes',
    ];

    protected function casts(): array {
        return [
            'data_nascimento' => 'date',
            'principal' => 'boolean',
            'ativo' => 'boolean',
            'assina_documentos' => 'boolean',
        ];
    }
}
