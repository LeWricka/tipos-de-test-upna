<?php

namespace Tests\app\Infrastructure\Controller\GetUsers;

use App\Domain\User;
use App\Domain\UserRepository;
use Mockery;
use Tests\TestCase;

class GetUsersControllerTest extends TestCase
{
    private UserRepository $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userDataSource = Mockery::mock(UserRepository::class);
        $this->app->bind(UserRepository::class, function () {
            return $this->userDataSource; //Inyeccion de dependencias, se inyecta el mock
        });
    }

    /**
     * @test
     */
    public function getsNoUsers()
    {
        $this->userDataSource->expects('getAll')->andReturn([]);

        $response = $this->get('/api/users');

        $response->assertExactJson([]);
    }

    /**
     * @test
     */
    public function getsUserList()
    {
        $this->userDataSource->expects('getAll')->andReturn(
            [new User('1', 'email@email.com'), new User('2', 'another_email@email.com')]
        );

        $response = $this->get('/api/users');

        $response->assertOk();
        $response->assertExactJson(
            [['id' => 1, 'email' => 'email@email.com'], ['id' => 2, 'email' => 'another_email@email.com']]
        );
    }
}
