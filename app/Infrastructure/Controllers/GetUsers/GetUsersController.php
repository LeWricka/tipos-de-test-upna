<?php

namespace App\Infrastructure\Controllers\GetUsers;

use App\Domain\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class GetUsersController extends BaseController
{
    private UserRepository $userDataSource;
    private UsersResponseMapper $userListResponseMapper;

    public function __construct(UserRepository $userDataSource, UsersResponseMapper $usersResponseMapper)
    {
        $this->userDataSource = $userDataSource;
        $this->userListResponseMapper = $usersResponseMapper;
    }

    public function __invoke(): JsonResponse
    {
        $userList = $this->userDataSource->getAll();

        return response()->json($this->userListResponseMapper->map($userList));
    }
}
