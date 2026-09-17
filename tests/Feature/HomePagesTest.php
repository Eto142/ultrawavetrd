<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePagesTest extends TestCase
{
    public function test_policy_pages_are_available(): void
    {
        $this->get('/terms-and-conditions')->assertOk();
        $this->get('/privacy-policy')->assertOk();
    }
}
