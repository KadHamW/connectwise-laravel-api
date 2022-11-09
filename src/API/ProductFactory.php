<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

use Kadhamw\ConnectAPI\Models\Product;

class ProductFactory
{
    public static function postProduct(Product $product){
        $conn = new Connection();
        $data = [
            "catalogItem" => [
                "id" => $product->catalog_cwid,
            ],
            "description" => $product->description,
            "quantity" => $product->quantity,
            "price" => $product->price,
            "cost" => $product->cost,
            "customerDescription" => $product->customer_desc,
            "billableOption" => "Billable",
            "opportunity" => [
                "id" => $product->opp_cwid,
            ],
            "locationId" => $product->locationID,
            "businessUnitId" => $product->businessUnitId,
        ];

        $result = json_decode($conn->request('procurement/products', $data));
        return $result;
    }

    public static function getProductsCount(){
        $conn = new Connection();
        $result = $conn->request('procurement/products/count');
        return json_decode($result)->count;
    }
    public static function getProduct($identifier){
        $var = str_replace(' ', '%20', $identifier);
        $conn = new Connection();
        $url_count = 'procurement/products/count/?conditions=catalogItem/identifier="'.$var.'"';
        //dd($url);
        $result_ = $conn->request($url_count);
        $count = json_decode($result_)->count;
        $pages = (int)ceil($count / 100);
        $_products = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('procurement/products/?pagesize=100&page='.$i.'&conditions=catalogItem/identifier="'.$var.'"');
            $tmp_products = json_decode($result);
            foreach($tmp_products as $tmp_product){
                $_products[] = $tmp_product;
            }
        }
        return $_products;

    }
    public static function getProducts(){
        $count = ProductFactory::getProductsCount();
        $pages = (int)ceil($count / 100);
        $_products = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('procurement/products/?pagesize=100&page='.$i);
            $tmp_products = json_decode($result);
            foreach($tmp_products as $tmp_product){

                if($tmp_product->catalogItem->identifier == "MSP Bronze"){
                dd($tmp_product);
                }

                $_products[] = $tmp_product;
            }
        }
        return $_products;
    }

    public static function putProduct(Product $product){
        $conn = new Connection();
        $data = [
            "catalogItem" => [
                "id" => $product->catalog_cwid,
            ],
            "description" => $product->description,
            "quantity" => $product->quantity,
            "price" => $product->price,
            "cost" => $product->cost,
            "customerDescription" => $product->customer_desc,
            "billableOption" => "Billable",
            "opportunity" => [
                "id" => $product->opp_cwid,
            ],
            "locationId" => $product->locationID,
            "businessUnitId" => $product->businessUnitId,
        ];

        $result = json_decode($conn->request('procurement/products/'.$product->product_cwid, $data, "PUT"));
        return($result);
    }

    public static function deleteProduct($product_id) {
        $conn = new Connection();
        $result = json_decode($conn->request('procurement/products/'.$product_id, [], "DELETE"));
        if (is_null($result)) {return true;} else { return false;}
    }
}
