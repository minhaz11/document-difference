<?php

namespace App\Enums;

use App\Enums\Attributes\EnumAttributes;

enum UserRole: string
{
    use EnumAttributes;
    case AUTHOR = 'author';
    case CLIENT = 'client';



}
