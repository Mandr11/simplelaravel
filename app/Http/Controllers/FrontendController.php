<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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

    public function items()
    {
        // dedicated items list page — same frontend used but different blade
        return view('frontend.items');
    }

    public function show($id)
    {
        // item detail page — pass id into the view
        $item = Item::findOrFail($id);
        return view('frontend.show', ['item' => $item]);
    }
}