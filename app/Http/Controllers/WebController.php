<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['forbid_participant'])
            ->only('index');
    }

    public function index()
    {
        if (is_tenant()) {
            return view('tenant_welcome');
        }

        return view('welcome');
    }

    public function privacyPolicy()
    {
        return view('privacy_policy');
    }
}
