<?php

namespace Tests\app\Infrastructure\Controller\GetUsers;

use App\Domain\User;
use App\Domain\UserRepository;
use App\Infrastructure\Controllers\GetUsers\UserResponse;
use App\Infrastructure\Controllers\GetUsers\UsersResponseMapper;
use Tests\TestCase;

class UsersResponseMapperTest extends TestCase
{
    private UserRepository $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function emptyResponseForNullUserList()
    {
        $userListResponseMapper = new UsersResponseMapper();

        $userResponse = $userListResponseMapper->map(null);

        $this->assertEmpty($userResponse);
    }


    /**
     * @test
     */
    public function emptyResponseIfNoUsersGiven()
    {
        $userListResponseMapper = new UsersResponseMapper();

        $userResponse = $userListResponseMapper->map([]);

        $this->assertEmpty($userResponse);
    }

    /**
     * @test
     */
    public function userListMapped()
    {
        $userListResponseMapper = new UsersResponseMapper();
        $user = new User(1, 'email@email.com');
        $expectedUserResponse = [new UserResponse($user)];

        $userResponse = $userListResponseMapper->map([$user]);

        $this->assertEquals($expectedUserResponse, $userResponse);
    }
}
