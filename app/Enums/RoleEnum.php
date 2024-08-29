<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case BOUTIQUIER = 'boutiquier';
    case CLIENT = 'client';
}
