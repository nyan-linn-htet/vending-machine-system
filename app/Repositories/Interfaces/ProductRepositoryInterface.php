<?php
namespace App\Repositories\Interfaces;

Interface ProductRepositoryInterface {

    public function allProducts($search);
    public function storeProduct($data);
    public function getProductDetails($id);
    public function updateProduct($data, $id);
    public function destroyProduct($id);
}
