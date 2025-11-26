<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} — Frontend Demo</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])
    @else
      {{-- Vite dev server or built manifest not available. Load Tailwind CDN as a friendly fallback so pages look good without building assets. --}}
        <!-- Tailwind CDN fallback: makes the app look good even when Vite assets are missing -->
      <script src="https://cdn.tailwindcss.com"></script>
      <script>
        // small tailwind config override so custom colours and forms look nice by default
        tailwind.config = {
          theme: {
            extend: {
              colors: { brand: '#4f46e5' }
            }
          }
        };
      </script>

      <style>
        /* Very small fallback styles so page looks acceptable without built assets */
        :root{--bg:#f8fafc;--muted:#6b7280}
        html,body{height:100%;margin:0;font-family:ui-sans-serif,system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial}
        body{background:var(--bg);color:#111}
        nav{background:#fff;border-bottom:1px solid #e6e6e6}
        .max-w-4xl{max-width:64rem;margin-left:auto;margin-right:auto}
        .mx-auto{margin-left:auto;margin-right:auto}
        .px-4{padding-left:1rem;padding-right:1rem}
        .p-6{padding:1.5rem}
      </style>
      <script>console && console.warn('Vite manifest/hot not found — running a CDN fallback for Tailwind so the page renders correctly. Run `npm run dev` or `npm run build` to use local Vite assets.');</script>
    @endif
  </head>
  <body data-page="@yield('page')" class="min-h-screen bg-gradient-to-tr from-indigo-50 via-white to-pink-50 text-slate-900">

    <header class="bg-white/60 backdrop-blur-sm border-b shadow-sm">
      <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
        <a href="/" class="flex items-center gap-3 no-underline">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-600 to-pink-500 flex items-center justify-center text-white font-bold shadow">SL</div>
          <div class="leading-tight">
            <div class="font-bold text-lg">{{ config('app.name', 'Laravel') }}</div>
            <div class="text-xs text-slate-500">A minimal Laravel Blade frontend demo</div>
          </div>
        </a>

        <nav class="flex items-center gap-3">
          <a href="/frontend" class="text-sm px-3 py-2 rounded hover:bg-slate-100">Home</a>
          <a href="/frontend/items" class="text-sm px-3 py-2 rounded bg-indigo-600 text-white shadow-sm hover:bg-indigo-700">Items</a>
          <a href="/items" class="text-sm px-3 py-2 rounded hover:bg-slate-100">Manage</a>
          <a href="/docs" class="ml-4 text-sm px-3 py-2 rounded hover:bg-slate-100 hidden md:inline">Docs</a>
        </nav>
      </div>
    </header>

    <main class="max-w-6xl mx-auto p-6 py-10">
      @if (session('status'))
        <div class="mb-6 text-sm text-green-700 bg-green-50 border border-green-100 rounded px-4 py-3">{{ session('status') }}</div>
      @endif

      @yield('content')
    </main>

    <footer class="text-center text-xs text-gray-400 py-4">Simple Laravel Blade frontend demo</footer>
  </body>
</html>
