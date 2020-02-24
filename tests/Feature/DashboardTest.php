<?php

namespace Tests\Feature;

use App\User;
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

    /** @test */
    public function a_user_without_verified_email_can_not_visit_the_dashboard()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['email_verified_at' => null]);
        $this->actingAs($user);

        $this->get(route('dashboard'))->assertRedirect(route('verification.notice'));
    }

    /** @test */
    public function a_user_with_a_verified_email_can_visit_the_dashboard()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->get(route('dashboard'))
            ->assertSee('Dashboard')
            ->assertOk();
    }
}
