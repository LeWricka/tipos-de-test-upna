<?php

namespace App\Infrastructure\Controllers\GetSpecialUsers;

use App\Application\GetSpecialUsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class GetSpecialUsersController extends BaseController
{
    private GetSpecialUsersService $getSpecialUserService;
    private SpecialUsersResponseMapper $specialUsersResponseMapper;

    public function __construct(GetSpecialUsersService $getSpecialUsersService, SpecialUsersResponseMapper $specialUsersResponseMapper)
    {
        $this->getSpecialUserService = $getSpecialUsersService;
        $this->specialUsersResponseMapper = $specialUsersResponseMapper;
    }

    public function __invoke(): JsonResponse
    {
        $userList = $this->getSpecialUserService->execute();

        return response()->json($this->specialUsersResponseMapper->map($userList));
    }
}
