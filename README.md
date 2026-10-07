# Ashish Web Studio — Sage theme

The ashishwebstudio.com theme, built on [Sage](https://roots.io/sage/) (Blade, Acorn, Vite, Tailwind CSS).

## Requirements

PHP 8.3+, WordPress 6.6+, Composer 2, Node 22.

## Development

```bash
composer install
npm install
npm run dev     # Vite dev server with hot reload
npm run build   # production build into public/build
```

## Structure

```
app/
  helpers.php            URL helpers, reading time, table of contents, social links
  setup.php              theme supports, image sizes, head clean-up
  filters.php            excerpt, avatar alt, redirects
  View/Composers/        data for the views (FrontPage, Retainer, Single, Blog, Navigation, App)
resources/
  views/
    layouts/app.blade.php
    sections/            header, footer
    components/          <x-button>, <x-tag>, <x-link>, <x-section-head>, <x-faq>, <x-post-card>, <x-cta-band>,
                         <x-contact-block>, <x-marquee>, <x-brand>, and rm-* parts of the maintenance page
    home/                homepage sections
    retainer/            WordPress maintenance page sections
    partials/            blog cards, single post parts, comments, CTA band
  css/
    app.css              Tailwind entry and import order
    theme.css            brand tokens (@theme): colours, fonts, radii, spacing, breakpoints, `wrap` utility
    base.css             element defaults on top of Preflight
    components/          only what utilities can't express: keyframes, JS-driven state, SVG illustration
                         internals, and WordPress/plugin-generated markup (post content, comment form, Forminator)
  js/                    app.js (entry), fx.js (GSAP scroll effects), main.js (interactions, hero gradient)
  images/, fonts/
```

## Styling conventions

- Styles are Tailwind utility classes in the Blade views. Reach for a token first (`bg-surface`, `text-muted`,
  `border-line-2`, `font-mono`, `rounded-lg`, `py-sec`, `px-gut`, `ease-spring`), then an arbitrary value.
- Breakpoints are desktop-first: `max-sm:` (≤640px), `max-md:` (≤760px), `max-tab:` (≤900px), `max-lg:` (≤1024px),
  `max-xl:` (≤1100px).
- `hover:` is a plain `:hover` (custom variant in `theme.css`).
- Layer order is theme, base, components, utilities, so a utility always beats `css/components/*.css`.
  `content.css` and `contact-form.css` are deliberately unlayered so they beat block-library and plugin styles.
- Classes such as `aws-btn`, `h-hero`, `h-cal-row` that carry no styles are hooks for `resources/js/fx.js` and
  `main.js`; keep them when editing markup.

## Deployment

Every push to `main` runs `.github/workflows/build.yml`, which installs production dependencies,
builds the assets and publishes `ashish-web-studio-sage.zip` on the rolling **latest** release.
The server has no shell access, so the built zip is what gets installed.
