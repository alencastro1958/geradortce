<?php

namespace App\Enums;

enum DocumentoStatus: string
{
    case PENDENTE = 'pendente';
    case GERANDO = 'gerando';
    case PRONTO = 'pronto';
    case ASSINANDO = 'assinado';
    case ASSINADO = 'assinado';
    case CANCELADO = 'cancelado';
    case ERRO = 'erro';
}