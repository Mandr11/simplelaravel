@extends('layouts.frontend')

@section('page', 'index')

@section('content')
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-semibold mb-2">Frontend demo</h1>
    <p class="text-gray-600 mb-4">This is a small Blade frontend that demonstrates fetching JSON API data and rendering it using a tiny JavaScript file under Vite.</p>

    <div class="flex gap-3">
      <a href="/frontend/items" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Open items list</a>
      <a href="/frontend/items/1" class="px-4 py-2 border rounded hover:bg-gray-50">Open detail for item #1</a>
    </div>
  </div>
@endsection
