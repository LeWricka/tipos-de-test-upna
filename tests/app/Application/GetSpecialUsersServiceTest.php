<?php

namespace Tests\app\Application;

use App\Application\GetSpecialUsersService;
use App\Domain\User;
use App\Domain\UserRepository;
use Mockery;
use Tests\TestCase;

class GetSpecialUsersServiceTest extends TestCase
{
    private UserRepository $userDataSource;
    private GetSpecialUsersService $getSpecialUsersService;

    protected function setUp(): void
    {
        $this->userDataSource = Mockery::mock(UserRepository::class);
        $this->getSpecialUsersService = new GetSpecialUsersService($this->userDataSource);
    }

    /**
     * @test
     */
    public function noSpecialUserFoundIfThereAreNoUsers()
    {
        $this->userDataSource
            ->expects('getAll')
            ->withNoArgs()
            ->andReturn([]);

        $specialUsers = $this->getSpecialUsersService->execute();

        $this->assertEmpty($specialUsers);
    }

    /**
     * @test
     */
    public function specialUsersFound()
    {
        $specialUser = new User(2, 'email@email.com');
        $anotherSpecialUser = new User(5, 'email2@email.com');
        $notSpecialUser = new User(1, 'email@email.com');
        $expectedSpecialUsers = [$specialUser, $anotherSpecialUser];

        $this->userDataSource
            ->expects('getAll')
            ->withNoArgs()
            ->andReturn([$specialUser, $anotherSpecialUser, $notSpecialUser]);

        $specialUsers = $this->getSpecialUsersService->execute();

        $this->assertEquals($expectedSpecialUsers, $specialUsers);
    }
}
