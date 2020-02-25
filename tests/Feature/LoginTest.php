<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    const USER_ORIGINAL_EMAIL = 'dummy@email.com';
    const USER_ORIGINAL_PASSWORD = 'secret';

    /** @test */
    public function show_login_page()
    {
        $this
            ->get(route('login'))
            ->assertSee(__('E-Mail Address'))
            ->assertSee(__('Password'))
            ->assertSee(__('Remember Me'))
            ->assertSee(__('Login'))
            ->assertSee(__('Forgot Your Password?'))
            ->assertSuccessful();
    }

    /** @test */
    public function send_login_request_empty_email()
    {
        $this
            ->followingRedirects()
            ->from(route('login'))
            ->post(route('login'), [
                'email' => ''
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.required', [
                'attribute' => 'email'
            ]));
    }

    /** @test */
    public function send_login_request_empty_password()
    {
        $this
            ->followingRedirects()
            ->from(route('login'))
            ->post(route('login'), [
                'password' => ''
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.required', [
                'attribute' => 'password'
            ]));
    }

    /** @test */
    public function send_login_request_with_wrong_credentials()
    {
        $this
            ->followingRedirects()
            ->from(route('login'))
            ->post(route('login'), [
                'email' => self::USER_ORIGINAL_EMAIL,
                'password' => self::USER_ORIGINAL_PASSWORD,
            ])
            ->assertSuccessful()
            ->assertSee(__('auth.failed'));
    }

    /** @test */
    public function submit_login()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'email' => self::USER_ORIGINAL_EMAIL,
            'password' => Hash::make(self::USER_ORIGINAL_PASSWORD),
        ]);

        $this
            ->post(route('login'), [
                'email' => self::USER_ORIGINAL_EMAIL,
                'password' => self::USER_ORIGINAL_PASSWORD
            ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);

        // TODO MR: check setting of remember checkbox and cookie
    }
}
