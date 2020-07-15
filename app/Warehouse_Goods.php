<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Goods extends Model
{
    protected $connection = "goods";
    protected $table = "warehouses";
    
    protected $fillable =[

        "name", "phone", "email", "address", "is_active"
    ];

}
