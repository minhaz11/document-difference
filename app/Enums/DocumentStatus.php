<?php

namespace App\Enums;

use App\Enums\Attributes\EnumAttributes;

enum DocumentStatus: string
{
    use EnumAttributes;
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';


}
