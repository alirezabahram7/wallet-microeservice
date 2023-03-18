<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMoneyRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getBalance(Request $request): JsonResponse
    {
        $userId = $request->input('user_id');
        $wallet = Wallet::where('user_id', $userId)->firstOrFail();

        return response()->json(['balance' => $wallet->balance]);
    }

    /**
     * @param AddMoneyRequest $request
     * @return JsonResponse
     */
    public function addMoney(AddMoneyRequest $request): JsonResponse
    {
        $userId = $request->input('user_id');
        $amount = $request->input('amount');
        $requestData = $request->all();

        $referenceNumber = DB::transaction(function () use ($userId, $amount, $requestData) {
            $wallet = Wallet::where('user_id', $userId)->firstOrFail();

            $wallet->balance += $amount;
            $wallet->save();

            $referenceNumber = mt_rand(1000000000, 9999999999);
            $requestData = array_merge($requestData, ['reference_number' => $referenceNumber]);
            $wallet->transactions()->create($requestData);

            return $referenceNumber;
        });

        return response()->json(['reference_id' => $referenceNumber],201);
    }
}
