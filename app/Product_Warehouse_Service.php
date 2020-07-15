<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Warehouse_Service extends Model
{
    protected $table = 'product_warehouse';
    protected $connection = "service";

    protected $fillable =[

        "product_id", "varinat_id", "warehouse_id", "qty"
    ];

    public function scopeFindProductWithVariant($query, $product_id, $variant_id, $warehouse_id)
    {
    	return $query->where([
            ['product_id', $product_id],
            ['variant_id', $variant_id],
            ['warehouse_id', $warehouse_id]
        ]);
    }

    public function scopeFindProductWithoutVariant($query, $product_id, $warehouse_id)
    {
    	return $query->where([
            ['product_id', $product_id],
            ['warehouse_id', $warehouse_id]
        ]);
    }

    public function scopeWarehouseNumberOfProducts($query,$warehouse_id){
        return $query->join('products', 'product_warehouse.product_id', '=', 'products.id')
        ->where([ ['product_warehouse.warehouse_id', $warehouse_id],
                  ['products.is_active', true]
        ])->count();
    }

    public function scopeWarehouseStockQuantity($query,$warehouse_id){
        return $query->join('products', 'product_warehouse.product_id', '=', 'products.id')
        ->where([ ['product_warehouse.warehouse_id', $warehouse_id],
                  ['products.is_active', true]
        ])->sum('product_warehouse.qty',$warehouse_id);
    }
}
