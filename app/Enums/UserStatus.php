<?php

namespace App\Enums;

use App\Enums\Attributes\EnumAttributes;

enum UserStatus: string
{
    use EnumAttributes;
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';


}
