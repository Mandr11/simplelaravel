@extends('layouts.frontend')

@section('page', 'show')

@section('content')
  <div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
      <div class="rounded-md overflow-hidden mb-4 shadow-sm">
        <img src="{{ $item->image ?? '' }}" alt="{{ $item->title }}" class="w-full h-64 object-cover">
      </div>

      <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-start justify-between gap-4 mb-4">
          <div>
            <h2 class="text-2xl font-extrabold leading-snug">{{ $item->title }}</h2>
            <div class="text-sm text-slate-500">{{ $item->subtitle ?? '' }}</div>
            <div class="mt-3 text-sm text-slate-500">By <strong>{{ $item->author ?? 'Unknown' }}</strong> · {{ $item->created_at->toDayDateTimeString() }}</div>
          </div>
          <div class="flex gap-2">
            <a href="/items/{{ $item->id }}/edit" class="px-3 py-1 border rounded text-sm hover:bg-slate-50">Edit</a>
            <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">Delete</button>
            </form>
          </div>
        </div>

        <div class="mb-4">
          @if($item->tags)
            @foreach($item->tags as $tag)
              <span class="inline-block bg-slate-100 text-slate-700 px-2 py-1 text-xs rounded-full mr-2">{{ $tag }}</span>
            @endforeach
          @endif
        </div>

        <div class="prose max-w-none text-slate-700">{{ $item->description }}</div>
      </div>

      <div class="mt-4 text-sm text-slate-500">Want to add comments or more actions? This area is a placeholder where you can attach additional panels like attachments or activity logs.</div>
    </div>

    <aside class="bg-white rounded-lg shadow p-4">
      <div class="text-xs text-slate-500 uppercase tracking-wide mb-2">Details</div>
      <dl class="text-sm space-y-2">
        <div><dt class="font-medium">ID</dt><dd class="text-slate-600">{{ $item->id }}</dd></div>
        <div><dt class="font-medium">Author</dt><dd class="text-slate-600">{{ $item->author ?? '' }}</dd></div>
        <div><dt class="font-medium">Created</dt><dd class="text-slate-600">{{ $item->created_at->toDayDateTimeString() }}</dd></div>
        @if($item->tags)
          <div><dt class="font-medium">Tags</dt><dd class="text-slate-600">{{ implode(', ', $item->tags) }}</dd></div>
        @endif
      </dl>

      <div class="mt-4 border-t pt-3">
        <a href="/frontend/items" class="text-sm px-3 py-2 rounded hover:bg-slate-100 inline-block">← Back to items</a>
      </div>
    </aside>
  </div>
@endsection

