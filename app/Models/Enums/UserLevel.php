<?php
/**
 * Description of UserLevel.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Models\Enums;


use Illuminate\Support\Str;

enum UserLevel: int
{

    case GUEST = 0;
    case USER = 1;
    case STUDENT = 2;
    case TEACHER = 3;
    case ADMIN = 100;

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
        return Str::ucfirst($this->name);
    }

    public function isTeacherOrGreater(): bool
    {
        return $this->value >= self::TEACHER->value;
    }

    public function isAdmin(): bool
    {
        return $this->value >= self::ADMIN->value;
    }
}
