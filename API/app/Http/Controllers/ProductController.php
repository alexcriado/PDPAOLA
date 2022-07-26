<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementation\ProductServiceImpl;
use App\Validators\ProductValidator;

class ProductController extends Controller
{
    /**
     * @var ProductServiceImpl
     */
    private $productService;
    /**
     * @var Request
     */
    private $request;
    /** 
     * @var ProductValidator
     */
    private $validator;
    public function __construct(ProductServiceImpl $productService, Request $request, ProductValidator $productValidator)
    {
        $this->productService = $productService;
        $this->request = $request;
        $this->validator = $productValidator;
    }

    function createProduct()
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
            $this->productService->postProduct($this->request->all());
        }

        return $response;
    }

    function getListProduct()
    {
        return response($this->productService->getProduct()->where('deleted_at', NULL));
    }

    function putProduct(int $id)
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
            $this->productService->putProduct($this->request->all(), $id);
        }

        return $response;
    }

    function deleteProduct(int $id)
    {
        $this->productService->deleteProduct($id);

        return response("", 204);
    }

    function restoreProduct(int $id)
    {
        $this->productService->restoreProduct($id);

        return response("", 204);
    }
}
