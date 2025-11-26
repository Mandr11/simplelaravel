<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    // New protected method to get featured items with fallback
    protected function getFeaturedItems()
    {
        try {
            // Attempt to get the latest 3 items from the database
            $items = Item::orderBy('created_at', 'desc')->take(3)->get();
            if ($items->isEmpty()) {
                // If DB is reachable but empty, create some temporary items
                return Item::factory()->count(3)->make();
            }
            return $items;
        } catch (\Throwable $e) {
            // DB unreachable, return factory-made temporary items
            return Item::factory()->count(3)->make();
        }
    }

    public function index()
    {
        $featuredItems = $this->getFeaturedItems();

        // Pass the featured items to the view
        return view('frontend.index', [
            'featuredItems' => $featuredItems
        ]);
    }

    public function items(Request $request)
    {
        // Inisialisasi query dasar, diurutkan berdasarkan tanggal dibuat terbaru
        $query = Item::orderBy('created_at', 'desc');

        // === Logika Filter ===

        // 1. Filter berdasarkan Author (pencarian parsial)
        if ($request->filled('author')) {
            $query->where('author', 'like', '%'.$request->input('author').'%');
        }

        // 2. Filter berdasarkan Tanggal Dibuat (setelah tanggal tertentu)
        if ($request->filled('created_after')) {
            $query->whereDate('created_at', '>=', $request->input('created_after'));
        }
        
        // === Akhir Logika Filter ===

        try {
            // Ambil data yang sudah difilter dan dipaginasi
            $items = $query->paginate(10);
        } catch (\Throwable $e) {
            // Fallback jika database tidak dapat dijangkau
            Log::warning('Frontend items: database unavailable, falling back to demo list — '.$e->getMessage());
            
            // Membuat beberapa item dummy dengan factory
            $samples = Item::factory()->count(5)->make();

            // Buat paginator tiruan agar view tetap berjalan
            $items = new LengthAwarePaginator(
                $samples,
                $samples->count(),
                10,
                1,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            session()->flash('status', 'Database appears to be unreachable — showing demo items instead.');
        }

        // Kirim data yang difilter ke view
        return view('frontend.items', compact('items'));
    }

    public function show($id)
    {
        // item detail page — pass id into the view
        $item = Item::findOrFail($id);
        return view('frontend.show', ['item' => $item]);
    }
}