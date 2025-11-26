@extends('layouts.frontend')

@section('page', 'items')

@section('content')
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-2xl font-semibold">Items</h1>
        <p class="muted">Click "Load items" to fetch demo API data and render the results below.</p>
      </div>
      <div>
        <button id="load" class="btn-primary">Load items</button>
      </div>
    </div>

    <div id="app">
      <div class="muted">No data loaded — click "Load items" to fetch sample items.</div>
    </div>
  </div>
@endsection
