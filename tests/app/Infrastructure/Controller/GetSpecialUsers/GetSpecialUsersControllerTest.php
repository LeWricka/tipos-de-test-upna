<?php

namespace Tests\app\Infrastructure\Controller\GetSpecialUsers;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Mockery;
use Tests\TestCase;

class GetSpecialUsersControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, function () {
            return $this->userDataSource;
        });
    }

    /**
     * @test
     */
    public function getsNoUsers()
    {
        $this->userDataSource->expects('getAll')->andReturn([]);

        $response = $this->get('/api/users/special-users');

        $response->assertExactJson([]);
    }

    /**
     * @test
     */
    public function getsNoSpecialUsers()
    {
        $this->userDataSource->expects('getAll')->andReturn(
            [new User('3', 'email@email.com'), new User('7', 'another_email@email.com')]
        );

        $response = $this->get('/api/users/special-users');

        $response->assertOk();
        $response->assertExactJson([]);
    }

    /**
     * @test
     */
    public function getsSpecialUsers()
    {
        $this->userDataSource
            ->expects('getAll')
            ->andReturn(
                [new User('1', 'email@email.com'), new User('2', 'email2@email.com'), new User('5', 'another_email@email.com')]
            );

        $response = $this->get('/api/users/special-users');

        $response->assertOk();
        $response->assertExactJson([new User('2', 'email2@email.com'), new User('5', 'another_email@email.com')]);
    }
}
