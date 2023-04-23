<?php

namespace App\Infrastructure\Controllers\GetUsers;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class GetUsersController extends BaseController
{
    private UserDataSource $userDataSource;
    private UsersResponseMapper $userListResponseMapper;

    public function __construct(UserDataSource $userDataSource, UsersResponseMapper $usersResponseMapper)
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
