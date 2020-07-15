<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biller_Hafko extends Model
{
    protected $table = "billers";
    protected $connection = "hafko";

    protected $fillable =[
        "name", "image", "company_name", "vat_number",
        "email", "phone_number", "address", "city",
        "state", "postal_code", "country", "is_active"
    ];

}