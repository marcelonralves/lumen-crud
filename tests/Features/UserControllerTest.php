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

    public function test_user_try_to_register_using_a_email_and_document_already_registered()
    {
        $userFactory = User::factory()->create();

        $payload = [
            'name' => $userFactory->name,
            'document' => $userFactory->document,
            'email' => $userFactory->email,
            'password' => 'pass123',
            'number' => $userFactory->number
        ];

        $this->post('/user', $payload);
        $this->assertResponseStatus(400);
        $this->seeJson(["message" => "there is a user using this email already",
                        "message" => "there is a user using this document already"]);
    }

    public function test_if_list_users_route_is_ok()
    {
        $this->get('/users');
        $this->assertResponseOk();
    }
}
