<?php

namespace App\Infrastructure\Controllers;

use App\Application\Exceptions\UserNotFoundException;
use App\Application\IsEarlyAdopterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class UserIsEarlyAdopterController extends BaseController
{
    private IsEarlyAdopterService $isEarlyAdopterService;

    public function __construct(IsEarlyAdopterService $isEarlyAdopterService)
    {
        $this->isEarlyAdopterService = $isEarlyAdopterService;
    }

    public function __invoke(string $userEmail): JsonResponse
    {
        try {
            $isEarlyAdopter = $this->isEarlyAdopterService->execute($userEmail);
        } catch (UserNotFoundException $userNotFoundException) {
            return response()->json([
                'error' => 'usuario no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($isEarlyAdopter) {
            return response()->json([
                'early adopter' => 'El usuario es early adopter',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'early adopter' => 'El usuario no es early adopter',
        ], Response::HTTP_OK);
    }
}
