<?php

namespace App\Services\Interfaces;
use App\Models\Transaction;

interface ITransactionInterface
{
    /**
     * @return Transaction $transaction
     */
    function getTransaction();

    /**
     * @param int $id
     * @return Transaction $transaction
     */
    function getTransactionById(int $id);

    /**
     * @param array $transaction
     * @return boolean
     */
    function postTransaction(array $transaction);

    /**
     * @param array $poduct 
     * @param int $id
     * @return boolean
     */
    function putTransaction(array $transaction, $id);

    /**
     * @param int $id
     * @return boolean
     */
    function deleteTransaction(int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function restoreTransaction($id);
}