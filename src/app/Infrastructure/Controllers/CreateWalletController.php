<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class CreateWalletController extends BaseController
{
    private CreateWalletService $createWalletService;

    public function __construct(CreateWalletService $createWalletService)
    {
        $this->createWalletService = $createWalletService;
    }

    public function __invoke(CreateWalletFormRequest $request): JsonResponse
    {
        $user_id = $request->get('user_id');
        return $this->createWalletService->execute($user_id);
    }
}
