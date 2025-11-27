@csrf

<div class="space-y-8">

  {{-- TITLE --}}
  <div>
    <label class="text-sm font-semibold text-slate-700 tracking-wide">Title</label>
    <input type="text" name="title" id="title"
      value="{{ old('title', $item->title ?? '') }}"
      class="mt-2 w-full h-14 rounded-xl bg-slate-50 border border-slate-300 
             px-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition"
      required>
      @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- SUBTITLE --}}
  <div>
    <label class="text-sm font-semibold text-slate-700 tracking-wide">Subtitle</label>
    <input type="text" name="subtitle" id="subtitle"
      value="{{ old('subtitle', $item->subtitle ?? '') }}"
      class="mt-2 w-full h-14 rounded-xl bg-slate-50 border border-slate-300 
             px-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
      @error('subtitle')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- AUTHOR --}}
  <div>
    <label class="text-sm font-semibold text-slate-700 tracking-wide">Author</label>
    <input type="text" name="author" id="author"
      value="{{ old('author', $item->author ?? '') }}"
      class="mt-2 w-full h-14 rounded-xl bg-slate-50 border border-slate-300 
             px-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
      @error('author')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- IMAGE --}}
  <div>
    <label class="text-sm font-semibold text-slate-700 tracking-wide">Image (URL)</label>
    <input type="text" name="image" id="image"
      value="{{ old('image', $item->image ?? '') }}"
      class="mt-2 w-full h-14 rounded-xl bg-slate-50 border border-slate-300 
             px-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
      @error('image')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- TAGS --}}
  <div>
    <label class="text-sm font-semibold text-slate-700 tracking-wide">Tags</label>
    <input type="text" name="tags" id="tags"
      value="{{ old('tags', isset($item) && is_array($item->tags) ? implode(', ', $item->tags) : ($item->tags ?? '') ) }}"
      class="mt-2 w-full h-14 rounded-xl bg-slate-50 border border-slate-300 
             px-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
      @error('tags')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- DESCRIPTION --}}
  <div>
    <label class="text-sm font-semibold text-slate-700 tracking-wide">Description</label>
    <textarea name="description" id="description" rows="6"
      class="mt-2 w-full rounded-xl bg-slate-50 border border-slate-300 
             px-4 py-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition"
    >{{ old('description', $item->description ?? '') }}</textarea>
      @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
  </div>

  {{-- NEW: KEYWORD CONFIRMATION --}}
  <div class="pt-2"> 
    <label for="confirmation_keyword" class="text-sm font-semibold text-red-700 tracking-wide">
      Konfirmasi Simpan: Ketik **"laravel"** untuk menyimpan/memperbarui
    </label>
    <input type="text" name="confirmation_keyword" id="confirmation_keyword"
      class="mt-2 w-full h-14 rounded-xl bg-red-50 border border-red-300 
             px-4 text-base text-slate-800 shadow-sm
             focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
      required>
      {{-- Tampilkan pesan error jika kata kunci salah --}}
      @error('confirmation_keyword')
        <p class="text-sm text-red-600 mt-1 font-medium">⚠️ {{ $message == 'The confirmation keyword field is required.' ? 'Kata kunci konfirmasi wajib diisi.' : 'Kata kunci yang Anda masukkan salah. Harus "laravel".' }}</p>
      @enderror
  </div>
  
  {{-- BUTTONS --}}
  <div class="pt-6 flex justify-end gap-3">

    <a href="{{ route('items.index') }}"
       class="px-6 py-3 rounded-xl border border-slate-300 text-slate-700 
              text-sm font-medium bg-white hover:bg-slate-100 shadow-sm transition">
      Cancel
    </a>

    <button type="submit"
      class="px-6 py-3 rounded-xl bg-indigo-600 text-white text-sm font-medium shadow 
             hover:bg-indigo-700 hover:shadow-md transition">
      Save
    </button>

  </div>

</div>
