<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class QuestionType extends Enum
{
    const MULTIPLE_CHOICE = 'multiptle_choice';

    const CHECKBOX = 'checkbox';

    const RADIO = 'RADIO';
}
