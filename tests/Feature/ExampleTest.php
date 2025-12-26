<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Basic application health check.
     */
    public function testBasicTest(): void
    {
        $response = $this->get('/health');

        $response->assertStatus(200);
    }
}
