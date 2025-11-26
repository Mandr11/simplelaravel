@extends('layouts.frontend')

@section('page', 'items-show')

@section('content')
  <div class="card max-w-3xl mx-auto">
    <div class="flex items-start gap-6">
      @if ($item->image)
        <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-48 rounded shadow" />
      @endif

      <div class="flex-1">
        <h1 class="text-2xl font-semibold">{{ $item->title }}</h1>
        @if ($item->subtitle)
          <div class="text-slate-500">{{ $item->subtitle }}</div>
        @endif

        <div class="mt-3 text-sm text-slate-600">By {{ $item->author ?? 'Unknown' }} • {{ $item->created_at->toDayDateTimeString() }}</div>

        <div class="mt-4 prose max-w-none">{!! nl2br(e($item->description)) !!}</div>

        @if ($item->tags && count($item->tags))
          <div class="mt-4">
            @foreach ($item->tags as $tag)
              <span class="inline-block py-1 px-2 mr-2 bg-slate-100 rounded text-sm">{{ $tag }}</span>
            @endforeach
          </div>
        @endif

        <div class="flex gap-2 mt-6">
          <a href="{{ route('items.edit', $item) }}" class="btn-outline">Edit</a>
          <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item?')">
            @csrf @method('DELETE')
            <button class="btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
