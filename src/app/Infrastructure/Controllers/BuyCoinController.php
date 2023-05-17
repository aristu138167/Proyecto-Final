<?php

namespace App\Infrastructure\Controllers;



use App\Application\BuyCoinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class BuyCoinController extends BaseController
{
    private BuyCoinService $buyCoinService;

    public function __construct(BuyCoinService $buyCoinService)
    {
        $this->buyCoinService=$buyCoinService;
    }

    public function __invoke(BuyCoinFormRequest $request): JsonResponse
    {
        $coin_id = $request->get('coin_id');
        $wallet_id = $request->get('wallet_id');
        $amount_usd = $request->get('amount_usd');
        return $this->buyCoinService->execute($coin_id,$wallet_id,$amount_usd);
    }
}
