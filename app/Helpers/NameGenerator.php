<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class NameGenerator
{
    /**
     * Generate random string with provided amount of characters.
     * @param int $characters
     * @return string
     */
    public static function generate(int $characters): string
    {
        return Str::random($characters);
    }
}
