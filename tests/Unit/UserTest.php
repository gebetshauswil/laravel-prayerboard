<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_user_has_a_firstname()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->assertNotNull($user->first_name);
    }

    /** @test */
    public function a_user_has_a_lastname()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->assertNotNull($user->last_name);
    }

    /** @test */
    public function a_user_has_a_password()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->assertNotNull($user->password);
    }

    /** @test */
    public function a_user_has_an_email_address()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->assertNotNull($user->email);
    }

    /** @test */
    public function a_user_has_an_email_verification_date()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $this->assertNotNull($user->email_verified_at);
    }
}
