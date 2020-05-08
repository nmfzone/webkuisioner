<?php

namespace App\Garages\Database\Concerns;

use Illuminate\Support\Str;

trait SerializeEmail
{
    public static function serializeEmail($email)
    {
        if (Str::contains($email, '@')) {
            $email = explode('@', Str::lower($email));

            $email[0] = preg_replace('/[^0-9a-z]/', '', $email[0]);

            return implode('@', $email);
        }

        return $email;
    }
}
