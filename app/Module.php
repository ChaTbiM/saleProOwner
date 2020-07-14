<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    public function companies()
    {
        return $this->belongsToMany('App\Company', 'companies_modules', 'module_id', 'company_id');
    }


     
}
