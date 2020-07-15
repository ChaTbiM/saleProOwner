<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Hafko extends Model
{
    protected $connection = "hafko";
    protected $table = "warehouses";
    
    protected $fillable =[

        "name", "phone", "email", "address", "is_active"
    ];

}
