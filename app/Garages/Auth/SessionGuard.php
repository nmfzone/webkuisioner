<?php

namespace App\Garages\Auth;

use App\Enums\Role;
use Illuminate\Auth\SessionGuard as Guard;

class SessionGuard extends Guard
{
    /**
     * @inheritDoc
     */
    public function attempt(array $credentials = [], $remember = false)
    {
        $this->fireAttemptEvent($credentials, $remember);

        /** @var \App\Models\User|null $user */
        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        /** @var \App\Models\Site|null $site */
        $site = $this->session->get('site');

        if ((! $site ||
                ($user->role === Role::PARTICIPANT) ||
                ($user->role === Role::OWNER && $site->user->is($user))) &&
            $this->hasValidCredentials($user, $credentials)) {
            $this->login($user, $remember);

            return true;
        }

        $this->fireFailedEvent($user, $credentials);

        return false;
    }
}
