@extends('layouts.frontend')

@section('page', 'items-show')

@section('content')
<div class="max-w-4xl mx-auto"> {{-- ⬅ agar halaman ketengah --}}
  <div class="grid gap-6 lg:grid-cols-3">

    {{-- LEFT SIDE: IMAGE ONLY --}}
    <div class="lg:col-span-1">
      <div class="rounded-md overflow-hidden shadow bg-slate-100 flex items-center justify-center p-3">
        <img 
          src="{{ $item->image ?? '' }}" 
          alt="{{ $item->title }}" 
          class="max-h-56 w-auto object-contain"
        >
      </div>
    </div>

    {{-- RIGHT SIDE: ALL INFORMATION --}}
    <aside class="lg:col-span-2 bg-white rounded-lg shadow p-6">
      
      {{-- TITLE --}}
      <h2 class="text-3xl font-bold leading-snug mb-1">{{ $item->title }}</h2>

      @if($item->subtitle)
        <div class="text-sm text-slate-500 mb-3">{{ $item->subtitle }}</div>
      @endif

      {{-- META --}}
      <div class="text-sm text-slate-500 mb-5">
        By <strong class="text-slate-700">{{ $item->author ?? 'Unknown' }}</strong> · 
        {{ $item->created_at->format('d M Y, H:i') }}
      </div>

      {{-- TAGS --}}
      @if(!empty($item->tags))
        <div class="mb-5">
          @foreach($item->tags as $tag)
            <span class="inline-block bg-slate-100 text-slate-700 px-2 py-1 text-xs rounded-full mr-2">
              #{{ $tag }}
            </span>
          @endforeach
        </div>
      @endif

      {{-- DESCRIPTION --}}
      <div class="prose prose-slate max-w-none mb-6">
        {!! nl2br(e($item->description)) !!}
      </div>

      {{-- ACTION BUTTONS --}}
      <div class="flex gap-2">
        <a href="{{ route('items.edit', $item) }}" 
           class="px-3 py-1.5 border rounded text-sm hover:bg-slate-50 transition">
          Edit
        </a>

        <form action="{{ route('items.destroy', $item) }}" 
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this item?');">
          @csrf
          @method('DELETE')
          <button type="submit" 
                  class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700 transition">
            Delete
          </button>
        </form>

        <a href="{{ route('items.index') }}" 
           class="ml-auto text-sm px-3 py-2 rounded hover:bg-slate-100 transition">
          ← Back to items
        </a>
      </div>

    </aside>

  </div>
</div>
@endsection
