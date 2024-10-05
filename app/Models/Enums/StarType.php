<?php
/**
 * Description of StartType.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Models\Enums;

enum StarType: string
{

    case O = 'O-type';  // Hot, blue stars
    case B = 'B-type';  // Blue stars
    case A = 'A-type';  // White-blue stars
    case F = 'F-type';  // Yellow-white stars
    case G = 'G-type';  // Yellow stars (e.g., the Sun)
    case K = 'K-type';  // Orange stars
    case M = 'M-type';  // Red dwarfs (cool, faint stars)

    public static function values(): array
    {
        return array_map(fn(self $type): string => $type->value, self::cases());
    }

    public static function options(): array
    {
        $result = [];
        foreach (self::cases() as $case) {
            $result[$case->value] = $case->label();
        }
        return $result;
    }

    public function label(): string
    {
        return $this->value;
    }

    public function isHot(): bool
    {
        return in_array($this->value, [self::O->value, self::B->value], true);
    }

    public function isCold(): bool
    {
        return in_array($this->value, [self::K->value, self::M->value], true);
    }

}
