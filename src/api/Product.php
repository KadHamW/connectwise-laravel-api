<?php

namespace Kadhamw\ConnectAPI\API;

use Kadhamw\ConnectAPI\Connection;

class Product
{
    public static function postProduct(int $catalog_cwid, string $customer_desc, int $quantity, int $price, int $cost, int $opp_cwid, int $locationID, int $businessUnitId, string $description = ""){
        $conn = new Connection();
        $data = [
            "catalogItem" => [
                "id" => $catalog_cwid,
            ],
            "description" => $description,
            "quantity" => $quantity,
            "price" => $price,
            "cost" => $cost,
            "customerDescription" => $customer_desc,
            "billableOption" => "Billable",
            "opportunity" => [
                "id" => $opp_cwid,
            ],
            "locationId" => $locationID,
            "businessUnitId" => $businessUnitId,
        ];

        $result = json_decode($conn->request('procurement/products', $data));
        return $result;
    }

    public static function getProductsCount(){
        $conn = new Connection();
        $result = $conn->request('procurement/products/count');
        return json_decode($result)->count;
    }

    public static function getProducts(){
        $count = Product::getProductsCount();
        $pages = (int)ceil($count / 100);
        $_products = [];
        for ($i=1; $i <= $pages; $i++) {
            $conn = new Connection();
            $result = $conn->request('procurement/products/?pagesize=100&page='.$i);
            $tmp_products = json_decode($result);
            foreach($tmp_products as $tmp_product){
                $_products[] = $tmp_product;
            }
        }
        return $_products;
    }

    public static function putProduct(int $product_cwid, string $customer_desc, int $quantity, int $price, int $cost, int $opp_cwid, int $locationID, int $businessUnitId, string $description = ""){
        $conn = new Connection();
        $data = [
            "description" => $description,
            "quantity" => $quantity,
            "price" => $price,
            "cost" => $cost,
            "customerDescription" => $customer_desc,
            "billableOption" => "Billable",
            "opportunity" => [
                "id" => $opp_cwid,
            ],
            "locationId" => $locationID,
            "businessUnitId" => $businessUnitId,
        ];

        $result = $conn->request('procurement/products/'.$product_cwid, $data, "PUT");
        dd($result);
    }
}
