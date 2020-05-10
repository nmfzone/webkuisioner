<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest'])
            ->only('redirectToProvider');
    }

    public function redirectToProvider(Request $request, $account, $provider)
    {
        if (! in_array($provider, $this->socialProviders)) {
            abort(404);
        }

        $request->session()->put('origin', $request->getHttpHost());

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        if (! in_array($provider, $this->socialProviders)) {
            abort(404);
        }

        $user = Socialite::driver($provider)->user();

        /** @var \App\Models\User|null $userEntity */
        $userEntity = User::where('email', $user->email)->first();
        $originDomain = $request->session()->pull('origin');

        if (! $userEntity) {
            DB::transaction(function () use ($user, &$userEntity, $originDomain) {
                /** @var \App\Models\User $userEntity */
                $userEntity = User::forceCreate([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'email_verified_at' => now(),
                    'profile_url' => $user->getAvatar(),
                    'role' => Role::PARTICIPANT,
                ]);

                $site = Site::where('domain', $originDomain)->firstOrFail();
                $userEntity->participations()->save($site);
            });
        }

        Auth::login($userEntity);

        $redirectPath = $request->getScheme() . '://' . $originDomain;

        return view('socialite.callback', compact('redirectPath'));
    }
}
