<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        try {
            $items = Item::orderBy('created_at', 'desc')->paginate(10);

        } catch (\Throwable $e) {
            // DB is unreachable (common when DB_HOST is 'db' but not running). Log and show a small demo set.
            Log::warning('Items index: database unavailable, falling back to demo list — '.$e->getMessage());

            // create a few in-memory examples using the factory (does not require DB persistence)
            $samples = Item::factory()->count(5)->make();

            // Turn the collection into a LengthAwarePaginator so the view still works
            $items = new LengthAwarePaginator(
                $samples,
                $samples->count(),
                10,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            // Add a non-fatal message so users know this is a fallback
            session()->flash('status', 'Database appears to be unreachable — showing demo items instead.');
        }

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        // PERUBAHAN DI SINI: Tambahkan validasi untuk 'confirmation_keyword'
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|url',
            'confirmation_keyword' => ['required', 'string', 'in:laravel'], // Wajib ketik "laravel"
        ]);

        // tags provided as comma separated string — store as array
        $data['tags'] = array_key_exists('tags', $data) && $data['tags'] ? array_map('trim', explode(',', $data['tags'])) : [];
        
        // Hapus field konfirmasi agar tidak disimpan ke database
        unset($data['confirmation_keyword']); 

        try {
            Item::create($data);
            return redirect()->route('items.index')->with('status', 'Item created successfully');
        } catch (\Throwable $e) {
            Log::warning('Items store failed: DB unavailable or error — ' . $e->getMessage());
            return back()->withInput()->with('status', 'Database unavailable — could not create item.');
        }
    }

    public function show($item)
    {
        try {
            $item = Item::findOrFail($item);
        } catch (\Throwable $e) {
            Log::warning('Items show: database unavailable, rendering demo item — ' . $e->getMessage());
            $item = Item::factory()->make();
            session()->flash('status', 'Database appears to be unreachable — showing demo item.');
        }

        return view('items.show', compact('item'));
    }

    public function edit($item)
    {
        try {
            $item = Item::findOrFail($item);
        } catch (\Throwable $e) {
            Log::warning('Items edit: database unavailable, rendering demo item — ' . $e->getMessage());
            $item = Item::factory()->make();
            session()->flash('status', 'Database appears to be unreachable — showing demo item.');
        }

        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $item)
    {
        // PERUBAHAN DI SINI: Tambahkan validasi untuk 'confirmation_keyword'
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'image' => 'nullable|url',
            'confirmation_keyword' => ['required', 'string', 'in:laravel'], // Wajib ketik "laravel"
        ]);

        $data['tags'] = array_key_exists('tags', $data) && $data['tags'] ? array_map('trim', explode(',', $data['tags'])) : [];
        
        // Hapus field konfirmasi agar tidak disimpan ke database
        unset($data['confirmation_keyword']);

        try {
            $model = Item::findOrFail($item);
            $model->update($data);
            return redirect()->route('items.index')->with('status', 'Item updated');
        } catch (\Throwable $e) {
            Log::warning('Items update failed: DB unavailable or error — ' . $e->getMessage());
            return back()->withInput()->with('status', 'Database unavailable — could not update item.');
        }
    }

    public function destroy($item)
    {
        try {
            $model = Item::findOrFail($item);
            $model->delete();
            return redirect()->route('items.index')->with('status', 'Item deleted');
        } catch (\Throwable $e) {
            Log::warning('Items destroy failed: DB unavailable or error — ' . $e->getMessage());
            return back()->with('status', 'Database unavailable — could not delete item.');
        }
    }
}
