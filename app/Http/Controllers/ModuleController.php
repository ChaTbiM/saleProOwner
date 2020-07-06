<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Company;
use App\Module;
use Auth;
use DB;


class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);

        if ($role->hasPermissionTo('modules-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->get();

            $companies = Company::all();

            return view('module.index', compact('companies', 'role'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('modules-edit')) {
            $company = Company::find($id);
            $company_name = $company->name;
            $company_modules = ($company->modules)->pluck('name', 'name')->toArray();
            $all_modules = Module::all()->pluck('name', 'name')->toArray();
            $desactivated_modules =  array_diff($all_modules, $company_modules); // modules that are not activated 

            return view('module.edit', compact('company_name', 'company_modules', 'desactivated_modules', 'company', 'role'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $all_modules = Module::all()->pluck('name', 'name')->toArray();
        $company = Company::find($id);
        $company_modules = $company->modules->pluck('name', 'name')->toArray();

        foreach ($all_modules as $module) {
            $updated_modules[$module] = $request[$module];
        }

        $desactivated_modules = array_diff($company_modules, $updated_modules);
        $activated_modules = array_diff($updated_modules, $company_modules);

        // desactivate modules for a company
        foreach ($desactivated_modules as $module_key => $module_value) {
            if (isset($module_value)) {

                try {
                    $module = Module::where('name', '=', $module_value)->get()[0];
                    $module_id = $module->id;
                    $found_company_relation = DB::table('companies_modules')->where("company_id", '=', $id)->where('module_id', '=', $module_id)->delete();
                } catch (\Throwable $th) {
                    return redirect('module')->with('message2', $module->name .  ' module is not desactivated for company ' . $company->name);
                }
            }
        }

        // Activate a module for a company
        foreach ($activated_modules as $module_key => $module_value) {
            if (isset($module_value)) {

                try {
                    $module = Module::where('name', '=', $module_value)->get()[0];
                    $module_id = $module->id;
                    DB::insert('insert into companies_modules (company_id, module_id) values (?, ?)', [$id, $module_id]);
                } catch (\Throwable $th) {
                    return redirect('module')->with('message2', $module->name . ' module is not activated for company ' . $company->name);
                }
            }
        }

        return redirect('module')->with('message2', 'Data updated successfullly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
