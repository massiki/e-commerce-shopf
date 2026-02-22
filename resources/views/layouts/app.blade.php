<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="ShopF - Your premium online marketplace for quality products">
  <title>{{ config('app.name', 'ShopF') }} - @yield('title', 'Premium Marketplace')</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 font-sans text-gray-800 antialiased">
  <x-navbar />
  <x-toast />

  <main class="min-h-[calc(100vh-160px)]">
    @yield('content')
  </main>

  <x-footer />

  @stack('scripts')

  {{-- #region agent log --}}
  <script>
    (function() {
      const logEndpoint = 'http://127.0.0.1:7243/ingest/f390d1ac-216f-470c-84ab-96c8e51a92ab';
      const log = (location, message, data, hypothesisId, runId) => {
        fetch(logEndpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            location,
            message,
            data,
            hypothesisId,
            runId,
            timestamp: Date.now()
          })
        }).catch(() => {});
      };

      // Hypothesis A: Check if Alpine.js is loaded
      document.addEventListener('DOMContentLoaded', function() {
        log('app.blade.php:DOMContentLoaded', 'Checking Alpine.js availability', {
          alpineDefined: typeof window.Alpine !== 'undefined',
          alpineVersion: window.Alpine?.version || 'not found'
        }, 'A', 'post-fix');

        // Hypothesis C & D: Check if button exists and attach native click listener
        const userMenuButton = document.querySelector('[x-data] button[@click*="userOpen"]');
        if (userMenuButton) {
          log('app.blade.php:DOMContentLoaded', 'User menu button found', {
            buttonExists: true,
            hasAlpineDirectives: userMenuButton.hasAttribute('@click') || userMenuButton.getAttribute(
              'x-on:click') !== null
          }, 'C', 'post-fix');

          // Add native click listener to verify click events work
          userMenuButton.addEventListener('click', function(e) {
            log('app.blade.php:button-click', 'Native click event triggered', {
              eventType: e.type,
              timestamp: Date.now()
            }, 'C', 'post-fix');

            // Check Alpine state after click
            setTimeout(() => {
              const container = userMenuButton.closest('[x-data]');
              if (container && window.Alpine) {
                try {
                  const alpineData = window.Alpine.$data(container);
                  const dropdown = container.querySelector('[x-show]');
                  const isVisible = dropdown ? window.getComputedStyle(dropdown).display !== 'none' : false;
                  log('app.blade.php:button-click-delayed', 'Alpine state after click', {
                    alpineData: alpineData,
                    userOpen: alpineData?.userOpen,
                    dropdownVisible: isVisible
                  }, 'C', 'post-fix');
                } catch (err) {
                  log('app.blade.php:button-click-delayed', 'Error checking Alpine state', {
                    error: err.message
                  }, 'C', 'post-fix');
                }
              }
            }, 100);
          });
        } else {
          log('app.blade.php:DOMContentLoaded', 'User menu button NOT found', {
            buttonExists: false
          }, 'C', 'post-fix');
        }

        // Hypothesis B: Check for JavaScript errors
        window.addEventListener('error', function(e) {
          log('app.blade.php:window-error', 'JavaScript error detected', {
            message: e.message,
            filename: e.filename,
            lineno: e.lineno,
            colno: e.colno
          }, 'B', 'post-fix');
        });

        // Hypothesis E: Check x-data initialization
        setTimeout(() => {
          const userMenuButton = document.querySelector('[x-data] button[@click*="userOpen"]');
          const container = userMenuButton ? userMenuButton.closest('[x-data]') : null;
          if (container) {
            if (window.Alpine) {
              try {
                const alpineData = window.Alpine.$data(container);
                log('app.blade.php:alpine-init-check', 'Alpine x-data state', {
                  hasAlpineData: !!alpineData,
                  userOpen: alpineData?.userOpen,
                  allKeys: alpineData ? Object.keys(alpineData) : []
                }, 'E', 'post-fix');
              } catch (err) {
                log('app.blade.php:alpine-init-check', 'Error accessing Alpine data', {
                  error: err.message
                }, 'E', 'post-fix');
              }
            } else {
              log('app.blade.php:alpine-init-check', 'Alpine.js not available for x-data check', {
                alpineAvailable: false
              }, 'E', 'post-fix');
            }
          }
        }, 500);
      });
    })();
  </script>
  {{-- #endregion agent log --}}
</body>

</html>
