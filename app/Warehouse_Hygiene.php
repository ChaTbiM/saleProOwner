<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Hygiene extends Model
{
    protected $connection = "hygiene";
    protected $table = "warehouses";
    
    protected $fillable =[

        "name", "phone", "email", "address", "is_active"
    ];
}
