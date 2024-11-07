<?php

namespace App\Repositories;

use Exception;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{
    public function allProducts($search)
    {
        return Product::when($search, function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(10);
    }

    public function storeProduct($data)
    {
        DB::beginTransaction();

        try{
            $product = Product::create([
                'name'  =>  $data->name,
                'price' =>  $data->price,
                'quantity' => $data->quantity,
            ]);

            DB::commit();

            return true;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }

    }

    public function getProductDetails($id)
    {
        return Product::firstWhere('id',$id);
    }

    public function updateProduct($data, $id)
    {
        DB::beginTransaction();

        try{
            $product = Product::firstWhere('id', $id);
            $product->update([
                'name'  =>  $data->name,
                'price' =>  $data->price,
                'quantity' =>  $data->quantity,
            ]);

            DB::commit();

            return true;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function destroyProduct($id)
    {
        $product = Product::firstWhere('id', $id);
        if(isset($product)){
            $status = $product->delete();
        }else{
            $status = false;
        }

        return $status;
    }
}
