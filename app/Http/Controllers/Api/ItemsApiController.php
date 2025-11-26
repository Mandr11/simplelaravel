<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemsApiController extends Controller
{
    protected function sampleItems()
    {
        return [
            ['id' => 1, 'title' => 'First item', 'description' => 'A short description for the first item.'],
            ['id' => 2, 'title' => 'Second item', 'description' => 'A second example that demonstrates fetching JSON.'],
            ['id' => 3, 'title' => 'Tip', 'description' => 'You can replace these with real data from models/controllers.'],
        ];
    }

    public function index()
    {
        return response()->json($this->sampleItems());
    }

    public function show($id)
    {
        $items = $this->sampleItems();
        foreach ($items as $item) {
            if ((int)$item['id'] === (int)$id) {
                return response()->json($item);
            }
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
}
