<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Excerpt tweaks.
 */
add_filter('excerpt_more', fn () => '…');
add_filter('excerpt_length', fn () => 22);

/**
 * Give comment avatars a meaningful alt instead of the WordPress default empty alt.
 */
add_filter('get_avatar', function ($avatar, $idOrEmail, $size, $default, $alt) {
    if ($alt !== '') {
        return $avatar;
    }

    $name = '';

    if (is_object($idOrEmail) && isset($idOrEmail->comment_author)) {
        $name = $idOrEmail->comment_author;
    } elseif (is_numeric($idOrEmail)) {
        $user = get_userdata((int) $idOrEmail);
        $name = $user ? $user->display_name : '';
    }

    $name = $name ?: __('Commenter', 'sage');

    /* translators: %s: commenter name */
    return str_replace("alt=''", 'alt="'.esc_attr(sprintf(__('%s avatar', 'sage'), $name)).'"', $avatar);
}, 10, 5);

/**
 * Homepage is not an article: drop "Written by / Time to read" share labels.
 */
add_filter('rank_math/opengraph/slack_enhanced_data', fn ($data) => is_front_page() ? [] : $data, 20);

/**
 * 301 the old maintenance page addresses to the current slug.
 */
add_action('template_redirect', function () {
    if (! is_404()) {
        return;
    }

    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    $old = ['wordpress-maintenance-services', 'wordpress-maintenance-seo-retainer'];

    if (in_array($path, $old, true) && maintenance_url()) {
        wp_safe_redirect(maintenance_url(), 301);
        exit;
    }
});
