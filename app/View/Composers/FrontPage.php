<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use function App\image;
use function App\social_icon;
use function App\social_links;

class FrontPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page',
        'home.*',
    ];

    /**
     * Data is built once per request and shared by every home partial.
     */
    protected static ?array $shared = null;

    /**
     * Data to be passed to the views.
     *
     * @return array
     */
    public function with()
    {
        return static::$shared ??= $this->build();
    }

    /**
     * Everything the homepage sections need.
     */
    protected function build(): array
    {
        $work = $this->work();
        $faqs = $this->faqs();
        $aiQuery = rawurlencode($this->aiPrompt());

        return [
            'heroCards' => $this->heroCards(),
            'clients' => $this->clients(),
            'challenges' => $this->challenges(),
            'solutions' => $this->solutions(),
            'work' => $work,
            'workMoreCount' => count($work) - 4,
            'askChatGptUrl' => 'https://chatgpt.com/?q='.$aiQuery,
            'askClaudeUrl' => 'https://claude.ai/new?q='.$aiQuery,
            'aboutPhoto' => get_theme_mod('aws_about_photo', image('ashish-about.jpg')),
            'stack' => $this->stack(),
            'stats' => $this->stats(),
            'statYears' => $this->statYears(),
            'clockTicks' => $this->clockTicks(),
            'processDays' => $this->processDays(),
            'processSteps' => $this->processSteps(),
            'testimonials' => $this->testimonials(),
            'reviewsUrl' => 'https://www.fiverr.com/felicitysmoak',
            'faqs' => $faqs,
            'faqSchema' => $this->faqSchema($faqs),
            'recentPosts' => $this->recentPosts(),
            'socials' => $this->socials(),
            'contactForm' => '[forminator_form id="535"]',
            'icons' => $this->icons(),
        ];
    }

    /**
     * URL of a project screenshot: work/{slug}-card{suffix}.webp, slug = sanitize_title(name).
     */
    protected function shot(string $name, string $suffix = ''): string
    {
        return image('work/'.sanitize_title($name).'-card'.$suffix.'.webp');
    }

    /**
     * Client names in the trust marquee.
     *
     * @return array<int, string>
     */
    protected function clients(): array
    {
        return [
            'SCARTERS',
            'Nuclia',
            'Embassy Capital',
            'Herbishh',
            'Chroma Audio',
            'Odysea Rentals',
            'Grumpi',
            'SalesStar',
            'Sayulita Life',
            "Carolynn's Kitchen",
            'DotterWebStudio',
        ];
    }

    /**
     * Featured projects for the hero.
     *
     * @return array<int, array{name: string, type: string, domain: string, url: string}>
     */
    protected function reel(): array
    {
        return [
            ['name' => 'SCARTERS', 'type' => 'Shopify store', 'domain' => 'scarters.com', 'url' => 'https://scarters.com/'],
            ['name' => 'Nuclia', 'type' => 'SaaS website', 'domain' => 'nuclia.com', 'url' => 'https://nuclia.com/'],
            ['name' => 'Embassy Capital', 'type' => 'Finance website', 'domain' => 'embassy-capital.com', 'url' => 'https://embassy-capital.com/'],
            ['name' => 'Grumpi', 'type' => 'Shopify store', 'domain' => 'grumpi.com.au', 'url' => 'https://grumpi.com.au/'],
            ['name' => 'Odysea Rentals', 'type' => 'Travel website', 'domain' => 'odyseaboatrentals.com', 'url' => 'https://odyseaboatrentals.com/'],
        ];
    }

    /**
     * The two reel projects shown as cards under the hero copy.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function heroCards(): array
    {
        return collect($this->reel())
            ->take(2)
            ->values()
            ->map(fn ($item, $index) => $item + [
                'image' => $this->shot($item['name']),
                'image640' => $this->shot($item['name'], '-640'),
                'alt' => $item['name'].' website, '.strtolower($item['type']).' built by Ashish Web Studio',
                'priority' => $index === 0,
            ])
            ->all();
    }

    /**
     * "Challenge" cards: a problem, its description and a before/after illustration.
     *
     * @return array<int, array{title: string, text: string, svg: string}>
     */
    protected function challenges(): array
    {
        return [
            [
                'title' => 'It looks dated next to competitors',
                'text' => 'Visitors judge you in seconds. A tired design quietly tells them you\'re smaller than you are.',
                'svg' => <<<'SVG'
                    <svg class="ill ch-svg" viewBox="0 0 400 220" aria-hidden="true"><rect x="40" y="12" width="320" height="196" rx="10" fill="#1a1614" stroke="#4d3327"/><line x1="40" y1="32" x2="360" y2="32" stroke="#4d3327"/><circle cx="54" cy="22" r="3.5" fill="#4d3327"/><circle cx="66" cy="22" r="3.5" fill="#4d3327"/><circle cx="78" cy="22" r="3.5" fill="#4d3327"/>
                    <g class="st-bad"><rect class="sc" style="--x:-8px;--y:-6px;--r:-4deg" x="52" y="42" width="296" height="22" fill="#3b3a37"/><text class="i-old sc" style="--x:6px;--y:-10px;--r:3deg" x="200" y="58" text-anchor="middle">WELCOME TO OUR WEBSITE!!!</text><g class="sc" style="--x:-14px;--y:6px;--r:-7deg"><rect x="56" y="74" width="86" height="66" fill="#2e2d2a" stroke="#5b5a55"/><path d="M56 74 L142 140 M142 74 L56 140" stroke="#5b5a55"/></g><g class="sc" style="--x:10px;--y:4px;--r:5deg"><rect x="154" y="78" width="120" height="6" fill="#5b5a55"/><rect x="160" y="92" width="100" height="6" fill="#5b5a55"/><rect x="150" y="106" width="112" height="6" fill="#5b5a55"/><text class="i-link" x="154" y="132">Click here!!</text></g><g class="sc" style="--x:12px;--y:-8px;--r:9deg"><rect x="284" y="76" width="60" height="40" fill="#2e2d2a" stroke="#5b5a55"/><text class="i-old" style="font-size:8px" x="314" y="100" text-anchor="middle">000123</text></g><g class="sc" style="--x:-6px;--y:10px;--r:2deg"><rect x="56" y="154" width="288" height="16" fill="url(#ch-stripe)"/><text class="i-old" style="font-size:9px;fill:#1a1614" x="200" y="166" text-anchor="middle">UNDER CONSTRUCTION</text></g><rect class="sc" style="--x:4px;--y:8px;--r:-3deg" x="90" y="180" width="70" height="16" fill="#3b3a37"/><rect class="sc" style="--x:-4px;--y:8px;--r:4deg" x="240" y="178" width="76" height="18" fill="#3b3a37"/></g>
                    <g class="st-good"><rect class="gd" style="--i:0" x="54" y="44" width="292" height="10" rx="4" fill="#2a211c"/><rect class="gd" style="--i:1" x="54" y="66" width="150" height="14" rx="4" fill="#f2f1ee"/><rect class="gd" style="--i:1" x="54" y="86" width="110" height="14" rx="4" fill="#ff4d2e"/><rect class="gd" style="--i:2" x="54" y="108" width="130" height="6" rx="3" fill="#a3a29b"/><rect class="gd" style="--i:3" x="54" y="124" width="58" height="16" rx="8" fill="#ff4d2e"/><rect class="gd" style="--i:2" x="214" y="62" width="132" height="80" rx="8" fill="url(#ch-grad)"/><circle class="gd" style="--i:3" cx="280" cy="102" r="16" fill="#f2f1ee" fill-opacity=".9"/><rect class="gd" style="--i:4" x="54" y="154" width="90" height="42" rx="6" fill="#2a211c" stroke="#4d3327"/><rect class="gd" style="--i:5" x="155" y="154" width="90" height="42" rx="6" fill="#2a211c" stroke="#4d3327"/><rect class="gd" style="--i:6" x="256" y="154" width="90" height="42" rx="6" fill="#2a211c" stroke="#4d3327"/></g>
                    <defs><pattern id="ch-stripe" width="12" height="12" patternUnits="userSpaceOnUse" patternTransform="rotate(45)"><rect width="6" height="12" fill="#8a7a5a"/><rect x="6" width="6" height="12" fill="#3b3a37"/></pattern><linearGradient id="ch-grad" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#ff9a6c"/><stop offset="1" stop-color="#ff4d2e"/></linearGradient></defs></svg>
                    SVG,
            ],
            [
                'title' => 'It\'s slow and painful to update',
                'text' => 'Every small change needs a developer, so the site simply stops changing.',
                'svg' => <<<'SVG'
                    <svg class="ill ch-svg" viewBox="0 0 400 220" aria-hidden="true"><rect x="30" y="20" width="190" height="150" rx="10" fill="#1a1614" stroke="#4d3327"/><line x1="30" y1="40" x2="220" y2="40" stroke="#4d3327"/><text class="i-mono" x="44" y="33" style="fill:#a3a29b">EDIT PAGE</text><rect x="44" y="54" width="120" height="8" rx="4" fill="#3a2a22"/><rect x="44" y="70" width="160" height="6" rx="3" fill="#2a211c"/><rect x="44" y="82" width="140" height="6" rx="3" fill="#2a211c"/><rect x="44" y="94" width="150" height="6" rx="3" fill="#2a211c"/><g class="ch-lock"><rect x="150" y="112" width="40" height="32" rx="6" fill="#2a211c" stroke="#6a4a3a"/><path class="ch-shackle" d="M158 112 V104 a12 12 0 0 1 24 0 V112" fill="none" stroke="#a3a29b" stroke-width="3.4"/><circle cx="170" cy="126" r="3.5" fill="#a3a29b"/></g><g class="st-bad"><rect x="44" y="112" width="96" height="26" rx="13" fill="#2a211c" stroke="#6a4a3a"/><circle class="ch-spin" cx="60" cy="125" r="6" fill="none" stroke="#ff9a6c" stroke-width="2.4" stroke-dasharray="24 14"/><text class="i-mono" x="73" y="128.5" style="fill:#a3a29b;font-size:7.5px">NEEDS A DEV</text></g><g class="st-good"><rect x="44" y="112" width="96" height="26" rx="13" fill="#ff4d2e"/><path d="M56 125 l4 4 8 -8" fill="none" stroke="#1c1917" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/><text class="i-mono i-mono--ink" x="76" y="129" style="font-size:8.5px">PUBLISHED</text></g>
                    <g transform="translate(290 130)"><path d="M-70 0 A70 70 0 0 1 70 0" fill="none" stroke="#2a211c" stroke-width="14" stroke-linecap="round"/><path d="M-70 0 A70 70 0 0 1 -35 -60.6" fill="none" stroke="#b3472c" stroke-width="14" stroke-linecap="round"/><path d="M35 -60.6 A70 70 0 0 1 70 0" fill="none" stroke="#ff9a6c" stroke-width="14" stroke-linecap="round"/><g class="ch-needle"><line x1="0" y1="0" x2="0" y2="-58" stroke="#f2f1ee" stroke-width="3.5" stroke-linecap="round"/></g><circle r="7" fill="#f2f1ee"/><text class="i-mono st-bad-t" x="0" y="30" text-anchor="middle" style="fill:#b3472c">SLOW</text><text class="i-mono st-good-t" x="0" y="30" text-anchor="middle" style="fill:#ff9a6c">FAST</text></g></svg>
                    SVG,
            ],
            [
                'title' => 'Traffic comes in, leads don\'t',
                'text' => 'No clear story and no clear next step, so people leave without ever getting in touch.',
                'svg' => $this->funnelSvg(),
            ],
            [
                'title' => 'Nobody finds it on Google',
                'text' => 'Weak SEO foundations mean the people searching for what you sell end up on a competitor\'s site.',
                'svg' => <<<'SVG'
                    <svg class="ill ch-svg" viewBox="0 0 400 220" aria-hidden="true"><rect x="40" y="10" width="320" height="30" rx="15" fill="#1a1614" stroke="#6a4a3a"/><circle cx="60" cy="25" r="6" fill="none" stroke="#a3a29b" stroke-width="2"/><path d="M64.5 29.5 L69 34" stroke="#a3a29b" stroke-width="2" stroke-linecap="round"/><text class="i-mono" x="78" y="29" style="fill:#c7c6c1;font-size:9px">WEBSITE DESIGNER NEAR ME</text>
                    <g class="ch-r ch-r1"><rect x="40" y="52" width="320" height="32" rx="7" fill="#1a1614"/><rect x="52" y="60" width="140" height="6" rx="3" fill="#5a5550"/><rect x="52" y="72" width="200" height="4" rx="2" fill="#3a3632"/></g>
                    <g class="ch-r ch-r2"><rect x="40" y="90" width="320" height="32" rx="7" fill="#1a1614"/><rect x="52" y="98" width="120" height="6" rx="3" fill="#5a5550"/><rect x="52" y="110" width="180" height="4" rx="2" fill="#3a3632"/></g>
                    <g class="ch-r ch-r3"><rect x="40" y="128" width="320" height="32" rx="7" fill="#1a1614"/><rect x="52" y="136" width="150" height="6" rx="3" fill="#5a5550"/><rect x="52" y="148" width="190" height="4" rx="2" fill="#3a3632"/></g>
                    <g class="ch-r ch-you"><rect class="ch-you-bg" x="40" y="52" width="320" height="32" rx="7"/><rect x="52" y="60" width="120" height="6" rx="3" fill="#f2f1ee"/><rect x="52" y="72" width="170" height="4" rx="2" fill="#a3a29b"/><rect x="300" y="60" width="48" height="16" rx="8" fill="#ff4d2e"/><text class="i-mono i-mono--ink" x="324" y="71" text-anchor="middle" style="font-size:8px">YOU</text></g>
                    <text class="i-mono st-bad-t" x="200" y="212" text-anchor="middle" style="fill:#b3472c">PAGE 3, NOBODY SCROLLS THIS FAR</text><text class="i-mono st-good-t" x="200" y="212" text-anchor="middle" style="fill:#ff9a6c">TOP RESULT FOR WHAT YOU SELL</text></svg>
                    SVG,
            ],
        ];
    }

    /**
     * Funnel illustration with generated "visitor" dots (leaking vs flowing).
     */
    protected function funnelSvg(): string
    {
        $leak = '';
        $flow = '';

        for ($k = 0; $k < 8; $k++) {
            $x = 180 + ($k % 4) * 13;
            $dx = ($k % 2 ? 1 : -1) * (60 + ($k % 3) * 18);
            $leak .= '<circle class="ch-dot ch-leak" cx="'.$x.'" cy="30" r="4.5" style="--dx:'.$dx.'px;--t:'.($k * 0.35).'s"/>';
            $flow .= '<circle class="ch-dot ch-flow" cx="'.(186 + ($k % 4) * 9).'" cy="30" r="4.5" style="--t:'.($k * 0.35).'s"/>';
        }

        return '<svg class="ill ch-svg" viewBox="0 0 400 220" aria-hidden="true"><text class="i-mono" x="200" y="18" text-anchor="middle" style="fill:#a3a29b">VISITORS</text>'
            .$leak.$flow
            .'<path d="M110 44 H290 L226 122 V168 H174 V122 Z" fill="#2a211c" fill-opacity=".85" stroke="#6a4a3a" stroke-width="1.6"/><path d="M126 58 H274" stroke="#4d3327"/><path d="M146 82 H254" stroke="#4d3327"/><g class="st-bad"><path d="M140 72 l-8 6 6 4 -8 6" fill="none" stroke="#b3472c" stroke-width="2.4"/><path d="M262 76 l8 6 -6 4 8 6" fill="none" stroke="#b3472c" stroke-width="2.4"/><path d="M180 150 l-6 5 5 4" fill="none" stroke="#b3472c" stroke-width="2"/></g><g class="st-good"><rect x="126" y="70" width="20" height="10" rx="3" fill="#ff4d2e" transform="rotate(-40 136 75)"/><rect x="254" y="74" width="20" height="10" rx="3" fill="#ff4d2e" transform="rotate(40 264 79)"/></g><rect x="150" y="176" width="100" height="30" rx="8" fill="#1a1614" stroke="#6a4a3a"/><g class="st-bad"><text class="i-mono" x="200" y="195" text-anchor="middle" style="fill:#a3a29b">NO LEADS</text></g><g class="st-good"><rect x="150" y="176" width="100" height="30" rx="8" fill="#ff4d2e" class="ch-glow"/><text class="i-mono i-mono--ink" x="200" y="195" text-anchor="middle">NEW LEADS</text></g><text class="i-mono st-bad-t" x="66" y="120" style="fill:#b3472c">LEAVING</text><text class="i-mono st-bad-t" x="300" y="120" style="fill:#b3472c">LEAVING</text></svg>';
    }

    /**
     * "Solution" service cards.
     *
     * @return array<int, array{label: string, title: string, text: string, svg: string}>
     */
    protected function solutions(): array
    {
        $illustrations = $this->illustrations();

        return collect([
            ['label' => 'Branding', 'title' => 'Stand out with a brand people remember', 'text' => 'Logo, colors and type turned into a clear visual identity that looks consistent on your site and everywhere else your business shows up.', 'illustration' => 'brand'],
            ['label' => 'Web design', 'title' => 'Design journeys that turn visitors into leads', 'text' => 'A website isn\'t a brochure. Every page is planned around what your buyers need to see, removing friction on the way to your key calls to action.', 'illustration' => 'design'],
            ['label' => 'Web development', 'title' => 'Built fast, easy to maintain', 'text' => 'WordPress, Shopify, Webflow or Next.js, built for speed and set up so your team can update content confidently without calling a developer.', 'illustration' => 'dev'],
            ['label' => 'Marketing', 'title' => 'Launched to be found, built to grow', 'text' => 'SEO foundations, analytics and conversion tracking from day one, so your site keeps bringing in qualified leads after launch.', 'illustration' => 'mkt'],
        ])->map(fn ($item) => $item + ['svg' => $illustrations[$item['illustration']]])->all();
    }

    /**
     * Animated isometric illustrations for the service cards.
     *
     * @return array<string, string>
     */
    protected function illustrations(): array
    {
        return [
            'brand' => <<<'SVG'
                <svg class="ill" viewBox="0 0 400 260" aria-hidden="true"><defs><linearGradient id="il-b1" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#ffb896"/><stop offset="1" stop-color="#ff4d2e"/></linearGradient></defs>
                <g class="ill-base"><path fill="#3a2a22" d="M200 150 L300 196 L200 242 L100 196 Z"/><path fill="#1f1916" d="M100 196 L200 242 L200 256 L100 210 Z"/><path fill="#2a211c" d="M200 242 L300 196 L300 210 L200 256 Z"/><path fill="none" stroke="#6a4a3a" stroke-dasharray="3 5" d="M140 196 L200 224 L260 196 L200 168 Z"/></g>
                <g class="ill-draw"><path fill="none" stroke="#f2f1ee" stroke-opacity=".55" stroke-width="1.4" d="M88 118 Q200 8 312 118"/><line x1="150" y1="64" x2="250" y2="64" stroke="#f2f1ee" stroke-opacity=".45"/><rect x="85" y="115" width="7" height="7" fill="#f2f1ee"/><rect x="308" y="115" width="7" height="7" fill="#f2f1ee"/><circle cx="150" cy="64" r="3.5" fill="#f2f1ee"/><circle cx="250" cy="64" r="3.5" fill="#f2f1ee"/><rect x="196" y="60" width="8" height="8" fill="#ff4d2e"/></g>
                <g class="ill-float" style="--d:0s"><path fill="url(#il-b1)" d="M200 72 L238 130 L221 188 L179 188 L162 130 Z"/><path fill="#7a2414" fill-opacity=".35" d="M200 72 L200 188 L179 188 L162 130 Z"/><line x1="200" y1="80" x2="200" y2="140" stroke="#1c1917" stroke-width="3"/><circle cx="200" cy="147" r="8" fill="#1c1917"/><rect x="176" y="188" width="48" height="14" rx="3" fill="#5a3a2c"/></g>
                <g class="ill-float" style="--d:.7s"><g transform="translate(290 124) skewY(-10)"><rect width="60" height="52" rx="9" fill="#2a211c" stroke="#6a4a3a"/><text x="30" y="35" text-anchor="middle" class="i-txt">Aa</text></g></g>
                <g class="ill-float" style="--d:1.2s"><g transform="translate(48 132) skewY(10)"><rect width="66" height="46" rx="9" fill="#2a211c" stroke="#6a4a3a"/><rect x="9" y="10" width="14" height="26" rx="3" fill="#ff4d2e"/><rect x="26" y="10" width="14" height="26" rx="3" fill="#ff9a6c"/><rect x="43" y="10" width="14" height="26" rx="3" fill="#f2f1ee"/></g></g>
                <g class="ill-float" style="--d:.3s"><g transform="translate(122 74) rotate(-12)"><rect width="28" height="28" rx="7" fill="#ff9a6c"/><path d="M8 20 L18 10 M16 7 L21 12" stroke="#1c1917" stroke-width="2.6" stroke-linecap="round"/></g></g>
                <g class="ill-float" style="--d:.9s"><g transform="translate(262 66) rotate(12)"><rect width="26" height="30" rx="5" fill="#ff4d2e"/><rect x="6" y="7" width="14" height="3" rx="1.5" fill="#1c1917"/><rect x="6" y="13" width="10" height="3" rx="1.5" fill="#1c1917"/></g></g>
                <g class="ill-float" style="--d:1.5s"><g transform="translate(92 206) rotate(-8)"><rect width="32" height="32" rx="7" fill="#ff4d2e"/><path d="M9 24 L23 10 M22 6 L22 9 M26 10 L23 10 M18 8 L19 9" stroke="#f2f1ee" stroke-width="2.2" stroke-linecap="round"/></g></g>
                <g class="ill-float" style="--d:.5s"><g transform="translate(256 214)"><rect width="44" height="18" rx="4" fill="#1c1917" stroke="#a3a29b"/><text x="22" y="13" text-anchor="middle" class="i-mono">WIP</text></g></g>
                <rect x="70" y="96" width="10" height="7" rx="2" fill="none" stroke="#a3a29b"/><rect x="330" y="196" width="10" height="7" rx="2" fill="none" stroke="#a3a29b"/><rect x="238" y="30" width="8" height="6" rx="2" fill="none" stroke="#a3a29b"/></svg>
                SVG,
            'design' => <<<'SVG'
                <svg class="ill" viewBox="0 0 400 260" aria-hidden="true">
                <g class="ill-float" style="--d:1s"><g transform="matrix(0.866 0.5 -0.866 0.5 212 104)"><rect width="150" height="130" rx="8" fill="#1f1916" stroke="#3a2a22"/><rect x="12" y="14" width="80" height="8" rx="4" fill="#2f241e"/><rect x="12" y="30" width="120" height="8" rx="4" fill="#2f241e"/></g></g>
                <g class="ill-float" style="--d:.5s"><g transform="matrix(0.866 0.5 -0.866 0.5 212 74)"><rect width="150" height="130" rx="8" fill="#2a211c" stroke="#4d3327"/><rect x="12" y="90" width="126" height="26" rx="5" fill="#3a2a22"/></g></g>
                <g class="ill-float" style="--d:0s"><g transform="matrix(0.866 0.5 -0.866 0.5 212 42)"><rect width="150" height="130" rx="8" fill="#3a2a22" stroke="#7a5442"/><rect x="10" y="10" width="130" height="10" rx="4" fill="#5a3a2c"/><rect x="10" y="28" width="64" height="42" rx="5" fill="#ff9a6c" fill-opacity=".85"/><rect x="82" y="30" width="56" height="6" rx="3" fill="#f2f1ee" fill-opacity=".8"/><rect x="82" y="42" width="44" height="6" rx="3" fill="#f2f1ee" fill-opacity=".45"/><rect x="82" y="56" width="30" height="10" rx="5" fill="#ff4d2e"/><rect x="10" y="80" width="40" height="36" rx="5" fill="#4d3327"/><rect x="55" y="80" width="40" height="36" rx="5" fill="#f2f1ee"/><circle cx="75" cy="98" r="10" fill="none" stroke="#3a2a22" stroke-width="2"/><path d="M65 98 H85 M75 88 C69 94 69 102 75 108 C81 102 81 94 75 88" fill="none" stroke="#3a2a22" stroke-width="1.6"/><rect x="100" y="80" width="40" height="36" rx="5" fill="#4d3327"/><g class="ill-sel"><rect x="51" y="76" width="48" height="44" fill="none" stroke="#ff4d2e" stroke-width="1.6"/><rect x="48" y="73" width="6" height="6" fill="#f2f1ee"/><rect x="96" y="73" width="6" height="6" fill="#f2f1ee"/><rect x="48" y="117" width="6" height="6" fill="#f2f1ee"/><rect x="96" y="117" width="6" height="6" fill="#f2f1ee"/></g></g></g>
                <g class="ill-cursor"><path d="M0 0 L0 22 L6 16 L11 26 L15 24 L10 14 L18 14 Z" fill="#ff4d2e" stroke="#1c1917" stroke-width="1.2"/></g>
                <g class="ill-float" style="--d:.8s"><g transform="translate(70 40) rotate(-6)"><rect width="52" height="40" rx="6" fill="#f2f1ee"/><rect x="5" y="5" width="42" height="22" rx="3" fill="#ff9a6c"/><circle cx="15" cy="13" r="4" fill="#f2f1ee"/><path d="M5 27 L20 17 L30 24 L37 19 L47 27 Z" fill="#ff4d2e"/><rect x="5" y="31" width="26" height="4" rx="2" fill="#a3a29b"/></g></g>
                <g class="ill-float" style="--d:1.3s"><g transform="translate(134 22)"><rect width="40" height="14" rx="4" fill="#ff4d2e"/><circle cx="9" cy="7" r="2" fill="#f2f1ee"/><circle cx="16" cy="7" r="2" fill="#f2f1ee"/><circle cx="23" cy="7" r="2" fill="#f2f1ee"/></g></g>
                <g class="ill-float" style="--d:.2s"><g transform="translate(52 176) rotate(4)"><rect width="70" height="44" rx="7" fill="#2a211c" stroke="#6a4a3a"/><text x="10" y="24" class="i-q">&#8220;</text><rect x="26" y="14" width="34" height="5" rx="2.5" fill="#f2f1ee" fill-opacity=".7"/><rect x="26" y="24" width="26" height="5" rx="2.5" fill="#f2f1ee" fill-opacity=".4"/></g></g>
                <g class="ill-float" style="--d:1.6s"><g transform="translate(236 226)"><rect width="110" height="20" rx="10" fill="#1c1917" stroke="#4d3327"/><circle cx="14" cy="10" r="3" fill="#ff4d2e"/><rect x="24" y="8" width="20" height="4" rx="2" fill="#a3a29b"/><rect x="50" y="8" width="20" height="4" rx="2" fill="#a3a29b"/><rect x="76" y="8" width="24" height="4" rx="2" fill="#a3a29b"/></g></g>
                <path d="M40 70 V110 M34 70 H46 M34 110 H46" stroke="#a3a29b" stroke-width="1.2"/></svg>
                SVG,
            'dev' => <<<'SVG'
                <svg class="ill" viewBox="0 0 400 260" aria-hidden="true">
                <g class="ill-float" style="--d:0s"><g transform="translate(112 34) skewY(-5)"><rect width="200" height="132" rx="10" fill="#2a211c" stroke="#6a4a3a"/><rect x="8" y="8" width="184" height="108" rx="5" fill="#161412"/><rect x="14" y="14" width="30" height="96" rx="4" fill="#2a211c"/><rect x="20" y="22" width="18" height="4" rx="2" fill="#ff4d2e"/><rect x="20" y="32" width="18" height="4" rx="2" fill="#5a3a2c"/><rect x="20" y="42" width="18" height="4" rx="2" fill="#5a3a2c"/><rect x="50" y="14" width="136" height="10" rx="4" fill="#2a211c"/><rect x="50" y="30" width="82" height="44" rx="5" fill="#2f241e"/><path class="ill-line" pathLength="100" d="M56 66 L70 58 L84 62 L98 48 L112 50 L126 38" fill="none" stroke="#ff9a6c" stroke-width="2"/><rect x="138" y="30" width="48" height="44" rx="5" fill="#ff4d2e"/><rect x="144" y="38" width="26" height="4" rx="2" fill="#1c1917"/><rect x="144" y="48" width="34" height="8" rx="2" fill="#f2f1ee"/><g class="ill-bars"><rect style="--i:0" x="52" y="92" width="12" height="16" rx="2" fill="#4d3327"/><rect style="--i:1" x="68" y="86" width="12" height="22" rx="2" fill="#4d3327"/><rect style="--i:2" x="84" y="90" width="12" height="18" rx="2" fill="#4d3327"/><rect style="--i:3" x="100" y="82" width="12" height="26" rx="2" fill="#4d3327"/><rect style="--i:4" x="116" y="80" width="12" height="28" rx="2" fill="#ff9a6c"/></g><rect x="138" y="80" width="48" height="28" rx="5" fill="#2f241e"/><rect x="144" y="88" width="36" height="4" rx="2" fill="#5a3a2c"/><rect x="144" y="96" width="24" height="4" rx="2" fill="#5a3a2c"/><path d="M84 132 L116 132 L122 152 L78 152 Z" fill="#3a2a22"/><rect x="56" y="152" width="88" height="9" rx="4" fill="#4d3327"/></g></g>
                <g class="ill-float" style="--d:.6s"><g transform="translate(84 44) rotate(-8)"><rect width="46" height="24" rx="5" fill="#ff4d2e"/><text x="23" y="16" text-anchor="middle" class="i-mono i-mono--ink">CMS</text></g></g>
                <g class="ill-float" style="--d:1.1s"><g transform="translate(78 118) rotate(6)"><rect width="36" height="30" rx="6" fill="#ff9a6c"/><text x="18" y="20" text-anchor="middle" class="i-mono i-mono--ink">&lt;/&gt;</text></g></g>
                <g class="ill-float" style="--d:.3s"><g transform="translate(34 168) skewY(6)"><rect width="104" height="62" rx="7" fill="#161412" stroke="#6a4a3a"/><circle cx="10" cy="9" r="2.5" fill="#ff4d2e"/><circle cx="18" cy="9" r="2.5" fill="#5a3a2c"/><rect x="10" y="20" width="30" height="4" rx="2" fill="#ff4d2e"/><rect x="44" y="20" width="40" height="4" rx="2" fill="#ff9a6c"/><rect x="18" y="30" width="52" height="4" rx="2" fill="#f2f1ee" fill-opacity=".6"/><rect x="18" y="40" width="38" height="4" rx="2" fill="#a3a29b"/><rect x="10" y="50" width="22" height="4" rx="2" fill="#ff4d2e"/></g></g>
                <g class="ill-float" style="--d:.9s"><g transform="translate(318 34)"><rect width="44" height="44" rx="9" fill="#2a211c" stroke="#6a4a3a"/><g class="ill-gear"><circle cx="22" cy="22" r="10" fill="none" stroke="#f2f1ee" stroke-width="6" stroke-dasharray="4 3.85"/><circle cx="22" cy="22" r="7" fill="#f2f1ee"/><circle cx="22" cy="22" r="3" fill="#2a211c"/></g></g></g>
                <g class="ill-float" style="--d:1.4s"><g transform="translate(300 158)"><rect width="78" height="50" rx="7" fill="#ff4d2e"/><circle cx="18" cy="25" r="10" fill="none" stroke="#f2f1ee" stroke-width="2"/><path d="M8 25 H28 M18 15 C13 20 13 30 18 35 C23 30 23 20 18 15" fill="none" stroke="#f2f1ee" stroke-width="1.5"/><rect x="36" y="17" width="32" height="4" rx="2" fill="#f2f1ee"/><rect x="36" y="27" width="24" height="4" rx="2" fill="#f2f1ee" fill-opacity=".6"/></g></g>
                <g class="ill-float" style="--d:.4s"><g transform="translate(252 124)"><rect width="84" height="14" rx="7" fill="#1c1917" stroke="#6a4a3a"/><rect class="ill-load" x="3" y="3" width="78" height="8" rx="4" fill="#ff9a6c"/></g></g>
                <g class="ill-float" style="--d:1.8s"><g transform="translate(176 204) rotate(-10)"><rect width="30" height="30" rx="6" fill="#ff9a6c"/><path d="M9 21 L19 11 M17 8 A5 5 0 1 0 22 13" fill="none" stroke="#1c1917" stroke-width="2.4" stroke-linecap="round"/></g></g>
                <rect x="150" y="18" width="10" height="7" rx="2" fill="none" stroke="#a3a29b"/><rect x="364" y="120" width="10" height="7" rx="2" fill="none" stroke="#a3a29b"/></svg>
                SVG,
            'mkt' => <<<'SVG'
                <svg class="ill" viewBox="0 0 400 260" aria-hidden="true"><defs><linearGradient id="il-m1" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#ffb896"/><stop offset="1" stop-color="#ff4d2e"/></linearGradient></defs>
                <g class="ill-base"><path fill="#3a2a22" d="M200 150 L316 204 L200 258 L84 204 Z"/><path fill="none" stroke="#6a4a3a" stroke-dasharray="3 5" d="M120 204 L200 241 L280 204 L200 167 Z"/></g>
                <g class="ill-bars3">
                <g class="ib" style="--i:0"><path fill="#5a3a2c" d="M120 150 L138 159 L120 168 L102 159 Z"/><path fill="#2a211c" d="M102 159 L120 168 L120 210 L102 201 Z"/><path fill="#3a2a22" d="M120 168 L138 159 L138 201 L120 210 Z"/></g>
                <g class="ib" style="--i:1"><path fill="#7a4a36" d="M162 118 L180 127 L162 136 L144 127 Z"/><path fill="#2a211c" d="M144 127 L162 136 L162 222 L144 213 Z"/><path fill="#3a2a22" d="M162 136 L180 127 L180 213 L162 222 Z"/></g>
                <g class="ib" style="--i:2"><path fill="#ff9a6c" d="M204 88 L222 97 L204 106 L186 97 Z"/><path fill="#8a3a24" d="M186 97 L204 106 L204 226 L186 217 Z"/><path fill="#b3472c" d="M204 106 L222 97 L222 217 L204 226 Z"/></g>
                <g class="ib" style="--i:3"><path fill="url(#il-m1)" d="M246 56 L264 65 L246 74 L228 65 Z"/><path fill="#c43a22" d="M228 65 L246 74 L246 214 L228 205 Z"/><path fill="#ff4d2e" d="M246 74 L264 65 L264 205 L246 214 Z"/></g>
                </g>
                <path class="ill-line" pathLength="100" d="M96 136 L140 104 L182 88 L222 58 L272 28" fill="none" stroke="#f2f1ee" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/><path class="ill-arrow" d="M262 24 L276 26 L270 38" fill="none" stroke="#f2f1ee" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <g class="ill-float" style="--d:.4s"><g transform="translate(298 92) rotate(8)"><rect width="58" height="50" rx="9" fill="#2a211c" stroke="#6a4a3a"/><circle cx="25" cy="22" r="10" fill="none" stroke="#f2f1ee" stroke-width="3"/><path d="M32 29 L42 39" stroke="#f2f1ee" stroke-width="3.4" stroke-linecap="round"/><text x="25" y="26" text-anchor="middle" class="i-mono" style="font-size:7px">SEO</text></g></g>
                <g class="ill-float" style="--d:1s"><g transform="translate(46 70) rotate(-8)"><rect width="50" height="50" rx="9" fill="#ff4d2e"/><circle cx="25" cy="25" r="15" fill="none" stroke="#f2f1ee" stroke-width="2.4"/><circle cx="25" cy="25" r="8" fill="none" stroke="#f2f1ee" stroke-width="2.4"/><circle cx="25" cy="25" r="2.6" fill="#f2f1ee"/></g></g>
                <g class="ill-float" style="--d:1.5s"><g transform="translate(40 196)"><rect width="48" height="48" rx="9" fill="#2a211c" stroke="#6a4a3a"/><circle cx="24" cy="24" r="13" fill="none" stroke="#4d3327" stroke-width="7"/><circle class="ill-pie" cx="24" cy="24" r="13" fill="none" stroke="#ff9a6c" stroke-width="7" pathLength="100" stroke-dasharray="100" transform="rotate(-90 24 24)"/></g></g>
                <g class="ill-float" style="--d:.8s"><g transform="translate(300 196)"><rect width="70" height="22" rx="11" fill="#1c1917" stroke="#a3a29b"/><circle cx="13" cy="11" r="3.4" fill="#3ddc84"/><text x="42" y="15" text-anchor="middle" class="i-mono">LEADS</text></g></g>
                <rect x="330" y="60" width="10" height="7" rx="2" fill="none" stroke="#a3a29b"/><rect x="120" y="40" width="8" height="6" rx="2" fill="none" stroke="#a3a29b"/></svg>
                SVG,
        ];
    }

    /**
     * Portfolio grid. Items after the fourth are hidden behind "View more projects".
     *
     * @return array<int, array<string, mixed>>
     */
    protected function work(): array
    {
        return collect([
            ['name' => 'SCARTERS', 'category' => 'Shopify', 'text' => 'Shopify storefront build and theme customization.', 'url' => 'https://scarters.com/'],
            ['name' => 'Nuclia', 'category' => 'SaaS / WordPress', 'text' => 'Marketing site for an AI search platform.', 'url' => 'https://nuclia.com/'],
            ['name' => 'Embassy Capital', 'category' => 'Finance / WordPress', 'text' => 'Corporate website for an investment firm.', 'url' => 'https://embassy-capital.com/'],
            ['name' => 'Herbishh', 'category' => 'Beauty / Shopify', 'text' => 'Beauty and wellness store built for mobile shoppers.', 'url' => 'https://herbishh.in/'],
            ['name' => 'Chroma Audio', 'category' => 'Audio / Shopify', 'text' => 'Product-led storefront for audio gear.', 'url' => 'https://getchromaaudio.com/'],
            ['name' => 'Odysea Rentals', 'category' => 'Travel / WordPress', 'text' => 'Boat rental website built around bookings.', 'url' => 'https://odyseaboatrentals.com/'],
            ['name' => 'Grumpi', 'category' => 'Furniture / Shopify', 'text' => 'Furniture storefront for the Australian market.', 'url' => 'https://grumpi.com.au/'],
            ['name' => 'SalesStar', 'category' => 'SaaS / WordPress', 'text' => 'Marketing website for a sales training company.', 'url' => 'https://salesstar.com/'],
        ])->map(fn ($item, $index) => $item + [
            'image' => $this->shot($item['name']),
            'image640' => $this->shot($item['name'], '-640'),
            'alt' => $item['name'].' website homepage, '.strtolower(str_replace(' / ', ' ', $item['category'])).' project',
            'more' => $index > 3,
        ])->all();
    }

    /**
     * Prompt pre-filled in ChatGPT / Claude from the "right fit" band.
     */
    protected function aiPrompt(): string
    {
        return "I'm considering hiring Ashish Web Studio (ashishwebstudio.com), a web design and development consultant based in India who works with clients worldwide. Look at the website and explain what they offer, how they work, and whether they're a good fit for a business like mine.";
    }

    /**
     * "Tools I reach for": platform name plus its inline brand icon.
     *
     * @return array<int, array{name: string, icon: string}>
     */
    protected function stack(): array
    {
        return collect([
            'wordpress' => 'WordPress',
            'shopify' => 'Shopify',
            'webflow' => 'Webflow',
            'framer' => 'Framer',
            'wix' => 'Wix',
            'squarespace' => 'Squarespace',
            'nextdotjs' => 'Next.js',
        ])->map(fn ($name, $slug) => [
            'name' => $name,
            'icon' => $this->stackIcon($slug, $name),
        ])->values()->all();
    }

    /**
     * Inline an icon SVG from resources/images, sized and labelled (empty when the file is missing).
     */
    protected function stackIcon(string $slug, string $name): string
    {
        $file = get_theme_file_path('resources/images/icon-'.$slug.'.svg');

        if (! file_exists($file)) {
            return '';
        }

        return str_replace(
            '<svg ',
            '<svg width="18" height="18" role="img" aria-label="'.esc_attr($name).' logo" ',
            preg_replace('/<title>.*?<\/title>/', '', file_get_contents($file))
        );
    }

    /**
     * Headline numbers. `viz` picks the animated visual, `count` enables the count-up.
     *
     * @return array<int, array{viz: string, value: string, suffix: string, label: string, count: bool}>
     */
    protected function stats(): array
    {
        return [
            ['viz' => 'grid', 'value' => '700', 'suffix' => '+', 'label' => 'projects shipped for clients worldwide', 'count' => true],
            ['viz' => 'years', 'value' => '8', 'suffix' => 'yrs', 'label' => 'building websites for businesses worldwide', 'count' => true],
            ['viz' => 'ring', 'value' => '100', 'suffix' => '%', 'label' => 'on-time delivery', 'count' => true],
            ['viz' => 'clock', 'value' => '1', 'suffix' => 'day', 'label' => 'typical reply time to new enquiries', 'count' => false],
        ];
    }

    /**
     * Year range under the "8 yrs" visual.
     *
     * @return array{from: int, to: string}
     */
    protected function statYears(): array
    {
        return [
            'from' => (int) date_i18n('Y') - 8,
            'to' => date_i18n('Y'),
        ];
    }

    /**
     * 24 tick marks around the clock visual.
     *
     * @return array<int, array{x1: float, y1: float, x2: float, y2: float}>
     */
    protected function clockTicks(): array
    {
        $ticks = [];

        for ($i = 0; $i < 24; $i++) {
            $angle = deg2rad($i * 15 - 90);

            $ticks[] = [
                'x1' => round(32 + 22 * cos($angle), 2),
                'y1' => round(32 + 22 * sin($angle), 2),
                'x2' => round(32 + 28 * cos($angle), 2),
                'y2' => round(32 + 28 * sin($angle), 2),
            ];
        }

        return $ticks;
    }

    /**
     * Days on the sprint calendar ruler.
     *
     * @return array<int, array{day: int, label: string}>
     */
    protected function processDays(): array
    {
        return array_map(fn ($day) => [
            'day' => $day,
            'label' => str_pad($day, 2, '0', STR_PAD_LEFT),
        ], range(1, 14));
    }

    /**
     * Sprint calendar rows: day range, copy, bar colour and position (left / width).
     *
     * @return array<int, array<string, mixed>>
     */
    protected function processSteps(): array
    {
        return [
            [
                'from' => 1,
                'to' => 2,
                'label' => 'Discover',
                'title' => 'Kickoff & site audit',
                'text' => 'A call to understand your business and goals, plus a quick audit of your current site.',
                'color' => '#f2f1ee',
                'left' => '0%',
                'width' => '28%',
                'icon' => '<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6.5"/><path d="M16 16l4.5 4.5"/></svg>',
            ],
            [
                'from' => 2,
                'to' => 3,
                'label' => 'Plan',
                'title' => 'Sitemap & scope',
                'text' => 'Sitemap, content outline, platform choice and a clear quote based on your requirements.',
                'color' => '#ffc24b',
                'left' => '7.14%',
                'width' => '30%',
                'icon' => '<svg viewBox="0 0 24 24"><rect x="4" y="3.5" width="16" height="17" rx="2"/><path d="M8 8.5h8M8 12h8M8 15.5h5"/></svg>',
            ],
            [
                'from' => 3,
                'to' => 7,
                'label' => 'Design',
                'title' => 'Clickable design preview',
                'text' => 'Page designs in your brand as a clickable preview. You give feedback, I refine it the same day.',
                'color' => '#ff9a6c',
                'left' => '14.28%',
                'width' => '38%',
                'icon' => '<svg viewBox="0 0 24 24"><path d="M4 20l4-1 11-11-3-3L5 16z"/><path d="M14 7l3 3"/></svg>',
            ],
            [
                'from' => 6,
                'to' => 12,
                'label' => 'Build',
                'title' => 'Development on staging',
                'text' => 'Built with AI-native tools on a staging link: fast, mobile ready and easy for you to edit.',
                'color' => '#ff4d2e',
                'left' => '35.71%',
                'width' => '50%',
                'icon' => '<svg viewBox="0 0 24 24"><path d="M8 8l-4 4 4 4M16 8l4 4-4 4M13.5 5l-3 14"/></svg>',
            ],
            [
                'from' => 13,
                'to' => 14,
                'label' => 'Launch',
                'title' => 'Go-live & performance',
                'text' => 'QA, speed and SEO checks, then a careful launch with backups and analytics in place.',
                'color' => '#8fe3a8',
                'left' => '72%',
                'width' => '28%',
                'icon' => '<svg viewBox="0 0 24 24"><path d="M12 3c3 2 5 5.5 5 9.5L15 16H9l-2-3.5C7 8.5 9 5 12 3z"/><circle cx="12" cy="10" r="1.8"/><path d="M9.5 16l-1.5 4 4-2 4 2-1.5-4"/></svg>',
            ],
        ];
    }

    /**
     * Client testimonials ("Wall of love").
     *
     * @return array<int, array{quote: string, name: string, company: string, image: string, big: bool}>
     */
    protected function testimonials(): array
    {
        return [
            [
                'quote' => 'It was a long and complex project, but Ashish successfully achieved all the objectives, always addressing the many requests from the end client without hesitation. He is a serious and highly skilled professional, able to remain calm and clear-headed even during the most challenging phases of the work. What stood out to me most was his strong commitment to the success of the project. I will definitely work with him again. He is someone you can fully trust.',
                'name' => 'Angelo Sangiorgio',
                'company' => 'DotterWebStudio',
                'image' => image('angelo.jpg'),
                'big' => true,
            ],
            [
                'quote' => 'Ashish is the best. We have worked with him on multiple projects. Very knowledgeable and professional.',
                'name' => 'Ian Hodge',
                'company' => 'Sayulita Life Vacation Rentals',
                'image' => image('ian.jpeg'),
                'big' => false,
            ],
            [
                'quote' => 'His work is amazing. He exceeded my expectations, from the time I ordered until the time he finished. I am glad I picked him to work on my website, and I will definitely use him again.',
                'name' => 'J. Carolyn Thompson',
                'company' => "Carolynn's Kitchen",
                'image' => image('carolyn.avif'),
                'big' => false,
            ],
        ];
    }

    /**
     * Frequently asked questions.
     *
     * @return array<int, array{question: string, answer: string}>
     */
    protected function faqs(): array
    {
        return [
            ['question' => 'How much does a project cost?', 'answer' => 'It depends entirely on your requirements. After a short call I understand what you need and send a clear, itemized quote, so you know the cost before any work starts.'],
            ['question' => 'How long does a project take?', 'answer' => 'Most business websites launch in about 14 days from kickoff. Larger stores and web apps are scoped per project, and each one comes with a day-by-day timeline.'],
            ['question' => 'Which platform should I use?', 'answer' => 'The one that fits how your business works. I build on WordPress, Shopify, Webflow, Framer and Next.js, so I recommend based on your needs, not habit.'],
            ['question' => 'Do you work with clients outside India?', 'answer' => 'Yes, most of my clients are abroad. I am based in Ahmedabad and work remotely, with calls scheduled in your time zone.'],
            ['question' => 'Can my team edit the site after launch?', 'answer' => 'Yes. I build so you can update pages and content without a developer, and I walk you through everything at handover.'],
            ['question' => 'What does AI-native development mean for me?', 'answer' => 'I use AI tools to speed up the repetitive parts of building. You get senior-level decisions at a faster pace and a lower cost, and I still review every line myself.'],
            ['question' => 'What happens after launch?', 'answer' => 'You own everything: code, content and accounts. If you want ongoing help, the monthly retainer covers updates, backups, security, SEO and a weekly progress call.'],
        ];
    }

    /**
     * FAQPage structured data (JSON-LD) for the FAQ section.
     *
     * @param  array<int, array{question: string, answer: string}>  $faqs
     */
    protected function faqSchema(array $faqs): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ], $faqs),
        ];
    }

    /**
     * Three latest posts for the "Writing" section.
     *
     * @return array<int, array{url: string, thumbnail: string, kicker: string, title: string}>
     */
    protected function recentPosts(): array
    {
        return array_map(function ($post) {
            $categories = get_the_category($post->ID);

            return [
                'url' => get_permalink($post),
                'thumbnail' => has_post_thumbnail($post)
                    ? get_the_post_thumbnail($post, 'aws-card', ['loading' => 'lazy'])
                    : '',
                'kicker' => ($categories ? strtoupper($categories[0]->name) : 'ARTICLE')
                    .', '.strtoupper(get_the_date('M Y', $post)),
                'title' => get_the_title($post),
            ];
        }, get_posts(['numberposts' => 3]));
    }

    /**
     * Social profiles with their icons for the contact section.
     *
     * @return array<int, array{label: string, url: string, icon: string}>
     */
    protected function socials(): array
    {
        return array_map(fn ($link) => $link + ['icon' => social_icon($link['label'])], social_links());
    }

    /**
     * Generic service icons. Defined in the old template but never rendered; kept for parity.
     *
     * @return array<string, string>
     */
    protected function icons(): array
    {
        return [
            'wp' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 13h8M8 16h5"/></svg>',
            'shop' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M5 8h14l-1.2 11.2a1 1 0 0 1-1 .8H7.2a1 1 0 0 1-1-.8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>',
            'app' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9l-3 3 3 3M16 9l3 3-3 3M13.5 6l-3 12"/></svg>',
            'mob' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="3" width="10" height="18" rx="2.5"/><path d="M11 17.5h2"/></svg>',
            'ai' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M6 6l2 2M16 16l2 2M6 18l2-2M16 8l2-2"/><circle cx="12" cy="12" r="3"/></svg>',
        ];
    }
}
