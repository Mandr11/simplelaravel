@csrf

<div class="space-y-3">
  <div>
    <label class="label">Title</label>
    <input name="title" value="{{ old('title', $item->title ?? '') }}" class="input" required />
    @error('title') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="label">Subtitle</label>
    <input name="subtitle" value="{{ old('subtitle', $item->subtitle ?? '') }}" class="input" />
    @error('subtitle') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
  </div>

  <div>
    <label class="label">Author</label>
    <input name="author" value="{{ old('author', $item->author ?? '') }}" class="input" />
  </div>

  <div>
    <label class="label">Image (URL)</label>
    <input name="image" value="{{ old('image', $item->image ?? '') }}" class="input" />
  </div>

  <div>
    <label class="label">Tags (comma separated)</label>
    <input name="tags" value="{{ old('tags', isset($item) && is_array($item->tags) ? implode(', ', $item->tags) : ($item->tags ?? '') ) }}" class="input" />
  </div>

  <div>
    <label class="label">Description</label>
    <textarea name="description" rows="6" class="input">{{ old('description', $item->description ?? '') }}</textarea>
  </div>

  <div class="flex justify-end">
    <button class="btn-primary">Save</button>
  </div>
</div>
