<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = $this->transactionRepository->allTransactions();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = $this->transactionRepository->storeTransaction($request);

        ($status) ? $message = trans('cruds.user.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.user.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = $this->transactionRepository->getTransactionDetails($id);

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
