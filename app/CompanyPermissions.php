<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyPermissions extends Model
{
    //


    protected $table = 'company_has_user_has_permissions';

    protected $fillable = ['company_name','permission_name','user_id'];


    // App\User::find(15)->hasPermissionTo($permission[0]->name) && App\CompanyPermissions::where('user_id','=',15)->where('company_id','=',1)->where('permission_id','=',$permission[0]->id);

}
