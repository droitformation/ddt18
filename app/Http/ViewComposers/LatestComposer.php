<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class LatestComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $api;

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
        $api = new \App\Droit\Api\Jurisprudence(env('APP_SITE'));
        $latest = $api->arrets(['limit' => 4]);

        $view->with('latest', $latest);
    }
}