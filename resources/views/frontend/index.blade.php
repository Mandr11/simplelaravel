@extends('layouts.frontend')

@section('page', 'index')

@section('content')
  <div class="grid gap-8">
    
    {{-- Awal: Hero / Welcome Section --}}
    <div class="card p-8 text-center bg-white/70 backdrop-blur-sm">
      <h1 class="text-4xl font-extrabold mb-2 text-indigo-700">Selamat Datang di AmBookstore</h1>
      <p class="text-xl text-gray-600 mb-6">
        Aplikasi Berbasis Laravel blade untuk mengatur buku mu.
      </p>
      
      <div class="flex justify-center gap-4">
        <a href="/frontend/items" class="btn-primary text-lg">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
          Explore Books
        </a>
        <a href="/items/create" class="px-4 py-2 border rounded hover:bg-gray-50 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
          Add a New Book
        </a>
      </div>
      
      {{-- Success/Error Status Message --}}
      @if (session('status'))
        <div class="mt-6 p-3 bg-green-100 text-green-700 rounded-lg text-sm border border-green-200">
          {{ session('status') }}
        </div>
      @endif
      
      <div class="mt-6 p-4 bg-white/60 rounded-lg shadow-inner border border-dashed border-gray-100 muted">
        Tip: run <code>npm run dev</code> while developing to get Vite HMR for the frontend assets.
      </div>
    </div>
    {{-- Akhir: Hero / Welcome Section --}}


    {{-- Awal: Featured Books --}}
    <div class="mt-6">
      <h2 class="text-2xl font-bold mb-4 border-b pb-2">Featured Books</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($featuredItems as $item)
          <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
            {{-- Book Cover / Image --}}
            <a href="/frontend/items/{{ $item->id }}" class="block relative group">
              @php
                // Use default image if 'image' is empty
                $imageUrl = $item->image ?: 'https://via.placeholder.com/1200x600?text=Book+Cover+Missing';
              @endphp
              <img 
                src="{{ $imageUrl }}" 
                alt="Cover for {{ $item->title }}" 
                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105" 
                onerror="this.onerror=null;this.src='https://via.placeholder.com/1200x600?text=Book+Cover+Missing';"
              />
            </a>
            
            <div class="p-4">
              <h3 class="text-lg font-semibold truncate mb-1">
                <a href="/frontend/items/{{ $item->id }}" class="hover:text-indigo-600 transition">{{ $item->title }}</a>
              </h3>
              
              <p class="text-sm text-gray-500 mb-3">By {{ $item->author ?? 'Unknown' }}</p>
              
              <div class="flex flex-wrap gap-2 mb-3">
                @foreach ((array) $item->tags as $tag)
                  <span class="pill">{{ $tag }}</span>
                @endforeach
              </div>
              
              <a href="/frontend/items/{{ $item->id }}" class="btn-primary w-full justify-center mt-2 text-sm">View Details</a>
            </div>
          </div>
        @empty
          <div class="md:col-span-3 text-center p-6 bg-yellow-50 rounded-lg text-yellow-800">
            No featured books found. Create one to see it here!
          </div>
        @endforelse
      </div>
    </div>
    {{-- Akhir: Featured Books --}}

    
    {{-- Ganti Quick Preview Lama dengan link ke Admin/Manage --}}
    <div class="card mt-6 bg-indigo-50 border border-indigo-200">
      <div class="text-lg font-semibold text-indigo-700 mb-2">Manage Your Collection</div>
      <p class="muted mb-4">
        Go to the management panel to quickly add, edit, or delete items in your database.
      </p>
      <a href="/items" class="btn-primary bg-indigo-600 hover:bg-indigo-700 text-sm">
        Go to Management Panel
      </a>
    </div>

  </div>
@endsection
