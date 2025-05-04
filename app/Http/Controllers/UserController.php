<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/deposit",
     *     summary="Deposit funds to user account",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount"},
     *             @OA\Property(property="amount", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Deposit successful"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function deposit(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01|max:10000'
        ]);

        return DB::transaction(function () use ($validated) {
            $user = auth()->user();
            $user->increment('balance', $validated['amount']);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'deposit',
                'amount' => $validated['amount'],
                'description' => 'Account deposit'
            ]);

            return response()->json([
                'balance' => $user->fresh()->balance
            ]);
        });
    }

    public function transactions(): \Illuminate\Http\JsonResponse
    {
        $transactions = auth()->user()->transactions()
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => $transactions->map(fn($t) => [
                'id' => $t->id,
                'type' => $t->type,
                'amount' => $t->amount,
                'description' => $t->description,
                'date' => $t->created_at->toDateTimeString()
            ]),
            'meta' => [
                'current_page' => $transactions->currentPage(),
                'total' => $transactions->total()
            ]
        ]);
    }
}
