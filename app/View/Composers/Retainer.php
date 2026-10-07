<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Retainer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'template-retainer',
        'retainer.*',
    ];

    /**
     * Monthly price of the plan, in USD.
     */
    protected const PRICE = '129';

    /**
     * Data to be passed to the views.
     *
     * @return array
     */
    public function with()
    {
        $groups = $this->groups();
        $total = array_sum(array_column($groups, 'count'));
        $schedule = $this->schedule();
        $faqs = $this->faqs($total, self::PRICE);

        return [
            'subscribed' => isset($_GET['subscribed']),
            'price' => self::PRICE,
            'groups' => $groups,
            'total' => $total,
            'problems' => $this->problems(),
            'included' => $this->included(),
            'schedule' => $schedule,
            'weeks' => $this->weeks($schedule),
            'faqs' => $faqs,
            'faqSchema' => $this->faqSchema($faqs),
            'paypal' => $this->paypal(),
            'projectUrl' => home_url('/#contact'),
            'contactForm' => '[forminator_form id="535"]',
        ];
    }

    /**
     * PayPal subscription checkout configuration (stored in the `aws_rm_paypal` option).
     *
     * @return array{clientId: string, planId: string, ready: bool, sdkUrl: string, returnUrl: string}
     */
    protected function paypal(): array
    {
        $option = wp_parse_args(
            (array) get_option('aws_rm_paypal', []),
            ['client_id' => '', 'plan_id' => '']
        );

        return [
            'clientId' => $option['client_id'],
            'planId' => $option['plan_id'],
            'ready' => $option['client_id'] !== '' && $option['plan_id'] !== '',
            'sdkUrl' => 'https://www.paypal.com/sdk/js?client-id=' . rawurlencode($option['client_id']) . '&vault=true&intent=subscription',
            'returnUrl' => add_query_arg('subscribed', '1', get_permalink()),
        ];
    }

    /**
     * The real checklist, grouped by cadence.
     *
     * @return array<string, array{title: string, tab: string, count: int, items: array<int, array{label: string, sub: array<int, string>}>}>
     */
    protected function groups(): array
    {
        $groups = [
            'fortnightly' => [
                'title' => 'Every 2 weeks',
                'tab' => 'Every 2 weeks',
                'items' => [
                    'Backup the site',
                    [
                        'label' => 'Update WordPress and plugins',
                        'sub' => [
                            'Assess plugin updates',
                            'Check for plugin conflicts',
                            'Ensure no visual changes after updates',
                        ],
                    ],
                    'Security log check',
                    'Bot access analysis',
                    'Check and report uptime logs',
                    'Check page speeds',
                    'Check the site on multiple devices',
                    'Check for broken links',
                    'Check for 404 errors',
                    'Test search functionality',
                    'Perform a visual inspection',
                ],
            ],
            'monthly' => [
                'title' => 'Every month',
                'tab' => 'Monthly',
                'items' => [
                    'Check contact forms',
                    'Test functionality of all forms',
                    'Check lead magnets: delivery and emails',
                    'Check all site emails are working',
                    'Pixels and tracking links on funnels and bookings',
                    'Make sure images are not too large',
                    'Update contact information',
                    'Review analytics',
                    'Disable plugins not in use',
                ],
            ],
            'seo' => [
                'title' => 'SEO check, monthly',
                'tab' => 'SEO',
                'items' => [
                    'Run an on-page SEO audit',
                    'Refresh sitemaps if needed',
                    'Check internal and external linking',
                    'Set proper redirects if needed',
                    'Optimise images',
                    'Check page titles, descriptions and alt tags',
                ],
            ],
        ];

        return array_map(function (array $group) {
            $group['items'] = array_map(
                fn ($item) => is_array($item) ? $item : ['label' => $item, 'sub' => []],
                $group['items']
            );
            $group['count'] = count($group['items']);

            return $group;
        }, $groups);
    }

    /**
     * "The problem" cards.
     *
     * @return array<int, array{title: string, text: string, icon: string}>
     */
    protected function problems(): array
    {
        return [
            [
                'title' => 'Outdated plugins',
                'text' => 'Most WordPress hacks get in through plugins and themes that were never updated.',
                'icon' => '<svg viewBox="0 0 48 48"><rect x="8" y="12" width="26" height="26" rx="4"/><path d="M14 20h14M14 26h9"/><circle cx="36" cy="14" r="7" class="bad"/><path d="M36 10.5v4.2M36 17.2v.3" class="bad"/></svg>',
            ],
            [
                'title' => 'No recent backup',
                'text' => 'When something breaks, there is nothing clean to restore from, and the site stays down.',
                'icon' => '<svg viewBox="0 0 48 48"><ellipse cx="22" cy="13" rx="12" ry="4.5"/><path d="M10 13v20c0 2.5 5.4 4.5 12 4.5s12-2 12-4.5V13M10 23c0 2.5 5.4 4.5 12 4.5s12-2 12-4.5"/><path d="M33 33l8 8M41 33l-8 8" class="bad"/></svg>',
            ],
            [
                'title' => 'Broken forms and emails',
                'text' => 'A contact form or lead magnet quietly stops sending, and you find out weeks later from a lost lead.',
                'icon' => '<svg viewBox="0 0 48 48"><rect x="6" y="12" width="30" height="22" rx="3"/><path d="M6 15l15 10 15-10"/><path d="M34 30l8 8M42 30l-8 8" class="bad"/></svg>',
            ],
            [
                'title' => 'Invisible work',
                'text' => 'Most maintenance plans are a black box. You pay every month and just hope something is being done.',
                'icon' => '<svg viewBox="0 0 48 48"><rect x="8" y="8" width="30" height="34" rx="3"/><path d="M14 17h14M14 24h10M14 31h12"/><circle cx="36" cy="34" r="7" class="bad"/><path d="M34 32c0-2 4-2 4 0s-2 1.5-2 3M36 37.6v.2" class="bad"/></svg>',
            ],
        ];
    }

    /**
     * "What you get" cards.
     *
     * @return array<int, array{kicker: string, title: string, text: string, art: string}>
     */
    protected function included(): array
    {
        return [
            [
                'kicker' => 'Updates',
                'title' => 'Safe WordPress and plugin updates',
                'text' => 'Every update is assessed, checked for plugin conflicts and visually verified, so nothing changes on your site by surprise.',
                'art' => '<svg viewBox="0 0 64 64"><path d="M32 10a22 22 0 1 1-19 11"/><path d="M13 10v11h11"/><path d="M32 22v11l7 5" class="ac"/></svg>',
            ],
            [
                'kicker' => 'Backups',
                'title' => 'Backups every two weeks',
                'text' => 'A full backup of your site before anything changes, so there is always a clean version to roll back to.',
                'art' => '<svg viewBox="0 0 64 64"><ellipse cx="32" cy="16" rx="18" ry="6"/><path d="M14 16v32c0 3.3 8 6 18 6s18-2.7 18-6V16M14 32c0 3.3 8 6 18 6s18-2.7 18-6"/><path d="M26 44l5 5 9-10" class="ac"/></svg>',
            ],
            [
                'kicker' => 'Security',
                'title' => 'Security logs and bot analysis',
                'text' => 'Security logs and bot access are reviewed every two weeks, and uptime logs are checked and reported to you.',
                'art' => '<svg viewBox="0 0 64 64"><path d="M32 8l20 7v14c0 13-8.5 22.5-20 27-11.5-4.5-20-14-20-27V15z"/><path d="M23 32l6 6 12-13" class="ac"/></svg>',
            ],
            [
                'kicker' => 'Performance',
                'title' => 'Speed, devices and visual checks',
                'text' => 'Page speed, image sizes and a visual inspection on multiple devices, so the site looks right and loads fast everywhere.',
                'art' => '<svg viewBox="0 0 64 64"><path d="M10 42a22 22 0 0 1 44 0"/><path d="M32 42l11-13" class="ac"/><circle cx="32" cy="42" r="3.5"/><path d="M16 50h32"/></svg>',
            ],
            [
                'kicker' => 'Leads',
                'title' => 'Forms, lead magnets and emails',
                'text' => 'Every form is tested, lead magnets are checked for delivery, and tracking pixels on your funnels stay in place.',
                'art' => '<svg viewBox="0 0 64 64"><rect x="8" y="14" width="42" height="30" rx="4"/><path d="M8 18l21 14 21-14"/><circle cx="50" cy="46" r="8" class="ac"/><path d="M46.5 46l2.5 2.5 4.5-5" class="ac"/></svg>',
            ],
            [
                'kicker' => 'Weekly call',
                'title' => 'A Zoom call every week',
                'text' => 'One call a week to go through what was checked, what was fixed and what comes next. You talk to the person doing the work.',
                'art' => '<svg viewBox="0 0 64 64"><rect x="6" y="18" width="36" height="28" rx="5"/><path d="M42 28l14-8v24l-14-8" class="ac"/></svg>',
            ],
            [
                'kicker' => 'Customization',
                'title' => '5 website changes a month',
                'text' => 'Five changes included every month, like updating content, swapping images or adjusting a section. Bigger builds are quoted separately.',
                'art' => '<svg viewBox="0 0 64 64"><rect x="8" y="10" width="48" height="40" rx="4"/><path d="M8 20h48"/><path d="M22 42l14-14 5 5-14 14h-5z" class="ac"/></svg>',
            ],
            [
                'kicker' => 'SEO health',
                'title' => 'A monthly SEO check',
                'text' => 'On-page audit, sitemaps, internal links, redirects, titles, descriptions and alt tags, plus broken links and 404s.',
                'art' => '<svg viewBox="0 0 64 64"><circle cx="28" cy="28" r="16"/><path d="M40 40l14 14"/><path d="M20 30l5-5 5 4 7-8" class="ac"/></svg>',
            ],
        ];
    }

    /**
     * Rows of the "week by week" calendar. `weeks` maps a week number (1-4) to its pill label.
     *
     * @return array<int, array{cadence: string, title: string, color: string, weeks: array<int, string>, text: string}>
     */
    protected function schedule(): array
    {
        return [
            [
                'cadence' => 'Weekly',
                'title' => 'Zoom call',
                'color' => '#8fe3a8',
                'weeks' => [1 => 'Zoom call', 2 => 'Zoom call', 3 => 'Zoom call', 4 => 'Zoom call'],
                'text' => 'One call every week to walk through what was done and what is next.',
            ],
            [
                'cadence' => 'Every 2 weeks',
                'title' => 'Core checks',
                'color' => '#f2f1ee',
                'weeks' => [1 => 'Core checks', 3 => 'Core checks'],
                'text' => 'Backup, safe updates, security and bot logs, uptime, speed, devices, broken links, 404s, search and a visual check.',
            ],
            [
                'cadence' => 'Monthly',
                'title' => 'Forms, leads & housekeeping',
                'color' => '#ffc24b',
                'weeks' => [2 => 'Monthly checks'],
                'text' => 'Forms, lead magnets, emails, tracking pixels, image sizes, contact info, analytics and unused plugins.',
            ],
            [
                'cadence' => 'Monthly',
                'title' => 'SEO check',
                'color' => '#ff9a6c',
                'weeks' => [3 => 'SEO check'],
                'text' => 'On-page audit, sitemaps, internal and external links, redirects, titles, descriptions and alt tags.',
            ],
            [
                'cadence' => '5 per month',
                'title' => 'Website changes',
                'color' => '#b9a6ff',
                'weeks' => [1 => 'Any time', 2 => 'Any time', 3 => 'Any time', 4 => 'Any time'],
                'text' => 'Five customizations included every month, requested whenever you need them: content, images or a section tweak.',
            ],
            [
                'cadence' => 'Monthly',
                'title' => 'Checklist shared',
                'color' => '#ff4d2e',
                'weeks' => [4 => 'Shared in Notion'],
                'text' => 'The full ticked-off checklist, shared with you in Notion.',
            ],
        ];
    }

    /**
     * The schedule regrouped per week for the mobile calendar.
     *
     * @param  array<int, array{cadence: string, title: string, color: string, weeks: array<int, string>, text: string}>  $schedule
     * @return array<int, array<int, array{title: string, cadence: string, color: string}>>
     */
    protected function weeks(array $schedule): array
    {
        $weeks = [];

        foreach (range(1, 4) as $week) {
            $weeks[$week] = array_values(array_filter(
                $schedule,
                fn (array $row) => isset($row['weeks'][$week])
            ));
        }

        return $weeks;
    }

    /**
     * Frequently asked questions.
     *
     * @return array<int, array{question: string, answer: string}>
     */
    protected function faqs(int $total, string $price): array
    {
        return [
            [
                'question' => 'How will I know what was actually done?',
                'answer' => 'Every month you get the full ' . $total . '-point checklist in Notion, with each item ticked off as it is completed. You can open it at any time and see exactly what was checked and when.',
            ],
            [
                'question' => 'What do I get for $' . $price . ' a month?',
                'answer' => 'A Zoom call every week, five website changes a month, and the full checklist: backups, safe WordPress and plugin updates, security and bot log checks, uptime reports, speed and device checks, broken link and 404 checks every two weeks, plus monthly form, lead magnet, email, analytics and SEO checks.',
            ],
            [
                'question' => 'What counts as a website change?',
                'answer' => 'Small customizations like updating text or prices, swapping images, adding a team member or adjusting a section. Five are included every month. New pages, features or redesigns are quoted separately.',
            ],
            [
                'question' => 'What happens in the weekly Zoom call?',
                'answer' => 'We go through what was checked and fixed that week, anything I spotted, your website changes, and what is planned next.',
            ],
            [
                'question' => 'Do you need access to my hosting?',
                'answer' => 'I need WordPress admin access at minimum, plus hosting access if backups and uptime monitoring need to live on the server instead of in a plugin.',
            ],
            [
                'question' => 'What if my site breaks or gets hacked?',
                'answer' => 'I restore it from the latest clean backup and find what caused it. If the fix is bigger than routine care, I tell you first and quote it before doing anything.',
            ],
            [
                'question' => 'What is not included?',
                'answer' => 'Redesigns, new pages or features, content writing and SEO campaigns. Those are quoted separately, so your monthly rate never creeps up.',
            ],
            [
                'question' => 'How does the $49 first month work?',
                'answer' => 'Your first month is $49 and includes everything: the full checklist, weekly Zoom calls and five website changes. After that it renews at $' . $price . ' a month. Cancel before the renewal date and you will not be charged again.',
            ],
            [
                'question' => 'Can I cancel?',
                'answer' => 'Yes. It is billed monthly with no long-term contract. Cancel any time and you keep all your backups and access.',
            ],
        ];
    }

    /**
     * FAQPage JSON-LD data.
     *
     * @param  array<int, array{question: string, answer: string}>  $faqs
     */
    protected function faqSchema(array $faqs): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn (array $faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ], $faqs),
        ];
    }
}
