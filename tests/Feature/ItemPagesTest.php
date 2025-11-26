<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_items_index_and_create_pages_load()
    {
        $response = $this->get('/items');
        $response->assertStatus(200);
        $response->assertSee('Manage Items');

        $response = $this->get('/items/create');
        $response->assertStatus(200);
        $response->assertSee('Create new Item');
    }

    public function test_show_and_edit_pages_for_item()
    {
        $item = Item::factory()->create([
            'title' => 'My show item',
        ]);

        $resp = $this->get('/items/' . $item->id);
        $resp->assertStatus(200);
        $resp->assertSee('My show item');

        $resp = $this->get('/items/' . $item->id . '/edit');
        $resp->assertStatus(200);
        $resp->assertSee('Edit Item');
    public function test_frontend_show_page_for_item()
    {
        $item = Item::factory()->create([
            'title' => 'My frontend show item',
        ]);

        $resp = $this->get('/frontend/items/' . $item->id);
        $resp->assertStatus(200);
        $resp->assertSee('My frontend show item');
    }
}
