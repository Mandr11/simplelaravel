<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItemFallbackTest extends TestCase
{
    public function test_index_falls_back_when_db_unreachable()
    {
        // Force the app to attempt connecting to a (likely) invalid host so DB attempts fail
        config(['database.default' => 'mysql']);
        config(['database.connections.mysql.host' => 'invalid-db-host-xyz']);

        $resp = $this->get('/items');
        $resp->assertStatus(200);
        $resp->assertSee('Database appears to be unreachable');
        $resp->assertSee('Manage Items');
    }
}
