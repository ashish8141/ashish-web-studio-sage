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
    components/          <x-button>, <x-tag>
    home/                homepage sections
    retainer/            WordPress maintenance page sections
    partials/            blog cards, single post parts, comments, CTA band
  css/
    app.css              Tailwind entry
    theme.css            brand tokens (@theme)
    legacy/              original stylesheet, split by section; removed as sections move to Tailwind
  js/                    app.js (entry), fx.js (GSAP scroll effects), main.js (interactions, hero gradient)
  images/, fonts/
```

## Deployment

Every push to `main` runs `.github/workflows/build.yml`, which installs production dependencies,
builds the assets and publishes `ashish-web-studio-sage.zip` on the rolling **latest** release.
The server has no shell access, so the built zip is what gets installed.
