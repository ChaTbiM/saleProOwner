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


    
    // Permissions per module
    public function productPermissions()
    {
        $permissions = ['products-index', 'products-edit', 'products-add', 'products-delete','print_barcode','adjustment','stock_count'];
 
        return $permissions;
    }

    public function servicePermissions()
    {
        $permissions = ['services-index', 'services-edit', 'services-add', 'services-delete'];

        return $permissions;
    }
 
 
    public function purchasePermissions()
    {
        $permissions = ['purchases-index', 'purchases-edit', 'purchases-add', 'purchases-delete'];
 
        return $permissions;
    }
 
    public function salePermissions()
    {
        $permissions = ['sales-index', 'sales-edit', 'sales-add', 'sales-delete', 'gift-card', 'coupon'];
 
        return $permissions;
    }
 
    public function expensePermissions()
    {
        $permissions = ['expenses-index', 'expenses-add'];
 
        return $permissions;
    }
 
    public function quotePermissions()
    {
        $permissions = ['quotes-index', 'quotes-edit', 'quotes-add', 'quotes-delete'];
 
        return $permissions;
    }
 
    public function transferPermissions()
    {
        $permissions = ['transfers-index', 'transfers-edit', 'transfers-add', 'transfers-delete'];
 
        return $permissions;
    }
 
    public function returnPermissions()
    {
        $permissions = ['returns-index', 'returns-edit', 'returns-add', 'returns-delete'];
 
        return $permissions;
    }
 
    public function accountingPermissions()
    {
        $permissions = ['account-index', 'account-statement', 'money-transfer', 'balance-sheet'];
 
        return $permissions;
    }
 
    public function hrmPermissions()
    {
        $permissions = ['department', 'employees-index','employees-add','employees-edit','employees-delete', 'attendance', 'payroll', 'holiday'];
 
        return $permissions;
    }
 
    public function peoplePermissions()
    {
        $permissions = ['users-index', 'users-add', 'customers-index', 'customers-add', 'billers-index', 'billers-add','billers-edit', 'billers-delete','suppliers-index', 'suppliers-add'];
 
        return $permissions;
    }
 
 
 
    public function reportPermissions()
    {
        $permissions = ['profit-loss', 'best-seller',  'warehouse-report', 'warehouse-stock-report', 'product-report', 'daily-sale', 'monthly-sale', 'daily-purchase', 'monthly-purchase', 'purchase-report', 'sale-report', 'payment-report', 'product-qty-alert', 'customer-report', 'supplier-report', 'due-report','best-seller-service' , 'service-report' , 'monthly-service-sale'];

        return $permissions;
    }
}
