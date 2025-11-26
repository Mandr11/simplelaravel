<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} — Simple Frontend</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])
    @else
      {{-- No Vite manifest / hot — use Tailwind CDN so the page still looks polished. --}}
      <script src="https://cdn.tailwindcss.com"></script>
      <script>tailwind.config = { theme: { extend: { colors: { brand: '#4f46e5' } } } }</script>
      <style>body{font-family:ui-sans-serif,system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial;background:#f8fafc;color:#111}</style>
      <script>console && console.warn('Vite manifest/hot not found. Loading Tailwind CDN as fallback — run `npm run dev` or `npm run build` to use local assets.')</script>
    @endif
  </head>
  <body class="min-h-screen bg-gray-50 flex items-center justify-center p-8">
    <div id="app" class="max-w-2xl w-full bg-white rounded-lg shadow p-6"></div>
  </body>
</html>
