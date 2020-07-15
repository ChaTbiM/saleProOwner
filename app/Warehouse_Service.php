<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Service extends Model
{
    protected $connection = "service";
    protected $table = "warehouses";
    
    protected $fillable =[

        "name", "phone", "email", "address", "is_active"
    ];

}
