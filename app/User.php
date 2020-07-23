<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
// use App\Module;
use DB;
use App\CompanyPermissions;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"phone","company_name", "role_id", "biller_id", "warehouse_id", "is_active", "is_deleted"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companies()
    {
        return $this->belongsToMany('App\Company', 'users_companies', 'user_id', 'company_id');
    }

    public function isActive()
    {
        return $this->is_active;
    }


    // Logic
    // Itereate over the 11 module 
    public function giveUserPermissions($companies,$user_id){
        foreach($companies as  $company_modules){ 
            foreach($company_modules as $company_name => $company_module){
                foreach($company_module as $company_permissions){
                    if($company_permissions != 4){
                        foreach($company_permissions as $company_permission){
                            $result = CompanyPermissions::create(['user_id' => $user_id,'permission_name'=>$company_permission,'company_name'=>$company_name]);
                    }
                    }

                }
            }
        }
    }


}
