<?php

namespace Features;

use App\Models\User;
use Laravel\Lumen\Testing\TestCase;

class UserControllerTest extends TestCase
{

    public function createApplication()
    {
        return require './bootstrap/app.php';
    }

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_is_not_sending_all_params()
    {
        $this->post('/user');
        $this->assertResponseStatus(422);
    }

    public function test_user_try_to_register()
    {
        $userFactory = User::factory()->make();

        $payload = [
            'name' => $userFactory->name,
            'document' => $userFactory->document,
            'email' => $userFactory->email,
            'password' => 'pass123',
            'number' => $userFactory->number
        ];

        $this->post('/user', $payload);
        $this->assertResponseStatus(200);
        $this->seeJson(["message" => "user registered succefully"]);
    }
}
