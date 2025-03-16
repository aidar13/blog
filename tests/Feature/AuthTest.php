<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testLogin()
    {
        $password = $this->faker->password;

        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->postJson(route('api.login'), [
            'email'    => $user->email,
            'password' => $password
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'userId',
                    'token'
                ]
            ])->assertJsonPath('data.userId', $user->id);
    }

    public function testRegister()
    {
        /** @var User $user */
        $user = User::factory()->make();

        $response = $this->postJson(route('api.register'), [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => $this->faker->password(8),
        ]);

        $response->assertOk()
            ->assertJson(['message' => 'Register success']);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'name'  => $user->name
        ]);
    }

    public function testLogout()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $token = $user->createToken('api')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson(route('logout'));

        $response->assertOk()
            ->assertJson(['message' => 'Logout success']);
    }

    public function testForgotPassword()
    {
        Mail::fake();

        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->postJson(route('password.forgot'), [
            'email' => $user->email,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'Forgot password success']);
    }

    public function testResetPassword()
    {
        Mail::fake();

        /** @var User $user */
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->postJson(route('password.reset'), [
            'email'    => $user->email,
            'token'    => $token,
            'password' => 'newpassword',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'Reset password success']);

        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }
}
