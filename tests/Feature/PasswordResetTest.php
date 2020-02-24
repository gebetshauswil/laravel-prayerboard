<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Str;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    const USER_ORIGINAL_PASSWORD = 'secret';

    /** @test */
    public function show_password_reset_request_page()
    {
        $this
            ->get(route('password.request'))
            ->assertSee('Reset Password')
            ->assertSee('E-Mail Address')
            ->assertSee('Send Password Reset Link')
            ->assertSuccessful();
    }

    /** @test */
    public function submit_password_reset_request_invalid_email()
    {
        $this
            ->followingRedirects()
            ->from(route('password.request'))
            ->post(route('password.email'), [
                'email' => Str::random(),
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.email', [
                'attribute' => 'email',
            ]));
    }

    /** @test */
    public function submit_password_reset_request_email_not_found()
    {
        $this
            ->followingRedirects()
            ->from(route('password.request'))
            ->post(route('password.email'), [
                'email' => $this->faker->unique()->safeEmail,
            ])
            ->assertSuccessful()
            ->assertSee(e(__('passwords.user')));
    }

    /** @test */
    public function submit_password_reset_request()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this
            ->followingRedirects()
            ->from(route('password.request'))
            ->post(route('password.email'), [
                'email' => $user->email,
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.sent'));

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test */
    public function show_password_reset_page()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $token = Password::broker()->createToken($user);

        $this
            ->get(route('password.reset', compact('token')))
            ->assertSuccessful()
            ->assertSee('Reset Password')
            ->assertSee('E-Mail Address')
            ->assertSee('Password')
            ->assertSee('Confirm Password');
    }

    /** @test */
    public function submit_password_reset_invalid_email()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random();

        $this
            ->followingRedirects()
            ->from(route('password.reset', compact('token')))
            ->post(route('password.update'), [
                'token' => $token,
                'email' => Str::random(),
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.email', [
                'attribute' => 'email',
            ]));

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(self::USER_ORIGINAL_PASSWORD, $user->password));
    }

    /** @test */
    public function submit_password_reset_email_not_found()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random();

        $this
            ->followingRedirects()
            ->from(route('password.reset', compact('token')))
            ->post(route('password.update'), [
                'token' => $token,
                'email' => $this->faker->unique()->safeEmail,
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful()
            ->assertSee(e(__('passwords.user')));

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(self::USER_ORIGINAL_PASSWORD,
            $user->password));
    }

    /** @test */
    public function submit_password_reset_password_missmatch()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random();
        $password_confirmation = Str::random();

        $this
            ->followingRedirects()
            ->from(route('password.reset', compact('token')))
            ->post(route('password.update'), [
                'token' => $token,
                'email' => $user->email,
                'password' => $password,
                'password_confirmation' => $password_confirmation,
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.confirmed', [
                'attribute' => 'password',
            ]));

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(self::USER_ORIGINAL_PASSWORD, $user->password));
    }

    /** @test */
    public function submit_password_reset_password_too_short()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random(5);

        $this
            ->followingRedirects()
            ->from(route('password.reset', compact('token')))
            ->post(route('password.update'), [
                'token' => $token,
                'email' => $user->email,
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful()
            ->assertSee(__('validation.min.string', [
                'attribute' => 'password',
                'min' => 8,
            ]));

        $user->refresh();

        $this->assertFalse(Hash::check($password, $user->password));

        $this->assertTrue(Hash::check(self::USER_ORIGINAL_PASSWORD, $user->password));
    }

    /** @test */
    public function SubmitPasswordReset()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'password' => bcrypt(self::USER_ORIGINAL_PASSWORD),
        ]);

        $token = Password::broker()->createToken($user);

        $password = Str::random();

        $this
            ->followingRedirects()
            ->from(route('password.reset', compact('token')))
            ->post(route('password.update'), [
                'token' => $token,
                'email' => $user->email,
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertSuccessful()
            ->assertSee(__('passwords.reset'));

        $user->refresh();

        $this->assertFalse(Hash::check(self::USER_ORIGINAL_PASSWORD,
            $user->password));

        $this->assertTrue(Hash::check($password, $user->password));
    }

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
    }
}
