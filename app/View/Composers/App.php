<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use function App\blog_url;
use function App\book_url;
use function App\call_url;
use function App\maintenance_url;
use function App\privacy_url;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data shared with every view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'siteName' => get_bloginfo('name', 'display'),
            'homeUrl' => home_url('/'),
            'bookUrl' => book_url(),
            'callUrl' => call_url(),
            'blogUrl' => blog_url(),
            'maintenanceUrl' => maintenance_url(),
            'privacyUrl' => privacy_url(),
        ];
    }
}
