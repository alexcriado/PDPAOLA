<?php

namespace App\Services\Interfaces;
use App\Models\Product;

interface IProductInterface
{
    /**
     * @return Product $product
     */
    function getProduct();

    /**
     * @param int $id
     * @return Product $product
     */
    function getProductById(int $id);

    /**
     * @param array $product
     * @return boolean
     */
    function postProduct(array $product);

    /**
     * @param array $poduct 
     * @param int $id
     * @return boolean
     */
    function putProduct(array $product, $id);

    /**
     * @param int $id
     * @return boolean
     */
    function deleteProduct(int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function restoreProduct($id);
}