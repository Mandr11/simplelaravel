@extends('layouts.frontend')

@section('page', 'items-admin')

@section('content')
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-2xl font-semibold">Manage Items</h1>
        <div class="muted">Create, edit or remove items from the database.</div>
      </div>
      <div>
        <a href="{{ route('items.create') }}" class="btn-primary">Create item</a>
      </div>
    </div>

    <div>
      @if ($items->count())
        <table class="w-full text-left border-collapse">
          <thead class="text-sm text-slate-500 border-b">
            <tr><th class="py-2">Title</th><th>Author</th><th>Created</th><th class="text-right">Actions</th></tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
              <tr class="border-b hover:bg-slate-50">
                <td class="py-3">{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->created_at->toDateString() }}</td>
                <td class="text-right">
                  @if ($item->id)
                    <a href="{{ route('items.show', $item) }}" class="px-2 py-1 text-sm hover:underline">View</a>
                    <a href="{{ route('items.edit', $item) }}" class="px-2 py-1 text-sm hover:underline">Edit</a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this item?')">
                      @csrf @method('DELETE')
                      <button class="px-2 py-1 text-sm text-red-600">Delete</button>
                    </form>
                  @else
                    <span class="px-2 py-1 text-sm text-slate-400">Demo</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-4">{{ $items->links() }}</div>
      @else
        <div class="muted">No items found. Create one to get started.</div>
      @endif
    </div>
  </div>
@endsection
