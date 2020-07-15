<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse_Sweet extends Model
{
    protected $connection = "sweet";
    protected $table = "warehouses";
    
    protected $fillable =[

        "name", "phone", "email", "address", "is_active"
    ];

}
