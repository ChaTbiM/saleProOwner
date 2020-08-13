<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Biller;
use App\Warehouse;
use App\Company;
use App\Module;
// use App\GeneralSetting;
use Hash;
use Keygen\Keygen;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);

        if ($role->id != 3) {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }


        if ($role->hasPermissionTo('users-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission) {
                $all_permission[] = $permission->name;
            }
            $lims_user_list = User::where('is_deleted', false)->get();
            return view('user.index', compact('lims_user_list', 'all_permission'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }
    }

    public function create()
    {
        // all companies , modules
        $companies = Company::all();
        $all_modules = Module::all();

        //comapnies modules
        foreach ($companies as $company) {
            $companies_modules[$company->name] = $company->modules->pluck('name', 'name')->toArray();
        }


        //all permissions according to all modules
        foreach ($all_modules as $module) {
            $module_permissions = $module->name . 'Permissions';

            $all_permissions[$module->name] = $module->$module_permissions();
        }

        foreach ($companies_modules as $company_name => $company_modules) {
            if (!empty($company_modules)) {
                foreach ($company_modules as $company_module) {
                    $companies_permissions[$company_name][$company_module] = $all_permissions[$company_module];
                }
            } else {
                $companies_permissions[$company_name] = null;
            }
        }

        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('users-add')) {
            $lims_role_list = Roles::where('is_active', true)->where('name', '!=', 'ceo')->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            return view('user.create', compact('lims_role_list', 'lims_biller_list', 'lims_warehouse_list', 'companies', 'companies_permissions'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }
    }

    public function generatePassword()
    {
        $id = Keygen::numeric(6)->generate();
        return $id;
    }

    public function store(Request $request)
    {
        $companies = $request->only('companies');
        
        foreach ($companies["companies"] as $company_name => $company) {
            if (count($company)=== 1) {
                unset($companies["companies"][$company_name]);
            }
        }
        

        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);

        $data = $request->all();
        $data['role_id'] = 1;
        $message = 'User created successfully';

        if (!isset($data['is_active'])) {
            $data['is_active'] = false;
        }
        $data['is_deleted'] = false;
        $data['password'] = bcrypt($data['password']);

        try {
            DB::transaction(function () use ($data,$companies) {
                $user = User::create($data);
                $user_id = $user->id;
                $hygiene_id = DB::select('select * from companies where name = ?', ['hygiene'])[0]->id;
                $sweet_id = DB::select('select * from companies where name = ?', ['sweet'])[0]->id;
                $sanfora_id = DB::select('select * from companies where name = ?', ['sanfora'])[0]->id;
                $hafko_id = DB::select('select * from companies where name = ?', ['hafko'])[0]->id;
                $service_id = DB::select('select * from companies where name = ?', ['service'])[0]->id;
                $goods_id = DB::select('select * from companies where name = ?', ['goods'])[0]->id;


                if (isset($companies["companies"]['hygiene'])) {
                    DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $hygiene_id]);
                
                    $role_id = $companies["companies"]['hygiene']['role'];
                    DB::insert('insert into company_has_user_has_roles (user_id,company_name,role_id) value (?,?,?)', [$user_id,"hygiene",$role_id]);
                }

                if (isset($companies["companies"]['sweet'])) {
                    $role_id = $companies["companies"]['sweet']['role'];

                    DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $sweet_id]);

                    DB::insert('insert into company_has_user_has_roles (user_id,company_name,role_id) value (?,?,?)', [$user_id,"sweet",$role_id]);
                }

                if (isset($companies["companies"]['sanfora'])) {
                    $role_id = $companies["companies"]['sanfora']['role'];

                    DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $sanfora_id]);
                
                    DB::insert('insert into company_has_user_has_roles (user_id,company_name,role_id) value (?,?,?)', [$user_id,"sanfora",$role_id]);
                }

                if (isset($companies["companies"]['hafko'])) {
                    $role_id = $companies["companies"]['hafko']['role'];

                    DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $hafko_id]);

                    DB::insert('insert into company_has_user_has_roles (user_id,company_name,role_id) value (?,?,?)', [$user_id,"hafko",$role_id]);
                }

                if (isset($companies["companies"]['service'])) {
                    $role_id = $companies["companies"]['service']['role'];

                    DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $service_id]);
                
                    DB::insert('insert into company_has_user_has_roles (user_id,company_name,role_id) value (?,?,?)', [$user_id,"service",$role_id]);
                }

                if (isset($companies["companies"]['goods'])) {
                    $role_id = $companies["companies"]['goods']['role'];

                    DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $goods_id]);
                    DB::insert('insert into company_has_user_has_roles (user_id,company_name,role_id) value (?,?,?)', [$user_id,"goods",$role_id]);
                }



                $user->giveUserPermissions($companies, $user_id);
            });
        } catch (\Throwable $th) {
            $message = "error creating user, please try again.";
        }


        //sending email
        try {
            Mail::send('mail.user_details', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject('User Account Details');
            });
        } catch (\Exception $e) {
            $message = 'User created successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }

        return redirect('user')->with('message1', $message);
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        // list of companies , each have a list of modules and each have a list of permissions
        $companies = Company::all();
        $all_permissions = Permission::all()->pluck("name", "name")->toArray();

        // remove CEO SPECIAL PERMISSIONS
        unset($all_permissions["modules-index"]);
        unset($all_permissions["modules-edit"]);

        global $activated_permissions, $desactivated_permissions;
        $this->retrievePermissions($companies, $id);

        if ($role->hasPermissionTo('users-edit')) {
            $lims_user_data = User::find($id);

            // foreach ($lims_user_data->companies as $company) {
            //     $companies[$company->name] = $company->name;
            // }
            $companies = collect($companies)->pluck("name", "name")->toArray();
            $user_companies = collect(User::find($id)->companies)->pluck("name", "name")->toArray();

            $lims_role_list = Roles::where('is_active', true)->where('name', '!=', 'ceo')->get();
            
            
            $role = DB::select('select * from company_has_user_has_roles where (company_name,user_id) = (?,?)', ["hygiene",$id]);
            if (!empty($role)) {
                $roles["hygiene"] = (string) $role[0]->role_id;
            }


            $role = DB::select('select * from company_has_user_has_roles where (company_name,user_id) = (?,?)', ["sweet",$id]);
            if (!empty($role)) {
                $roles["sweet"] = (string) $role[0]->role_id;
            }

            $role = DB::select('select * from company_has_user_has_roles where (company_name,user_id) = (?,?)', ["hafko",$id]);
            if (!empty($role)) {
                $roles["hafko"] = (string) $role[0]->role_id;
            }


            $role = DB::select('select * from company_has_user_has_roles where (company_name,user_id) = (?,?)', ["sanfora",$id]);
            if (!empty($role)) {
                $roles["sanfora"] = (string)  $role[0]->role_id;
            }

            $role = DB::select('select * from company_has_user_has_roles where (company_name,user_id) = (?,?)', ["service",$id]);
            if (!empty($role)) {
                $roles["service"] = (string)  $role[0]->role_id;
            }

            $role = DB::select('select * from company_has_user_has_roles where (company_name,user_id) = (?,?)', ["goods",$id]);
            if (!empty($role)) {
                $roles["goods"] = (string)  $role[0]->role_id;
            }


            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            return view('user.edit', compact('lims_user_data', 'roles', 'lims_role_list', 'lims_biller_list', 'lims_warehouse_list', 'user_companies', 'companies', 'activated_permissions', 'desactivated_permissions'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }
    }

    public function update(Request $request, $id)
    {
        if (!config("user.user_verified")) {
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        }

        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);

        $companies = User::find($id)->companies->pluck('name', 'name')->toArray();

        // update roles
        // get all current user roles
        $old_role["hygiene"] = DB::select('select * from  company_has_user_has_roles where (company_name,user_id) = (?,?)', ["hygiene",$id]);
        if (!empty($old_role["hygiene"])) {
            $old_roles["hygiene"] =  $old_role["hygiene"];
        }

        $old_role["sweet"] = DB::select('select * from  company_has_user_has_roles where (company_name,user_id) = (?,?)', ["sweet",$id]);
        if (!empty($old_role["sweet"])) {
            $old_roles["sweet"] =  $old_role["sweet"];
        }


        $old_role["sanfora"] = DB::select('select * from  company_has_user_has_roles where (company_name,user_id) = (?,?)', ["sanfora",$id]);
        if (!empty($old_role["sanfora"])) {
            $old_roles["sanfora"] =  $old_role["sanfora"];
        }

        $old_role["hafko"] = DB::select('select * from  company_has_user_has_roles where (company_name,user_id) = (?,?)', ["hafko",$id]);
        if (!empty($old_role["hafko"])) {
            $old_roles["hafko"] =  $old_role["hafko"];
        }

        $old_role["service"] = DB::select('select * from  company_has_user_has_roles where (company_name,user_id) = (?,?)', ["service",$id]);
        if (!empty($old_role["service"])) {
            $old_roles["service"] =  $old_role["service"];
        }

        $old_role["goods"] = DB::select('select * from  company_has_user_has_roles where (company_name,user_id) = (?,?)', ["goods",$id]);
        if (!empty($old_role["goods"])) {
            $old_roles["goods"] =  $old_role["goods"];
        }


        $updated_companies = ['hygiene' =>  $request->hygiene, 'sweet' =>  $request->sweet, 'hafko' =>  $request->hafko, 'sanfora' => $request->sanfora, 'service' =>  $request->service, 'goods' =>  $request->goods];

        $removed_companies = array_diff($companies, $updated_companies);
        $added_companies = array_diff($updated_companies, $companies);

        
        // dd($request);
        // update Removed Companies
        foreach ($removed_companies as $company_key => $company_value) {
            if (isset($company_value)) {
                $company_id = Company::where('name', $company_value)->get()[0]->id;
                try {
                    DB::table('users_companies')->where("company_id", '=', $company_id)->where('user_id', '=', $id)->delete();
                    DB::table("company_has_user_has_permissions")->where("company_name", "=", $company_key)->where("user_id", "=", $id)->delete();
                } catch (\Throwable $th) {
                    return redirect('user')->with('message2', 'user was not removed from company ' . $company_value);
                }
            }
        }

        // Update Added Compnies
        foreach ($added_companies as $company_key => $company_value) {
            if (isset($company_value)) {
                $company_id = Company::where('name', $company_value)->get()[0]->id;
                try {
                    DB::insert('insert into users_companies (company_id, user_id) values (?, ?)', [$company_id, $id]);
                } catch (\Throwable $th) {
                    return redirect('user')->with('message2', 'user was not assigned to company ' . $company_value);
                }
            }
        }

        // update Permissions
        $companies = User::find($id)->companies;
        global $activated_permissions;
        $this->retrievePermissions($companies, $id);

        $updated_permissions = $request->companies;
        
        foreach ($updated_permissions as $company_name => $company) {
            if (isset($old_roles[$company_name][0]) &&  !isset($company['role'])) {
                $updated_roles[$company_name] = $company['role'];
                DB::table("company_has_user_has_roles")->where('id', $old_roles[$company_name][0]->id)->delete();
            } elseif (empty($old_roles[$company_name]) && isset($company['role'])) {
                $updated_roles[$company_name] = $company['role'];
            }

            
            unset($updated_permissions[$company_name]['role']);
        }

        
        if (isset($updated_roles)) {
            foreach ($updated_roles as $company_name => $role) {
                if (isset($role)) {
                    DB::insert('insert into  company_has_user_has_roles (user_id, company_name,role_id) values (?, ?,?)', [$id, $company_name,$role]);
                }
            }
        }
            


        $all_permissions = Permission::all()->pluck("name", "name")->toArray();
        // remove CEO SPECIAL PERMISSIONS
        unset($all_permissions["modules-index"]);
        unset($all_permissions["modules-edit"]);

        if (!empty($updated_permissions)) {
            foreach ($updated_permissions as $company => $modules) {
                foreach ($modules as $module_name => $module) {
                    if (isset($updated_permissions[$company][$module_name]) && isset($activated_permissions[$company][$module_name])) {
                        $added_permissions[$company][$module_name] = array_diff_key($updated_permissions[$company][$module_name], $activated_permissions[$company][$module_name]);

                        $removed_permissions[$company][$module_name] = array_diff_key($activated_permissions[$company][$module_name], $updated_permissions[$company][$module_name]);
                    }

                    if (!empty($updated_permissions[$company]) && !empty($activated_permissions[$company])) {
                        $removed_modules[$company] = array_diff_key($activated_permissions[$company], $updated_permissions[$company]);
                    }
                    
                    if (empty($updated_permissions)) {
                        $updated_permissions = array();
                    }
        
                    if (empty($activated_permissions)) {
                        $activated_permissions = array();
                    }
                    
                   
              
                    $removed_all = array_diff_key($activated_permissions, $updated_permissions);
                }
            }


            // added Permissions
            if (isset($added_permissions)) {
                foreach ($added_permissions as $company => $modules) {
                    foreach ($modules as $modules_name => $permissions) {
                        foreach ($permissions as $permission) {
                            try {
                                DB::table("company_has_user_has_permissions")->insert(['user_id' => $id, 'company_name' => $company, 'permission_name' => $permission]);
                            } catch (\Throwable $th) {
                                continue;
                            }
                        }
                    }
                }
            }

            // removed permissions
            if (isset($removed_permissions)) {
                foreach ($removed_permissions as $company_name => $modules) {
                    foreach ($modules as $module_name => $module) {
                        foreach ($module as $permission) {
                            $this->deletePermission($permission, $company_name, $id);
                        }
                    }
                }
            }

            if (isset($removed_modules)) {
                foreach ($removed_modules as $company_name => $modules) {
                    foreach ($modules as $module_name => $module) {
                        foreach ($module as $permission) {
                            $this->deletePermission($permission, $company_name, $id);
                        }
                    }
                }
            }

            if (isset($removed_all)) {
                foreach ($removed_all as $company_name => $modules) {
                    foreach ($modules as $module_name => $module) {
                        foreach ($module as $permission) {
                            $this->deletePermission($permission, $company_name, $id);
                        }
                    }
                }
            }
        }


        $input = $request->except('password');
        if (!isset($input['is_active'])) {
            $input['is_active'] = false;
        }
        if (!empty($request['password'])) {
            $input['password'] = bcrypt($request['password']);
        }
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);

      
        return redirect('user')->with('message2', 'Data updated successfullly');
    }

    public function profile($id)
    {
        $lims_user_data = User::find($id);
        return view('user.profile', compact('lims_user_data'));
    }

    public function profileUpdate(Request $request, $id)
    {
        if (!config("user.user_verified")) {
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        }

        $input = $request->all();
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);
        return redirect()->back()->with('message3', 'Data updated successfullly');
    }

    public function changePassword(Request $request, $id)
    {
        if (!config("user.user_verified")) {
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        }

        $input = $request->all();
        $lims_user_data = User::find($id);
        if ($input['new_pass'] != $input['confirm_pass']) {
            return redirect("user/" .  "profile/" . $id)->with('message2', "Please Confirm your new password");
        }

        if (Hash::check($input['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($input['new_pass']);
            $lims_user_data->save();
        } else {
            return redirect("user/" .  "profile/" . $id)->with('message1', "Current Password doesn't match");
        }
        auth()->logout();
        return redirect('/');
    }

    public function deleteBySelection(Request $request)
    {
        $user_id = $request['userIdArray'];
        foreach ($user_id as $id) {
            $lims_user_data = User::find($id);
            $lims_user_data->is_deleted = true;
            $lims_user_data->is_active = false;
            $lims_user_data->save();
        }
        return 'User deleted successfully!';
    }

    public function destroy($id)
    {
        if (!config("user.user_verified")) {
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        }

        $lims_user_data = User::find($id);
        $lims_user_data->is_deleted = true;
        $lims_user_data->is_active = false;
        $lims_user_data->save();
        if (Auth::id() == $id) {
            auth()->logout();
            return redirect('/login');
        } else {
            return redirect('user')->with('message3', 'Data deleted successfullly');
        }
    }


    // -----------------------------

    public function constructPermissions($company, $company_module, $id, $permissions)
    {
        $company_name = $company->name;
        global $desactivated_permissions, $activated_permissions;
        $activated_permissions[$company->name][$company_module->name] = $company->get_active_permissions($id, $permissions, $company_name);

        $desactivated_permissions[$company->name][$company_module->name] =  array_diff($permissions, $activated_permissions["$company->name"]["$company_module->name"]);
        if ($company->name == "sanfora") {
        }
        // return ["active" => $activated_permissions, "disabled" => $desactivated_permissions];
    }






    public function retrievePermissions($companies, $id)
    {
        foreach ($companies as  $company) {
            $companies_modules["$company->name"] = $company->modules;
            foreach ($companies_modules["$company->name"] as $company_module) {
                switch ($company_module->name) {
                    case 'product':
                        $permissions = $company->productPermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'purchase':
                        $permissions = $company->purchasePermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'sale':
                        $permissions = $company->salePermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'expense':
                        $permissions = $company->expensePermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'quote':
                        $permissions = $company->quotePermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'transfer':
                        $permissions = $company->transferPermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'return':
                        $permissions = $company->returnPermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'accounting':
                        $permissions = $company->accountingPermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'hrm':
                        $permissions = $company->hrmPermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'people':
                        $permissions = $company->peoplePermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    case 'report':
                        $permissions = $company->reportPermissions();
                        $this->constructPermissions($company, $company_module, $id, $permissions);
                        break;
                    default:
                        break;
                }
            }
        }
    }


    public function deletePermission($permission, $company_name, $id)
    {
        try {
            DB::table("company_has_user_has_permissions")->where("permission_name", "=", $permission)->where("company_name", "=", $company_name)->where("user_id", "=", $id)->delete();
        } catch (\Throwable $th) {
            return null;
        }
    }
}
