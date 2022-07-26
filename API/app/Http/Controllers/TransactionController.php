<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementation\TransactionServiceImpl;
use App\Validators\TransactionValidator;

class TransactionController extends Controller
{
    /**
     * @var TransactionServiceImpl
     */
    private $transactionService;
    /**
     * @var Request
     */
    private $request;
    /** 
     * @var TransactionValidator
     */
    private $validator;
    public function __construct(TransactionServiceImpl $transactionService, Request $request, TransactionValidator $transactionValidator)
    {
        $this->transactionService = $transactionService;
        $this->request = $request;
        $this->validator = $transactionValidator;
    }

    function createTransaction()
    {
        $response = response("", 201);

        $validator = $this->validator->validate();

        if ($validator->fails()) { //esto devuelve un bool segun ha fallado o no la validacion
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }
        else {
            $this->transactionService->postTransaction($this->request->all());
        }

        return $response;
    }

    function getListTransaction()
    {
        return response($this->transactionService->getTransaction()->where('deleted_at', NULL));
    }

    function putTransaction(int $id)
    {
        $response = response("", 202);

        $validator = $this->validator->validate();

        if ($validator->fails()) { //esto devuelve un bool segun ha fallado o no la validacion
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }
        else {
            $this->transactionService->putTransaction($this->request->all(), $id);
        }

        return $response;
    }

    function deleteTransaction(int $id)
    {
        $this->transactionService->deleteTransaction($id);

        return response("", 204);
    }

    function restoreTransaction(int $id)
    {
        $this->transactionService->restoreTransaction($id);

        return response("", 204);
    }
}
