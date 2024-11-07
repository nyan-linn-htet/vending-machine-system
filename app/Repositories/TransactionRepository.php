<?php

namespace App\Repositories;

use Exception;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function allTransactions()
    {
        if(Auth::user()->hasRole('User')) {
            return Transaction::where('user_id', Auth::user()->id)->paginate('10');
        } else {
            return Transaction::paginate('10');
        }
    }

    public function storeTransaction($data)
    {
        DB::beginTransaction();
        try{
            $transaction = Transaction::create([
                'user_id' => $data->user_id,
                'total_quantity' => $data->total_quantity,
                'total_price' => $data->total_amount,
            ]);

            $product_data = json_decode($data->product_data, true);

            foreach($product_data as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'total_quantity' => $item['quantity'],
                    'total_price' => $item['amount'],
                ]);

                $product = Product::firstWhere('id', $item['id']);
                $product->quantity = $product->quantity - (int) $item['quantity'];
                $product->save();
            }

            DB::commit();
            return true;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function getTransactionDetails($id)
    {
        return Transaction::with('transactionDetails')->firstWhere('id', $id);
    }
}
