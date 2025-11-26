@extends('layouts.frontend')

@section('page', 'index')

@section('content')
  <div class="hero-grid grid gap-6 items-center">
    <div>
      <div class="card">
        <h1 class="text-3xl font-extrabold mb-2">Welcome to SimpleLaravel — Frontend demo</h1>
        <p class="muted mb-4">A lightweight Blade-first frontend. Try the Items list to see API integration and simple UI components.</p>

        <div class="flex gap-3 items-center">
          <a href="/frontend/items" class="btn-primary">View items</a>
          <a href="/frontend/items/1" class="px-4 py-2 border rounded hover:bg-gray-50">Open sample item</a>
        </div>
      </div>

      <div class="mt-6 p-4 bg-white/60 rounded-lg shadow-inner border border-dashed border-gray-100 muted">
        Tip: run <code>npm run dev</code> while developing to get Vite HMR for the frontend assets.
      </div>
    </div>

    <div class="card">
      <div class="text-sm text-slate-600 mb-3">Quick preview</div>
      <div class="space-y-3">
        <div class="p-3 rounded border border-gray-100">
          <div class="font-semibold">First item</div>
          <div class="muted">A short description for the first item.</div>
        </div>
        <div class="p-3 rounded border border-gray-100">
          <div class="font-semibold">Second item</div>
          <div class="muted">A second example that demonstrates fetching JSON.</div>
        </div>
      </div>
    </div>
  </div>
@endsection
