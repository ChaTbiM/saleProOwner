<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    public function modules()
    {
        return $this->belongsToMany('App\Module', 'companies_modules', 'company_id', 'module_id');
    }
    
}
