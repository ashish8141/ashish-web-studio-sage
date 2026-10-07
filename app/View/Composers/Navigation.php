<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use function App\blog_url;
use function App\maintenance_url;

class Navigation extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header',
        'sections.footer',
    ];

    /**
     * Data to be passed to the views.
     *
     * @return array
     */
    public function with()
    {
        return [
            'menu' => $this->menu(),
            'services' => $this->services(),
            'servicesUrl' => home_url('/#services'),
        ];
    }

    /**
     * Primary menu items.
     *
     * @return array<int, array{label: string, url: string, current: bool, services: bool}>
     */
    protected function menu(): array
    {
        $onBlog = is_home() || is_singular('post') || is_archive();

        return collect([
            'Services' => home_url('/#services'),
            'Work' => home_url('/#work'),
            'Process' => home_url('/#process'),
            'FAQ' => home_url('/#faq'),
            'Writing' => blog_url(),
            'About' => home_url('/#about'),
        ])->map(fn ($url, $label) => [
            'label' => $label,
            'url' => $url,
            'current' => $label === 'Writing' && $onBlog,
            'services' => $label === 'Services',
        ])->values()->all();
    }

    /**
     * Services shown in the desktop mega menu and the mobile sub-menu.
     *
     * @return array<int, array{title: string, text: string, url: string}>
     */
    protected function services(): array
    {
        $url = home_url('/#services');

        $services = [
            ['title' => 'WordPress websites', 'text' => 'Fast, editable marketing sites', 'url' => $url],
            ['title' => 'Shopify stores', 'text' => 'Storefronts that convert', 'url' => $url],
            ['title' => 'Webflow and Framer', 'text' => 'Design-led sites, easy to edit', 'url' => $url],
            ['title' => 'Web apps', 'text' => 'Dashboards, portals, Next.js', 'url' => $url],
            ['title' => 'Website redesign', 'text' => 'Turn an old site into a growth asset', 'url' => $url],
            ['title' => 'Care and SEO', 'text' => 'Ongoing upkeep you can see', 'url' => $url],
        ];

        if ($maintenance = maintenance_url()) {
            $services[5] = [
                'title' => 'WordPress maintenance',
                'text' => '$129/mo, a checklist you can see',
                'url' => $maintenance,
            ];
        }

        return $services;
    }
}
