<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusHost extends Enum
{
    const UNAPPROVE = 0;
    const APPROVE = 1;
}
