<?php

namespace App\Infrastructure\Controllers;


use App\Application\CreateWalletFormRequest;
use App\Application\Services\CreateWalletService;
use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller as BaseController;

class CreateWalletController extends BaseController
{
    private CreateWalletService $createWalletService;

    public function __construct(CreateWalletService $createWalletService)
    {
        $this->createWalletService=$createWalletService;
    }

    public function __invoke(CreateWalletFormRequest $request): JsonResponse
    {
        $response=$this->createWalletService->execute($request);
        return $response;
    }
}
