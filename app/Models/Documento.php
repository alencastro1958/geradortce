<?php

namespace App\Models;

use App\Enums\DocumentoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

readonly class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'estagio_id', 'tipo', 'nome_arquivo', 'caminho_arquivo', 'status', 'hash', 'signed_at'
    ];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'status' => DocumentoStatus::class,
            'signed_at' => 'datetime',
        ];
    }

    public function estagio(): BelongsTo
    {
        return $this->belongsTo(Estagio::class);
    }
}
