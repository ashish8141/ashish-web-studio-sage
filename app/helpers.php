<?php

/**
 * Theme helpers.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/** Page ID of the WordPress maintenance landing page. */
const MAINTENANCE_PAGE_ID = 670;

/**
 * URL of a theme image processed by Vite (resources/images/...).
 */
function image(string $path): string
{
    return Vite::asset('resources/images/'.ltrim($path, '/'));
}

/**
 * Blog (posts page) URL.
 */
function blog_url(): string
{
    $url = get_permalink(get_option('page_for_posts'));

    return $url ?: home_url('/blog/');
}

/**
 * Where "Book a call" buttons point.
 */
function book_url(): string
{
    return home_url('/#contact');
}

/**
 * Calendar booking link.
 */
function call_url(): string
{
    return get_theme_mod('aws_call_url', 'https://calendly.com/felicitysmoak199/consulation-call');
}

/**
 * Privacy policy URL.
 */
function privacy_url(): string
{
    $id = (int) get_option('wp_page_for_privacy_policy');

    return $id ? get_permalink($id) : home_url('/privacy-policy/');
}

/**
 * Maintenance landing page URL, only once the page is published.
 */
function maintenance_url(): string
{
    return get_post_status(MAINTENANCE_PAGE_ID) === 'publish'
        ? (string) get_permalink(MAINTENANCE_PAGE_ID)
        : '';
}

/**
 * Estimated reading time for a post (words / 200 wpm).
 */
function reading_time(?int $postId = null): string
{
    $postId = $postId ?: get_the_ID();
    $words = str_word_count(wp_strip_all_tags(get_post_field('post_content', $postId)));
    $minutes = max(1, (int) ceil($words / 200));

    /* translators: %d: minutes */
    return sprintf(_n('%d min read', '%d min read', $minutes, 'sage'), $minutes);
}

/**
 * Build a table of contents from the H2s in the content and add ids to them.
 *
 * @return array{content: string, toc: array<int, array{id: string, title: string}>}
 */
function process_toc(string $content): array
{
    $toc = [];

    $content = preg_replace_callback(
        '/<h2([^>]*)>(.*?)<\/h2>/is',
        function ($m) use (&$toc) {
            $title = trim(wp_strip_all_tags($m[2]));
            $slug = sanitize_title($title);

            if ($slug === '') {
                $slug = 'section-'.(count($toc) + 1);
            }

            $base = $slug;
            $i = 2;
            $ids = wp_list_pluck($toc, 'id');

            while (in_array($slug, $ids, true)) {
                $slug = $base.'-'.$i;
                $i++;
            }

            $toc[] = ['id' => $slug, 'title' => $title];
            $attrs = $m[1];

            if (stripos($attrs, 'id=') === false) {
                $attrs .= ' id="'.esc_attr($slug).'"';
            }

            return '<h2'.$attrs.'>'.$m[2].'</h2>';
        },
        $content
    );

    return ['content' => $content, 'toc' => $toc];
}

/**
 * Social profiles shown in the footer and contact areas.
 *
 * @return array<int, array{label: string, url: string}>
 */
function social_links(): array
{
    return [
        ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/ashish-jat-7b1ab396/'],
        ['label' => 'GitHub', 'url' => 'https://github.com/ashish8141/'],
        ['label' => 'Fiverr', 'url' => 'https://www.fiverr.com/felicitysmoak'],
        ['label' => 'YouTube', 'url' => 'https://www.youtube.com/@ashishwebstudio'],
        ['label' => 'Instagram', 'url' => 'https://www.instagram.com/ashish_pg_8141'],
    ];
}

/**
 * Brand icon (inline SVG, currentColor) for a social label.
 */
function social_icon(string $label): string
{
    $paths = [
        'LinkedIn' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 1 1 0-4.125 2.062 2.062 0 0 1 0 4.125zM7.119 20.452H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z',
        'GitHub' => 'M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12',
        'YouTube' => 'M23.499 6.203a3.008 3.008 0 0 0-2.089-2.089c-1.87-.501-9.4-.501-9.4-.501s-7.509-.01-9.399.501a3.008 3.008 0 0 0-2.088 2.09A31.258 31.258 0 0 0 0 12a31.258 31.258 0 0 0 .523 5.785 3.008 3.008 0 0 0 2.088 2.089c1.869.502 9.4.502 9.4.502s7.508 0 9.399-.502a3.008 3.008 0 0 0 2.089-2.089 31.24 31.24 0 0 0 .5-5.785 31.24 31.24 0 0 0-.5-5.797zM9.609 15.601V8.408l6.264 3.602z',
        'Instagram' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z',
    ];

    if ($label === 'Fiverr') {
        return '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><text x="11.5" y="17.5" text-anchor="middle" font-family="Space Grotesk, sans-serif" font-weight="700" font-size="16" letter-spacing="-0.5" fill="currentColor">fi</text><circle cx="20" cy="16.6" r="1.6" fill="currentColor"/></svg>';
    }

    return isset($paths[$label])
        ? '<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false"><path fill="currentColor" d="'.$paths[$label].'"/></svg>'
        : '';
}

/**
 * Comment renderer used by wp_list_comments().
 */
function render_comment($comment, array $args, int $depth): void
{
    echo view('partials.comment', [
        'comment' => $comment,
        'args' => $args,
        'depth' => $depth,
    ])->render();
    // WordPress closes the <li> for us.
}
