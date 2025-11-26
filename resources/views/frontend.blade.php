<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} — Simple Frontend</title>
    @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])
  </head>
  <body class="min-h-screen bg-gray-50 flex items-center justify-center p-8">
    <div id="app" class="max-w-2xl w-full bg-white rounded-lg shadow p-6"></div>
  </body>
</html>
