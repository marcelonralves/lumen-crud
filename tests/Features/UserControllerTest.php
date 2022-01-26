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
        $this->assertResponseStatus(422);
    }

    public function test_if_list_users_route_is_ok()
    {
        $this->get('/users');
        $this->assertResponseOk();
    }

    public function test_if_user_that_doesnt_exist_to_update()
    {
        $payload = [
            'id' => 102901
        ];
        $this->put('/user', $payload);

        $this->assertResponseStatus(422);
    }

    public function test_user_try_to_update_email()
    {
        $userFactory = User::factory()->create();

        $payload = [
            'id' => $userFactory->id,
            'email' => time().'@hotmail.com',
        ];

        $this->put('/user', $payload);
        $this->assertResponseStatus(200);
        $this->seeJson(["message" => "user updated"]);
        $this->seeInDatabase("users", $payload);
    }

    public function test_try_to_delete_a_user()
    {
        $userFactory = User::factory()->create();
        $this->delete('/user/'.$userFactory->id);
        $this->assertResponseStatus(200);
    }
}
