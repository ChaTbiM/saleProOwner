<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Sanfora extends Model
{
    protected $connection = "sanfora";
    protected $table = "warehouses";
    
    protected $fillable =[

        "name", "phone", "email", "address", "is_active"
    ];

}
