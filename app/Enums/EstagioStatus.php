<?php

namespace App\Enums;

enum EstagioStatus: string
{
    case PENDENTE = 'pendente';
    case ATIVO = 'ativo';
    case CONCLUIDO = 'concluido';
    case RESCINDIDO = 'rescindido';
}