@extends('layouts.frontend')

@section('page', 'show')

@section('content')
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-2xl font-semibold">Item details</h1>
        <p class="muted">Fetching item <span class="pill">#{{ $id }}</span> from the API.</p>
      </div>
      <div>
        <a href="/frontend/items" class="px-3 py-2 rounded text-sm hover:bg-slate-100">Back to list</a>
      </div>
    </div>

    <div id="app" data-id="{{ $id }}">
      <div class="rounded-md overflow-hidden mb-4 shadow-sm">
        <div class="bg-slate-200 w-full h-44 flex items-center justify-center text-slate-400">Image preview</div>
      </div>

      <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-start justify-between gap-4 mb-4">
          <div>
            <h2 class="text-2xl font-extrabold leading-snug">Item title</h2>
            <div class="text-sm text-slate-500">Subtitle / short summary</div>
            <div class="mt-3 text-sm text-slate-500">By <strong>Author</strong> · <span class="text-xs pill">Date</span></div>
          </div>
          <div class="flex gap-2">
            <button class="toolbar-btn">Edit</button>
            <button class="danger-btn">Delete</button>
          </div>
        </div>

        <div class="mb-4">
          <span class="tag-chip">example</span>
          <span class="tag-chip">demo</span>
        </div>

        <div class="prose max-w-none text-slate-700">Loading item details…</div>
      </div>
    </div>
  </div>
@endsection
