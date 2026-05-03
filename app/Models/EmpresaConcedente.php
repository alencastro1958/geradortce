<?php

namespace App\Models;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmpresaConcedente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'cnpj', 'razao_social', 'nome_fantasia', 'endereco', 'logradouro', 'numero', 'complemento',
        'bairro', 'cidade', 'estado', 'cep', 'telefone', 'telefone_secundario', 'email', 'email_secundario',
        'responsavel_legal_nome', 'responsavel_legal_cargo', 'responsavel_legal_cpf', 'responsavel_legal_rg',
        'responsavel_legal_email', 'responsavel_legal_whatsapp', 'autoriza_envio_mensagens',
        'responsavel_legal_rg_orgao_emissor', 'responsavel_legal_rg_uf', 'responsavel_legal_nacionalidade',
        'responsavel_legal_data_nascimento', 'responsavel_legal_celular', 'responsavel_legal_celular2',
        'responsavel_legal_principal', 'responsavel_legal_ativo', 'responsavel_legal_assina_documentos',
        'responsavel_legal_observacoes',
        'supervisor_nome', 'supervisor_cargo', 'supervisor_formacao', 'supervisor_tempo_atividade',
        'supervisor_cpf', 'supervisor_rg', 'supervisor_email', 'supervisor_telefone_whatsapp',
        'supervisor_registro_profissional',
        'supervisor_estagio_nome', 'supervisor_estagio_cargo', 'supervisor_estagio_formacao',
        'supervisor_estagio_cpf', 'supervisor_estagio_email', 'supervisor_estagio_telefone',
        'supervisor_data_nascimento', 'supervisor_rg_orgao_emissor', 'supervisor_rg_uf',
        'supervisor_celular', 'supervisor_orgao_regulamentador', 'supervisor_outras_formacoes',
        'supervisor_observacoes', 'supervisor_ativo', 'supervisor_setor', 'supervisor_matricula',
        'supervisor_acessa_processo_seletivo', 'supervisor_assina_documentos',
        'mantenedora', 'contato_nome', 'contato_fone', 'contato_email', 'observacoes'
    ];

    protected function casts(): array
    {
        return [
            'responsavel_legal_data_nascimento' => 'date',
            'supervisor_data_nascimento' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function estagios(): HasMany
    {
        return $this->hasMany(Estagio::class);
    }
}