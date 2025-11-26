@extends('layouts.frontend')

@section('page', 'items')

@section('content')
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-semibold mb-2">Items</h1>
    <p class="text-gray-600 mb-4">Click "Load items" to fetch data from the demo API and render the results.</p>

    <div id="app"></div>
  </div>
@endsection
