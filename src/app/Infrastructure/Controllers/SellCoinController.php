<?php

namespace App\Infrastructure\Controllers;



use App\Application\SellCoinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class SellCoinController extends BaseController
{
    private SellCoinService $sellCoinService;

    public function __construct(SellCoinService $sellCoinService)
    {
        $this->sellCoinService=$sellCoinService;
    }

    public function __invoke(SellCoinFormRequest $request): JsonResponse
    {
        $coin_id = $request->get('coin_id');
        $wallet_id = $request->get('wallet_id');
        $amount_usd = $request->get('amount_usd');
        return $this->sellCoinService->execute($coin_id,$wallet_id,$amount_usd);
    }
}
