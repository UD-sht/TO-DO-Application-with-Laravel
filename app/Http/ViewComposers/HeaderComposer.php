<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HeaderComposer
{
    public function __construct(
    ) {}

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $authUser = Auth::user();
        $view->with([
                'user' => ($authUser),
                'notificationCount' => ($authUser->unreadNotifications()->count()),
                'notifications' => ($authUser->unreadNotifications()->take(3)->get()),
            ]);
        // dd($view);

        return $view;
    }
}
