<?php

namespace App\Enums;

enum UserRole: string
{
    case CANDIDATO = 'candidato';
    case EMPRESA   = 'empresa';
    case ADMIN     = 'admin';
}
