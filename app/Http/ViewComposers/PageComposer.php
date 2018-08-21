<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class PageComposer
{

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $api  = new \App\Droit\Api\Content(env('APP_SITE'));
        $menu = $api->menu('main');

        $view->with('menu', $menu);
    }
}