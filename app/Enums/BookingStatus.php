<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 * @method static static OptionFour()
 * @method static static OptionFive()
 */

final class BookingStatus extends Enum implements LocalizedEnum
{
    const PENDING = 0;
    const APPROVED = 1;
    const PAID = 2;
    const FINISHED = 3;
    const CANCELED = 4;
}
