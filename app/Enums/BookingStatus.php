<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class BookingStatus extends Enum implements LocalizedEnum
{
    const PENDING = 0;
    const PAID = 1;
    const FINISHED = 2;
    const CANCELED = 3;
}
