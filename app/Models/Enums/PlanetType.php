<?php
/**
 * Description of PlanetType.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Models\Enums;

enum PlanetType: string
{

    case GAS_GIANT = 'Gas Giant';
    case NEPTUNE_LIKE = 'Neptune-like';
    case SUPER_EARTH = 'Super-Earth';
    case TERRESTRIAL = 'Terrestrial';

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

}
