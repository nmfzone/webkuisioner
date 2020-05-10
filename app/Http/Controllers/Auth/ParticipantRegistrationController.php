<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class ParticipantRegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid_participant'])
            ->only('existingUser');
    }

    public function existingUser(Request $request, $account)
    {
        if ($request->user()->role === Role::PARTICIPANT) {
            /** @var \App\Models\Site $site */
            $site = Site::where('domain', $request->getHttpHost())->firstOrFail();
            $site->participants()->save($request->user());
        }

        return redirect(route('home'));
    }
}
