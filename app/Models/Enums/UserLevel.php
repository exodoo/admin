<?php
/**
 * Description of UserLevel.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Models\Enums;


enum UserLevel: int
{

    case GUEST = 0;
    case USER = 1;
    case STUDENT = 2;
    case TEACHER = 3;
    case ADMIN = 100;

    public function isTeacherOrGreater(): bool
    {
        return $this->value >= self::TEACHER->value;
    }
}
