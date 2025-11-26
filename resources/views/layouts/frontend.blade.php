<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} — Frontend Demo</title>
    @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])
  </head>
  <body data-page="@yield('page')" class="min-h-screen bg-gray-50">
    <nav class="bg-white border-b py-3">
      <div class="max-w-4xl mx-auto px-4 flex items-center justify-between">
        <div class="font-bold text-lg">{{ config('app.name', 'Laravel') }}</div>
        <ul class="flex gap-3 text-sm">
          <li><a class="px-3 py-1 text-gray-800 hover:bg-gray-100 rounded" href="/frontend">Home</a></li>
          <li><a class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700" href="/frontend/items">Items</a></li>
          <li><a class="px-3 py-1 text-gray-800 hover:bg-gray-100 rounded" href="/">Back to app</a></li>
        </ul>
      </div>
    </nav>

    <main class="max-w-4xl mx-auto p-6">
      @yield('content')
    </main>

    <footer class="text-center text-xs text-gray-400 py-4">Simple Laravel Blade frontend demo</footer>
  </body>
</html>
