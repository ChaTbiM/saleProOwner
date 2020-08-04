<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    //
    protected $fillable =[
        "name", "image", "company_name", "vat_number",
        "from_company",
        "email", "phone_number", "address", "city",
        "state", "postal_code", "country", "is_active"
    ];
}
