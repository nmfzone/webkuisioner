<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class SiteComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('site', Request::hasSession() ? Request::session()->get('site') : null);
    }
}
