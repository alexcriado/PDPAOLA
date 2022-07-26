<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionValidator
{
    /**
     * @var Request
     */
    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        return Validator::make($this->request->all(), $this->rules(), $this->messages());
    }

    private function rules()
    {
        return [
            "type" => "required",
            "product_id" => "required",
            "name" => "required",
            "quantity" => "required"
        ];
    }

    private function messages()
    {
        return [];
    }
}