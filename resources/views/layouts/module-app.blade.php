<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  <link type="image/png" href="/assets/img/favicon.png" rel="icon" />
  <!-- Fonts -->
  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Scripts -->
  <script>
    window.CONFIG = {};
    window.CONFIG.LOCALE = "{{ app()->getLocale() }}";
    window.CONFIG.APP_NAME = "{{ config('app.name', 'Laravel') }}";
    window.CONFIG.APP_VERSION = {{ config('app.version', 0x010000) }};
    window.CONFIG.APP_VERSION_STR = "{{ config('app.version_str', '1.0.0') }}";
    window.CONSTANTS = <?= json_encode([]) ?>;
    window.CONFIG.MODULE_NAME = "{{ $MODULE_NAME }}";
    window.CONFIG.MODULE_DISPLAY_NAME = "{{ $MODULE_DISPLAY_NAME }}";
    @if (!!env('APP_DEMO'))
      window.CONFIG.APP_DEMO = 1;
    @endif

    @php
      if (isset($ziggyPrefix)) {
          $ziggy = new Tighten\Ziggy\Ziggy();

          $filteredRoutes = collect($ziggy->toArray()['routes'])
              ->filter(fn($route, $name) => str_starts_with($name, $ziggyPrefix))
              ->toArray();

          $ziggy->toArray()['routes'] = $filteredRoutes;
          echo 'window.Ziggy = @json(' + $ziggy + ');';
      }
    @endphp
  </script>

  @routes
  @vite($viteEntries)
  @inertiaHead
</head>

<body class="font-sans antialiased">
  @inertia
</body>

</html>
