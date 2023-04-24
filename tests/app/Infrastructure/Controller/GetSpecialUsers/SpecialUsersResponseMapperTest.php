<?php

namespace Tests\app\Infrastructure\Controller\GetUsers;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use App\Infrastructure\Controllers\GetUsers\SpecialUserResponse;
use App\Infrastructure\Controllers\GetUsers\SpecialUsersResponseMapper;
use Tests\TestCase;

class SpecialUsersResponseMapperTest extends TestCase
{
    private UserDataSource $userDataSource;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function emptyResponseForNullUserList()
    {
        $userListResponseMapper = new SpecialUsersResponseMapper();

        $userResponse = $userListResponseMapper->map(null);

        $this->assertEmpty($userResponse);
    }


    /**
     * @test
     */
    public function emptyResponseIfNoUsersGiven()
    {
        $userListResponseMapper = new SpecialUsersResponseMapper();

        $userResponse = $userListResponseMapper->map([]);

        $this->assertEmpty($userResponse);
    }

    /**
     * @test
     */
    public function userListMapped()
    {
        $userListResponseMapper = new SpecialUsersResponseMapper();
        $user = new User(1, 'email@email.com');
        $expectedUserResponse = [new SpecialUserResponse($user)];

        $userResponse = $userListResponseMapper->map([$user]);

        $this->assertEquals($expectedUserResponse, $userResponse);
    }
}
