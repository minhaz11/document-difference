<?php


namespace App\Enums\Attributes;

use Illuminate\Support\Str;
use ReflectionClassConstant;

trait EnumAttributes
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
