<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Auth extends Enum
{
    const REGISTRATION = false;

    const EMAIL_VERIFY = true;
}
