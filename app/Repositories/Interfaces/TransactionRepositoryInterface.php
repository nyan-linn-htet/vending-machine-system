<?php
namespace App\Repositories\Interfaces;

Interface TransactionRepositoryInterface {
    public function allTransactions();
    public function storeTransaction($data);
    public function getTransactionDetails($id);
}
