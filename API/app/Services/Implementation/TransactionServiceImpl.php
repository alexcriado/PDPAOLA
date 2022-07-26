<?php

namespace App\Services\Implementation;
use App\Models\Transaction;
use App\Services\Interfaces\ITransactionInterface;

class TransactionServiceImpl implements ITransactionInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Transaction();
    }

    /**
     * @return Transaction $transaction
     */
    function getTransaction()
    {
        return $this->model->withTrashed()->get();
    }

    /**
     * @param int $id
     * @return Transaction $transaction
     */
    function getTransactionById(int $id)
    {
    }

    /**
     * @param array $transaction
     * @return boolean
     */
    function postTransaction(array $transaction)
    {
        $this->model->create($transaction);
    }

    /**
     * @param array $poduct 
     * @param int $id
     * @return boolean
     */
    function putTransaction(array $transaction, $id)
    {
        $this->model->where('id', $id)
            ->first()
            ->fill($transaction)
            ->save();
    }

    /**
     * @param int $id
     * @return boolean
     */
    function deleteTransaction(int $id)
    {
        $user = $this->model->find($id);

        if ($user != null) {
            $user->delete();
        }
    }

    /**
     * @param int $id
     * @return boolean
     */
    function restoreTransaction($id)
    {
        $user = $this->model->withTrashed()->find($id);

        if ($user != null) {
            $user->restore();
        }
    }
}