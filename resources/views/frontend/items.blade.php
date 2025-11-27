@extends('layouts.frontend')

@section('page', 'items')

@section('content')
  <div>
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-3xl font-bold">Explore books</h1>
        <p class="text-slate-500 mt-1">Discover items in the collection, filtered by your criteria.</p>
      </div>
      <div>
        {{-- Link ke halaman admin --}}
        <a href="{{ route('items.index') }}" class="btn-primary inline-block bg-indigo-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition-colors">Manage Items</a>
      </div>
    </div>

    {{-- Filter Form --}}
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
      <h2 class="text-xl font-semibold mb-3 text-slate-800">Filter Results</h2>
      <form method="GET" action="{{ url('/frontend/items') }}" class="flex flex-wrap items-end gap-4">
        
        {{-- Filter by Author --}}
        <div class="flex-1 min-w-[200px] sm:min-w-[unset]">
          <label for="author" class="text-sm font-medium text-slate-700">Author</label>
          <input type="text" name="author" id="author" value="{{ request('author') }}"
                 placeholder="Search author name..."
                 class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-400 focus:border-indigo-400">
        </div>

        {{-- Filter by Date Created (After) --}}
        <div class="flex-1 min-w-[200px] sm:min-w-[unset]">
          <label for="created_after" class="text-sm font-medium text-slate-700">Created After</label>
          <input type="date" name="created_after" id="created_after" value="{{ request('created_after') }}"
                 class="mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-400 focus:border-indigo-400">
        </div>
        
        {{-- Action Buttons --}}
        <div class="flex gap-2 w-full sm:w-auto">
          <button type="submit" class="btn-primary px-4 py-2 text-sm bg-indigo-600 hover:bg-indigo-700">
            Apply Filters
          </button>
          {{-- Tombol reset hanya muncul jika ada filter yang terisi --}}
          @if (request()->filled('author') || request()->filled('created_after'))
            <a href="{{ url('/frontend/items') }}" class="px-4 py-2 text-sm text-slate-700 border border-slate-300 rounded-lg hover:bg-slate-100 transition-colors">
              Reset
            </a>
          @endif
        </div>
      </form>
    </div>

    <div>
      @if ($items->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($items as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
              
              {{-- START: Book Cover (with fixed size h-48) --}}
              <a href="{{ url('/frontend/items', $item->id) }}" class="block relative group">
                  @php
                      // Gunakan placeholder jika gambar kosong untuk memastikan ukuran seragam
                      $imageUrl = $item->image ?: 'https://via.placeholder.com/400x250?text=Book+Cover+Missing';
                  @endphp
                  <img
                      src="{{ $imageUrl }}"
                      alt="Cover for {{ $item->title }}"
                      {{-- Class untuk memastikan ukuran seragam h-48 dan memenuhi wadah --}}
                      class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                      onerror="this.onerror=null;this.src='https://via.placeholder.com/400x250?text=Book+Cover+Missing';"
                  />
              </a>
              {{-- END: Book Cover --}}

              <div class="p-6">
                <h2 class="text-xl font-bold text-slate-800">{{ $item->title }}</h2>
                <p class="text-sm text-slate-500 mt-1">by **{{ $item->author }}**</p>
                <p class="text-xs text-slate-400 mt-4">
                  Added on: {{ $item->created_at->toFormattedDateString() }}
                </p>
                
                {{-- Tags display --}}
                <div class="mt-3 flex flex-wrap gap-1">
                    @if(is_array($item->tags))
                        @foreach($item->tags as $tag)
                            <span class="pill">{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>
              </div>

              <div class="bg-slate-50 px-6 py-3">
                  <div class="flex items-center justify-end gap-2">
                    {{-- Link ke detail frontend --}}
                    <a href="{{ url('/frontend/items', $item->id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View Details</a>
                  </div>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-8">
          {{-- Mempertahankan query string filter saat navigasi paginasi --}}
          {{ $items->appends(request()->except('page'))->links() }}
        </div>
      @else
        <div class="text-center bg-white rounded-lg shadow-md p-12">
            <h2 class="text-xl font-medium text-slate-800">No books found.</h2>
            <p class="text-slate-500 mt-2">Try adjusting your filters or check the Manage Items page!</p>
        </div>
      @endif
    </div>
  </div>
@endsection
