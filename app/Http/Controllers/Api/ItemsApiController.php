<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemsApiController extends Controller
{
    protected function sampleItems()
    {
        return [
            [
                'id' => 1,
                'title' => 'First item',
                'subtitle' => 'Overview of the first sample',
                'author' => 'Alex Taylor',
                'created_at' => '2025-11-01T08:30:00Z',
                'tags' => ['example', 'getting-started'],
                'image' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?w=1200&h=600&fit=crop',
                'description' => 'A short description for the first item. Use this space to explain the purpose and details. This demo shows how a detail page can surface metadata and actions.'
            ],
            [
                'id' => 2,
                'title' => 'Second item',
                'subtitle' => 'A deeper dive',
                'author' => 'Jamie Park',
                'created_at' => '2025-11-03T12:10:00Z',
                'tags' => ['demo', 'tips'],
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&h=600&fit=crop',
                'description' => 'A second example that demonstrates fetching JSON. When building a UI it is useful to include an author, timestamps and tags that help the user understand the content.'
            ],
            [
                'id' => 3,
                'title' => 'Tip',
                'subtitle' => 'Helpful note',
                'author' => 'System',
                'created_at' => '2025-11-10T09:15:00Z',
                'tags' => ['note'],
                'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200&h=600&fit=crop',
                'description' => 'You can replace these with real data from models/controllers. This item showcases a compact content layout for small notes.'
            ],
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
