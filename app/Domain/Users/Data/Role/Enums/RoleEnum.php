<?php

namespace App\Domain\Users\Data\Role\Enums;

enum RoleEnum: int
{
    case SYSTEM_ADMIN   =   1;
    case AUDIT_OPERATOR =   2;
    case OBSERVER   =   3;
}
