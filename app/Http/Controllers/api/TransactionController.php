<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //

    public function getAllTransactions()
{
    $transactions = Transaction::all();

    return response()->json([
        'status' => 'success',
        'data' => $transactions
    ]);
}

    public function getTransactionById($id)
    {
        $transaction = Transaction::with('transactionItems.item')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ]);
    }

    public function createTransaction(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'items' => 'required|array',
        ]);
        $transaction = Transaction::create([
            'invoice_number' => $request->invoice_number,
        ]);

        foreach ($request->items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'item_id' => $item['item_id'],
                'total_price' => $item['total_price'],
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $transaction,
        ], 201);
    }
}
