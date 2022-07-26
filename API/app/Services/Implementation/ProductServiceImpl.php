<?php

namespace App\Services\Implementation;
use App\Models\Product;
use App\Services\Interfaces\IProductInterface;

class ProductServiceImpl implements IProductInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Product();
    }

    /**
     * @return Product $product
     */
    function getProduct()
    {
        return $this->model->withTrashed()->get();
    }

    /**
     * @param int $id
     * @return Product $product
     */
    function getProductById(int $id)
    {
    }

    /**
     * @param array $product
     * @return boolean
     */
    function postProduct(array $product)
    {
        $this->model->create($product);
    }

    /**
     * @param array $poduct 
     * @param int $id
     * @return boolean
     */
    function putProduct(array $product, $id)
    {
        $this->model->where('id', $id)
            ->first()
            ->fill($product)
            ->save();
    }

    /**
     * @param int $id
     * @return boolean
     */
    function deleteProduct(int $id)
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
    function restoreProduct($id)
    {
        $user = $this->model->withTrashed()->find($id);

        if ($user != null) {
            $user->restore();
        }
    }
}