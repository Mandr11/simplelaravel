<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItemStoreUpdateDestroyFallbackTest extends TestCase
{
    public function test_store_fallback_when_db_unreachable()
    {
        config(['database.default' => 'mysql']);
        config(['database.connections.mysql.host' => 'invalid-host-xyz']);

        $resp = $this->post('/items', [
            'title' => 'Title X',
            'description' => 'desc',
        ]);

        // store will catch errors and redirect back
        $resp->assertStatus(302);
        $resp->assertSessionHas('status');
        $this->assertStringContainsString('Database', session('status'));
    }

    public function test_update_fallback_when_db_unreachable()
    {
        config(['database.default' => 'mysql']);
        config(['database.connections.mysql.host' => 'invalid-host-xyz']);

        $resp = $this->put('/items/1', [
            'title' => 'Updated',
        ]);

        $resp->assertStatus(302);
        $resp->assertSessionHas('status');
        $this->assertStringContainsString('Database', session('status'));
    }

    public function test_destroy_fallback_when_db_unreachable()
    {
        config(['database.default' => 'mysql']);
        config(['database.connections.mysql.host' => 'invalid-host-xyz']);

        $resp = $this->delete('/items/1');
        $resp->assertStatus(302);
        $resp->assertSessionHas('status');
        $this->assertStringContainsString('Database', session('status'));
    }
}
