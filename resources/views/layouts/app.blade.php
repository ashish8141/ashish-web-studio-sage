<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0e0e0c">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <a class="absolute -left-[9999px] focus:top-4 focus:left-4 focus:z-[100] focus:rounded-[8px] focus:bg-ink focus:px-4 focus:py-2.5 focus:text-paper-ink" href="#aws-content">{{ __('Skip to content', 'sage') }}</a>
    <div id="aws-progress" class="fixed top-0 left-0 z-[70] h-0.5 w-0 bg-accent" aria-hidden="true"></div>

    @include('sections.header')

    <main id="aws-content">
      @yield('content')
    </main>

    @include('sections.footer')

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
