<?php

namespace App\Infrastructure\Controllers;

use App\Domain\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    private UserRepository $userDataSource;

    public function __construct(UserRepository $userDataSource, UserRepository $localUserDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    public function __invoke(string $userEmail): JsonResponse
    {
        $user = $this->userDataSource->findByEmail($userEmail);
        if (is_null($user)){
            return response()->json([
                'error' => 'usuario no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ], Response::HTTP_OK);
    }
}
