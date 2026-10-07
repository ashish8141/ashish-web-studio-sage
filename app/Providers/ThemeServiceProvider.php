<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // WordPress strings often already contain entities (&amp;, &#8217;): don't encode them twice in {{ }}.
        Blade::withoutDoubleEncoding();
    }
}
