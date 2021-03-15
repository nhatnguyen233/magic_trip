<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CatType extends Enum
{
    const COORDINATION = 1;
    const TOURISM = 2;
    const REST = 3;
    const OTHER = 4;
}
