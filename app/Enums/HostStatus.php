<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 */
final class HostStatus extends Enum implements LocalizedEnum
{
    const NONE = 0;
    const ACTIVE = 1;
}
