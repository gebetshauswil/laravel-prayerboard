<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Str;
use Tests\TestCase;

class EmailVerificationNotification extends VerifyEmail
{
    public function verificationUrl($notifiable)
    {
        return parent::verificationUrl($notifiable);
    }
}

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    const USER_ORIGINAL_EMAIL = 'dummy@email.com';
    const USER_ORIGINAL_PASSWORD = 'secret';

    /** @test */
    public function show_user_register_page()
    {
        $this
            ->get(route('register'))
            ->assertSee('First Name')
            ->assertSee('Last Name')
            ->assertSee('E-Mail Address')
            ->assertSee('Password')
            ->assertSee('Confirm Password')
            ->assertSee('Register')
            ->assertSuccessful();
    }

    /** @test */
    public function send_registration_request_empty_first_name()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'first_name' => ''
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.required', [
                'attribute' => 'first name'
            ]));
    }

    /** @test */
    public function send_registration_request_too_long_first_name()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'first_name' => Str::random(256)
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.max.string', [
                'attribute' => 'first name',
                'max' => 255
            ]));
    }

    /** @test */
    public function send_registration_request_empty_last_name()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'last_name' => ''
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.required', [
                'attribute' => 'last name'
            ]));
    }

    /** @test */
    public function send_registration_request_too_long_last_name()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'last_name' => Str::random(256)
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.max.string', [
                'attribute' => 'last name',
                'max' => 255
            ]));
    }

    /** @test */
    public function send_registration_request_empty_email()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'email' => ''
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.required', [
                'attribute' => 'email'
            ]));
    }

    /** @test */
    public function send_registration_request_invalid_email()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'email' => Str::random()
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.email', [
                'attribute' => 'email'
            ]));
    }

    /** @test */
    public function send_registration_request_too_long_email()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'email' => 'dummy@' . Str::random(256) . '.tld'
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.max.string', [
                'attribute' => 'email',
                'max' => 255
            ]));
    }

    /** @test */
    public function send_registration_request_existing_email()
    {
        factory(User::class)->create(['email' => self::USER_ORIGINAL_EMAIL]);

        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'email' => self::USER_ORIGINAL_EMAIL
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.unique', [
                'attribute' => 'email'
            ]));
    }

    /** @test */
    public function send_registration_request_empty_password()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'password' => ''
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.required', [
                'attribute' => 'password'
            ]));
    }

    /** @test */
    public function send_registration_request_too_short_password()
    {
        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'password' => self::USER_ORIGINAL_PASSWORD
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.min.string', [
                'attribute' => 'password',
                'min' => 8
            ]));
    }

    /** @test */
    public function send_registration_request_password_missmatch()
    {
        $password = Str::random(8);
        $password_confirmation = Str::random(10);

        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'password' => $password,
                'password_confirmation' => $password_confirmation
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.confirmed', [
                'attribute' => 'password'
            ]));
    }

    /** @test */
    public function submit_registration()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $email = $this->faker->unique()->safeEmail;
        $password = $this->faker->password(8);

        $this
            ->followingRedirects()
            ->from(route('register'))
            ->post(route('register'), [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password
            ])
            ->assertSee(__('Before proceeding, please check your email for a verification link.'));


        $this->assertDatabaseHas('users', [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'email_verified_at' => null,
        ]);

        $user = User::whereEmail($email)->first();

        $this->assertNull($user->email_verified_at);

        Notification::assertSentTo($user, VerifyEmail::class);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function verify_email_address()
    {
        $notification = new EmailVerificationNotification();

        $user = factory(User::class)->create(['email_verified_at' => null]);
        $this->assertNull($user->email_verified_at);

        $this->actingAs($user)->get($notification->verificationUrl($user));
        $this->assertNotNull($user->email_verified_at);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
    }
}
