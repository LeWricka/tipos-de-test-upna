<?php

namespace Tests\app\Infrastructure\Controller;

use App\Domain\User;
use App\Domain\UserRepository;
use Mockery;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
{
    private UserRepository $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userDataSource = Mockery::mock(UserRepository::class);
        $this->app->bind(UserRepository::class, function () {
            return $this->userDataSource;
        });
    }

    /**
     * @test
     */
    public function userWithGivenEmailDoesNotExist()
    {
        $this->userDataSource
            ->expects('findByEmail')
            ->with('email@email.com')
            ->andReturnNull();

        $response = $this->get('/api/users/email@email.com');

        $response->assertNotFound();
        $response->assertExactJson(['error' => 'usuario no encontrado']);
    }

    /**
     * @test
     */
    public function getsUser()
    {
        $this->userDataSource
            ->expects('findByEmail')
            ->with('email@email.com')
            ->andReturn(new User(1, 'email@email.com'));

        $response = $this->get('/api/users/email@email.com');

        $response->assertOk();
        $response->assertExactJson(['id' => 1, 'email' => 'email@email.com']);
    }
}
