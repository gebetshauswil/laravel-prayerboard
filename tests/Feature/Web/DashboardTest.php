<?php

namespace Tests\Feature;

use App\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_guest_can_not_visit_the_dashboard()
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }
}
