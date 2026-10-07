<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use function App\reading_time;

class Blog extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'index',
        'partials.post-card',
    ];

    /**
     * Data to be passed to the views.
     *
     * @return array
     */
    public function with()
    {
        return [
            'isBlogHome' => is_home(),
            'isFirstPage' => max(1, (int) get_query_var('paged')) === 1,
            'blogIntro' => get_theme_mod('aws_blog_intro', 'What I have learned in eight years of building websites, stores, apps and automations, and what I think about the work.'),
            'kicker' => fn () => $this->kicker(),
        ];
    }

    /**
     * "CATEGORY, MON YYYY, N MIN READ" line for the current post in the loop.
     */
    protected function kicker(): string
    {
        $categories = get_the_category();

        return strtoupper(implode(', ', [
            $categories ? $categories[0]->name : 'Article',
            get_the_date('M Y'),
            reading_time(),
        ]));
    }
}
