<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Supported Social Providers.
     *
     * @var array
     */
    protected $socialProviders = [
        'facebook',
        'google',
        'twitter',
    ];

    public function redirectToProvider($domain, $provider)
    {
        if (! in_array($provider, $this->socialProviders)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $domain, $provider)
    {
        if (! in_array($provider, $this->socialProviders)) {
            abort(404);
        }

        $user = Socialite::driver($provider)->user();

        /** @var \App\Models\User|null $userEntity */
        $userEntity = User::where('email', User::getPlainEmail($user->email))->first();

        if (! $userEntity) {
            DB::transaction(function () use ($request, $user, &$userEntity) {
                /** @var \App\Models\User $userEntity */
                $userEntity = User::forceCreate([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'email_verified_at' => now(),
                    'profile_url' => $user->getAvatar(),
                    'role' => Role::PARTICIPANT,
                ]);

                $rootDomain = $request->getHttpHost();
                $site = Site::where('domain', $rootDomain)->firstOrFail();

                $userEntity->participations()->save($site);
            });
        }

        auth()->login($userEntity);

        return view('socialite.callback');
    }
}
