<?php

namespace G28\ThriveCartMemberKit;

use ThriveCart\Api;

class Thrivecart
{
    private $client;
    const THRIVECART_API_KEY = '13IKAEYV-JSCUFXPI-AONUCONY-2ZA822Q9';
    public function __construct()
    {
        $this->client = new Api(self::THRIVECART_API_KEY);
    }

    public function list_products(): array
    {
        $products = [];
        try {
            $response = $this->client->getProducts();
            foreach ($response as $p) {
                $products[] = [
                    'id' => $p['product_id'],
                    'name' => $p['name'],
                ];
            }
        } catch (\Exception $e) {
            Logger::getInstance()->add("ERROR | Thrivecart getProducts => " . $e->getMessage());
        }
        return $products;
    }
}