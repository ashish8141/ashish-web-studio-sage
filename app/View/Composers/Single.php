<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use function App\process_toc;
use function App\reading_time;
use function App\social_links;

class Single extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single',
        'partials.single-*',
    ];

    /**
     * Data to be passed to the views.
     *
     * The partials are rendered inside the loop (after the_post()), so their
     * data is built with the regular template tags, per partial, at that point.
     *
     * Text that the old template printed with esc_html() is escaped here and
     * printed raw in the views: esc_html() leaves existing entities (&amp;,
     * &#8217;...) alone, while Blade's {{ }} would encode them a second time.
     *
     * @return array
     */
    public function with()
    {
        return match ($this->view->name()) {
            'partials.single-header' => $this->header(),
            'partials.single-body' => $this->body(),
            'partials.single-share' => ['shareButtons' => $this->shareButtons()],
            'partials.single-author' => $this->author(),
            'partials.single-related' => [
                'allPostsUrl' => $this->allPostsUrl(),
                'related' => $this->related(),
            ],
            default => [],
        };
    }

    /**
     * Article header: back link, categories, title, dek and byline.
     */
    protected function header(): array
    {
        return [
            'allPostsUrl' => $this->allPostsUrl(),
            'categories' => $this->categories(),
            'title' => get_the_title(),
            'excerpt' => has_excerpt() ? esc_html(get_the_excerpt()) : null,
            'avatar' => get_avatar(get_the_author_meta('ID'), 44, '', ''),
            'authorName' => get_the_author(),
            'date' => get_the_date(),
            'readingTime' => reading_time(),
        ];
    }

    /**
     * Posts page URL, falling back to the home page.
     */
    protected function allPostsUrl(): string
    {
        return get_permalink(get_option('page_for_posts')) ?: home_url('/');
    }

    /**
     * Categories of the current post; the first one is the primary.
     *
     * @return array<int, array{name: string, url: string, primary: bool}>
     */
    protected function categories(): array
    {
        return collect(get_the_category())
            ->values()
            ->map(fn ($category, $index) => [
                'name' => esc_html($category->name),
                'url' => get_category_link($category),
                'primary' => $index === 0,
            ])
            ->all();
    }

    /**
     * Filtered post content with ids on the H2s, plus the table of contents.
     *
     * @return array{content: string, toc: array<int, array{id: string, title: string}>}
     */
    protected function body(): array
    {
        $processed = process_toc(apply_filters('the_content', get_the_content()));

        return [
            'content' => $processed['content'],
            'toc' => array_map(fn ($item) => [
                'id' => $item['id'],
                'title' => esc_html($item['title']),
            ], $processed['toc']),
        ];
    }

    /**
     * Share buttons (the click handling lives in the theme JS).
     *
     * @return array<int, array{network: string, label: string, icon: string}>
     */
    protected function shareButtons(): array
    {
        return [
            [
                'network' => 'twitter',
                'label' => 'Share on X',
                'icon' => '<svg viewBox="0 0 512 512" width="14" height="14" fill="currentColor" aria-hidden="true" focusable="false"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L196.4 280.8 22.4 48H167.5l97.3 128.5L389.2 48zm-24.8 373.8h39.1L149.1 88h-42l257.3 333.8z"/></svg>',
            ],
            [
                'network' => 'linkedin',
                'label' => 'Share on LinkedIn',
                'icon' => '<svg viewBox="0 0 448 512" width="15" height="15" fill="currentColor" aria-hidden="true" focusable="false"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94.09 0 111.28 62 111.28 142.3V448z"/></svg>',
            ],
            [
                'network' => 'copy',
                'label' => 'Copy link',
                'icon' => '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true" focusable="false"><path d="M10.6 13.4a4.5 4.5 0 0 0 6.79.49l2.7-2.7a4.5 4.5 0 0 0-6.36-6.37l-1.55 1.54"/><path d="M13.4 10.6a4.5 4.5 0 0 0-6.79-.49l-2.7 2.7a4.5 4.5 0 0 0 6.36 6.37l1.54-1.55"/></svg>',
            ],
        ];
    }

    /**
     * Author card below the article.
     */
    protected function author(): array
    {
        return [
            'avatar' => get_avatar(get_the_author_meta('ID'), 84, '', ''),
            'authorName' => get_the_author(),
            'bio' => esc_html(get_the_author_meta('description') ?: 'Web, mobile app & AI automation consultant building fast, conversion-focused sites on WordPress, Shopify, Framer, Webflow, and Next.js. Eight years in tech, still shipping.'),
            'contactUrl' => home_url('/#contact'),
            'profiles' => $this->profiles(),
        ];
    }

    /**
     * External profiles linked from the author card.
     *
     * @return array<int, array{label: string, url: string}>
     */
    protected function profiles(): array
    {
        return collect(social_links())
            ->whereIn('label', ['LinkedIn', 'Fiverr'])
            ->map(fn ($profile) => [
                'label' => strtolower($profile['label']),
                'url' => $profile['url'],
            ])
            ->values()
            ->all();
    }

    /**
     * Up to three random posts from the same categories, or else the latest posts.
     *
     * @return array<int, array{url: string, thumbnail: string, kicker: string, title: string}>
     */
    protected function related(): array
    {
        $posts = get_posts([
            'numberposts' => 3,
            'post__not_in' => [get_the_ID()],
            'category__in' => wp_get_post_categories(get_the_ID()),
            'orderby' => 'rand',
        ]);

        if (! $posts) {
            $posts = get_posts(['numberposts' => 3, 'post__not_in' => [get_the_ID()]]);
        }

        return array_map(function ($post) {
            $categories = get_the_category($post->ID);

            return [
                'url' => get_permalink($post),
                'thumbnail' => has_post_thumbnail($post) ? get_the_post_thumbnail($post, 'aws-card') : '',
                'kicker' => $categories ? esc_html(strtoupper($categories[0]->name)) : 'ARTICLE',
                'title' => esc_html(get_the_title($post)),
            ];
        }, $posts);
    }
}
