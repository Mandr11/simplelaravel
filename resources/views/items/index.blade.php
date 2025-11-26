@extends('layouts.frontend')

@section('page', 'items-admin')

@section('content')
  <div>
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-3xl font-bold">Manage Items</h1>
        <p class="text-slate-500 mt-1">Create, edit, or remove items from the database.</p>
      </div>
      <div>
        <a href="{{ route('items.create') }}" class="btn-primary inline-block bg-indigo-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition-colors">Create item</a>
      </div>
    </div>

    <div>
      @if ($items->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($items as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
              <div class="p-6">
                <h2 class="text-xl font-bold text-slate-800">{{ $item->title }}</h2>
                <p class="text-sm text-slate-500 mt-1">by {{ $item->author }}</p>
                <p class="text-xs text-slate-400 mt-4">
                  Added on: {{ $item->created_at->toFormattedDateString() }}
                </p>
              </div>
              <div class="bg-slate-50 px-6 py-3">
                @if ($item->id)
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('items.show', $item) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View</a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('items.edit', $item) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</a>
                    <span class="text-slate-300">|</span>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                      @csrf @method('DELETE')
                      <button class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                    </form>
                  </div>
                @else
                  <div class="text-right">
                    <span class="px-2 py-1 text-sm text-slate-400">Demo Item</span>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-8">
          {{ $items->links() }}
        </div>
      @else
        <div class="text-center bg-white rounded-lg shadow-md p-12">
            <h2 class="text-xl font-medium">No items found.</h2>
            <p class="text-slate-500 mt-2">Create one to get started!</p>
        </div>
      @endif
    </div>
  </div>
@endsection
