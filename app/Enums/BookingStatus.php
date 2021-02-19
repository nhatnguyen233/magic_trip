<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BookingStatus extends Enum implements LocalizedEnum
{
    const PENDING = 0;
    const FINISHED = 1;
    const CANCELED = 2;
}
