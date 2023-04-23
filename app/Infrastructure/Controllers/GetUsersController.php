<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersController extends BaseController
{
    private UserDataSource $userDataSource;

    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    public function __invoke(): JsonResponse
    {
        $userList = $this->userDataSource->getAll();
        if ($userList == null) {
            return response()->json([
            ], Response::HTTP_OK);
        }

        return response()->json($userList, Response::HTTP_OK);
    }
}
