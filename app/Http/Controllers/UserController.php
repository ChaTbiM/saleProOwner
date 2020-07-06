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

        if ($role->hasPermissionTo('users-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->get();
            return view('user.index', compact('lims_user_list', 'all_permission'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {

        // all companies , modules
        $companies = Company::all();
        $all_modules = Module::all();

        //comapnies modules 
        foreach($companies as $company){
            $companies_modules[$company->name] = $company->modules->pluck('name','name')->toArray();
        }

        
        //all permissions according to all modules
        foreach($all_modules as $module){
            $module_permissions = $module->name.'Permissions';
            $all_permissions[$module->name] = $module->$module_permissions();
        }

        foreach($companies_modules as $company_name => $company_modules){

            if(!empty($company_modules)){
                foreach($company_modules as $company_module){
                    $companies_permissions[$company_name][$company_module] = $all_permissions[$company_module]; 
                }
            }else {
                $companies_permissions[$company_name] = null;
            }
        }

        // $test = $companies_permissions['hygiene']['product'][0];
        // $splited = explode('-',$test); 
        // $splited[1] = 'list';
        // $string = implode(' ', $splited);
        // dd($string);

        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('users-add')) {
            $lims_role_list = Roles::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            return view('user.create', compact('lims_role_list', 'lims_biller_list', 'lims_warehouse_list','companies','companies_permissions'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function generatePassword()
    {
        $id = Keygen::numeric(6)->generate();
        return $id;
    }

    public function store(Request $request)
    {

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
        $message = 'User created successfully';

        if (!isset($data['is_active']))
            $data['is_active'] = false;
        $data['is_deleted'] = false;
        $data['password'] = bcrypt($data['password']);


        try {
            $user = User::create($data);
            $user_id = $user->id;
            $hygiene_id = DB::select('select * from companies where name = ?', ['hygiene'])[0]->id;
            $sweet_id = DB::select('select * from companies where name = ?', ['sweet'])[0]->id;
            $sanfora_id = DB::select('select * from companies where name = ?', ['sanfora'])[0]->id;
            $hafko_id = DB::select('select * from companies where name = ?', ['hafko'])[0]->id;
            $service_id = DB::select('select * from companies where name = ?', ['service'])[0]->id;
            $goods_id = DB::select('select * from companies where name = ?', ['goods'])[0]->id;


            if ($request->hygiene || $request->all) {
                DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $hygiene_id]);
            }

            if ($request->sweet || $request->all) {
                DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $sweet_id]);
            }

            if ($request->sanfora || $request->all) {
                DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $sanfora_id]);
            }

            if ($request->hafko || $request->all) {
                DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $hafko_id]);
            }

            if ($request->service || $request->all) {
                DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $service_id]);
            }

            if ($request->goods || $request->all) {
                DB::insert('insert into users_companies (user_id, company_id) values (?, ?)', [$user_id, $goods_id]);
            }
        } catch (\Throwable $th) {
            $message = "error creating user, please try again.";
        }


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
        if ($role->hasPermissionTo('users-edit')) {
            $lims_user_data = User::find($id);

            foreach ($lims_user_data->companies as $company) {
                $companies[$company->name] = $company->name;
            }
            $companies = collect($companies);

            $lims_role_list = Roles::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();

            return view('user.edit', compact('lims_user_data', 'lims_role_list', 'lims_biller_list', 'lims_warehouse_list', 'companies'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {

        $companies = User::find($id)->companies->pluck('name', 'name')->toArray();

        $updated_companies = ['hygiene' => $hygiene = $request->hygiene, 'sweet' => $sweet = $request->sweet, 'hafko' => $hafko = $request->hafko, 'sanfora' => $request->sanfora, 'service' => $service = $request->service, 'goods' => $goods = $request->goods];

        $removed_companies = array_diff($companies, $updated_companies);
        $added_companies = array_diff($updated_companies, $companies);

        // update Removed Companies
        foreach ($removed_companies as $company_key => $company_value) {
            if (isset($company_value)) {
                $company_id = Company::where('name', $company_value)->get()[0]->id;
                try {

                    $found_company_relation = DB::table('users_companies')->where("company_id", '=', $company_id)->where('user_id', '=', $id)->delete();
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

        if (!config("user.user_verified"))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

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

        $input = $request->except('password');
        if (!isset($input['is_active']))
            $input['is_active'] = false;
        if (!empty($request['password']))
            $input['password'] = bcrypt($request['password']);
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
        if (!config("user.user_verified"))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);
        return redirect()->back()->with('message3', 'Data updated successfullly');
    }

    public function changePassword(Request $request, $id)
    {
        if (!config("user.user_verified"))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        if ($input['new_pass'] != $input['confirm_pass'])
            return redirect("user/" .  "profile/" . $id)->with('message2', "Please Confirm your new password");

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
        if (!config("user.user_verified"))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $lims_user_data = User::find($id);
        $lims_user_data->is_deleted = true;
        $lims_user_data->is_active = false;
        $lims_user_data->save();
        if (Auth::id() == $id) {
            auth()->logout();
            return redirect('/login');
        } else
            return redirect('user')->with('message3', 'Data deleted successfullly');
    }
}
