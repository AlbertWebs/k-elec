<?php

namespace Tests\Feature;

use Tests\TestCase;

class WarrantyRedirectTest extends TestCase
{
    public function test_warranty_path_redirects_to_the_warranty_portal(): void
    {
        $this->get('/warranty')
            ->assertRedirect('https://warranties.k-elec.co.ke/');
    }
}
