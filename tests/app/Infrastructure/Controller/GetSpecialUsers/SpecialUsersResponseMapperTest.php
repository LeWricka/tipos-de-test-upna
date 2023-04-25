<?php

namespace Tests\app\Infrastructure\Controller\GetSpecialUsers;

use App\Domain\User;
use App\Domain\UserRepository;
use App\Infrastructure\Controllers\GetSpecialUsers\SpecialUserResponse;
use App\Infrastructure\Controllers\GetSpecialUsers\SpecialUsersResponseMapper;
use Tests\TestCase;

class SpecialUsersResponseMapperTest extends TestCase
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
