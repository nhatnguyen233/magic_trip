<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 */
final class BookType extends Enum implements LocalizedEnum
{
    const OFFLINE = 0;
    const ONLINE = 1;
}
