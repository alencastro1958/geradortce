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
        'nome_empresa',
        'cnpj_empresa',
        'ramo_empresa',
        'descricao_empresa',
        'endereco_empresa',
        'contato_empresa',
        'email_empresa',
        'telefone_empresa',
        'titulo',
        'descricao',
        'area_atuacao',
        'quantidade',
        'modalidade',
        'cidade_estado',
        'inicio_previsto',
        'formacao_aceita',
        'cursos',
        'periodo_minimo',
        'conhecimentos_desejaveis',
        'competencias',
        'atividades',
        'horas_dia',
        'dias',
        'bolsa_auxilio',
        'horario',
        'flexibilidade',
        'transporte',
        'alimentacao',
        'seguro',
        'outros_beneficios',
        'contratacao_tipo',
        'duracao',
        'possibilidade_efetivacao',
        'etapas',
        'prazo',
        'retorno',
        'link_candidatura',
        'email_candidatura',
        'instrucoes_candidatura',
        'observacoes',
        'ativa'
    ];

    protected $casts = [
        'prazo' => 'date',
        'bolsa_auxilio' => 'decimal:2',
        'ativa' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($vaga) {
            // Gera um código único tipo VAG-2026-0001
            $ultimoId = static::max('id') ?? 0;
            $vaga->codigo_vaga = 'VAG-' . date('Y') . '-' . str_pad($ultimoId + 1, 4, '0', STR_PAD_LEFT);

            // descricao e horario sao NOT NULL na tabela original — garantir fallback
            if (empty($vaga->descricao)) {
                $vaga->descricao = $vaga->atividades ?? $vaga->titulo ?? '-';
            }
            if (empty($vaga->horario)) {
                $vaga->horario = 'A combinar';
            }
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

    public function preencherDadosDaEmpresa(EmpresaConcedente $empresa): void
    {
        $this->empresa()->associate($empresa);
        $this->nome_empresa = $this->nome_empresa ?: $empresa->razao_social;
        $this->cnpj_empresa = $this->cnpj_empresa ?: $empresa->cnpj;
        $this->ramo_empresa = $this->ramo_empresa ?: $empresa->ramo_atividade;
        $this->descricao_empresa = $this->descricao_empresa ?: $empresa->observacoes;
        $this->endereco_empresa = $this->endereco_empresa ?: $empresa->endereco;
        $this->contato_empresa = $this->contato_empresa ?: ($empresa->contato_nome ?: $empresa->responsavel_legal_nome);
        $this->email_empresa = $this->email_empresa ?: $empresa->email;
        $this->telefone_empresa = $this->telefone_empresa ?: $empresa->telefone;
    }
}
