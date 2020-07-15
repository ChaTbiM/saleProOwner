<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use Illuminate\Validation\Rule;
use Keygen;
use DB;
use App\Company;
use App\Product_Warehouse_Hygiene;
use App\Product_Warehouse_Sweet;
use App\Product_Warehouse_Hafko;
use App\Product_Warehouse_Sanfora;
use App\Product_Warehouse_Service;
use App\Product_Warehouse_Goods;
use App\Warehouse_Hygiene;
use App\Warehouse_Sweet;
use App\Warehouse_Hafko;
use App\Warehouse_Sanfora;
use App\Warehouse_Service;
use App\Warehouse_Goods;




class WarehouseController extends Controller
{

    public function index()
    {   
        $companies = Company::all();

        $hygiene_warehouses = DB::connection("hygiene")->select("SELECT * FROM `warehouses` WHERE (is_active) = (true) "); 
        // dd($hygiene_warehouses);
        $sweet_warehouses = DB::connection("sweet")->select("SELECT * FROM `warehouses` WHERE (is_active) = (true) ");  
        $hafko_warehouses = DB::connection("hafko")->select("SELECT * FROM `warehouses` WHERE (is_active) = (true) ");   
        $sanfora_warehouses = DB::connection("sanfora")->select("SELECT * FROM `warehouses` WHERE (is_active) = (true) ");  
        $service_warehouses = DB::connection("service")->select("SELECT * FROM `warehouses` WHERE (is_active) = (true) ");  
        $goods_warehouses = DB::connection("goods")->select("SELECT * FROM `warehouses` WHERE (is_active) = (true) ");   


        $number_of_products["hygiene"] = $this->getNumberOfProducts(Product_Warehouse_Hygiene::class,$hygiene_warehouses);
        $number_of_products["sweet"] = $this->getNumberOfProducts(Product_Warehouse_Sweet::class,$hygiene_warehouses);
        $number_of_products["hafko"] = $this->getNumberOfProducts(Product_Warehouse_Hafko::class,$hygiene_warehouses);
        $number_of_products["sanfora"] = $this->getNumberOfProducts(Product_Warehouse_Sanfora::class,$hygiene_warehouses);
        $number_of_products["service"] = $this->getNumberOfProducts(Product_Warehouse_Service::class,$hygiene_warehouses);
        $number_of_products["goods"] = $this->getNumberOfProducts(Product_Warehouse_Goods::class,$hygiene_warehouses);


        $stock_quantity["hygiene"] = $this->getStockQuantity(Product_Warehouse_Hygiene::class,$hygiene_warehouses);
        $stock_quantity["sweet"] = $this->getStockQuantity(Product_Warehouse_Sweet::class,$hygiene_warehouses);
        $stock_quantity["hafko"] = $this->getStockQuantity(Product_Warehouse_Hafko::class,$hygiene_warehouses);
        $stock_quantity["sanfora"] = $this->getStockQuantity(Product_Warehouse_Sanfora::class,$hygiene_warehouses);
        $stock_quantity["service"] = $this->getStockQuantity(Product_Warehouse_Service::class,$hygiene_warehouses);
        $stock_quantity["goods"] = $this->getStockQuantity(Product_Warehouse_Goods::class,$hygiene_warehouses);

        // dd($stock_quantity);

        // $lims_warehouse_all["hygiene"]  = $hygiene_warehouses;
        // $lims_warehouse_all["sweet"]  = $sweet_warehouses; 

        // $lims_warehouse_all = Warehouse::where('is_active', true)->get();

        $lims_warehouse_all["hygiene"] = $hygiene_warehouses;
        $lims_warehouse_all["sweet"] = $sweet_warehouses;
        $lims_warehouse_all["hafko"] = $hafko_warehouses;
        $lims_warehouse_all["sanfora"] = $sanfora_warehouses;
        $lims_warehouse_all["service"] = $service_warehouses;
        $lims_warehouse_all["goods"] = $goods_warehouses;

        // dd($lims_warehouse_all);
        return view('warehouse.create', compact('lims_warehouse_all','companies','number_of_products','stock_quantity'));
    }

    public function store(Request $request)
    {
        $company_name = $request->company_name;

        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('warehouses')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);
        $input = $request->all();
        $input['is_active'] = true;

        if($company_name == "hygiene"){
            Warehouse_Hygiene::create($input);
        }else if($company_name == "sweet"){
            Warehouse_Sweet::create($input);
        }else if($company_name == "hafko"){
            Warehouse_Hafko::create($input);
        }else if($company_name == "sanfora"){
            Warehouse_Sanfora::create($input);
        }else if($company_name == "service"){
            Warehouse_Service::create($input);
        }else if($company_name == "goods"){
            Warehouse_Goods::create($input);
        }else {
        return redirect('warehouse')->with('message', 'Warehouse was not created');
        }
    
        return redirect('warehouse')->with('message', 'Data inserted successfully');
    }


    public function edit($id)
    {
        $lims_warehouse_data = Warehouse::findOrFail($id);
        return $lims_warehouse_data;
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('warehouses')->ignore($request->warehouse_id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);
        $input = $request->all();
        $lims_warehouse_data = Warehouse::find($input['warehouse_id']);
        $lims_warehouse_data->update($input);
        return redirect('warehouse')->with('message', 'Data updated successfully');
    }

    public function importWarehouse(Request $request)
    {
        //get file
        $upload=$request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if($ext != 'csv')
            return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
        $filename =  $upload->getClientOriginalName();
        $upload=$request->file('file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
                continue;
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
           $data= array_combine($escapedHeader, $columns);

           $warehouse = Warehouse::firstOrNew([ 'name'=>$data['name'], 'is_active'=>true ]);
           $warehouse->name = $data['name'];
           $warehouse->phone = $data['phone'];
           $warehouse->email = $data['email'];
           $warehouse->address = $data['address'];
           $warehouse->is_active = true;
           $warehouse->save();
        }
        return redirect('warehouse')->with('message', 'Warehouse imported successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $warehouse_id = $request['warehouseIdArray'];
        foreach ($warehouse_id as $id) {
            $lims_warehouse_data = Warehouse::find($id);
            $lims_warehouse_data->is_active = false;
            $lims_warehouse_data->save();
        }
        return 'Warehouse deleted successfully!';
    }

    public function destroy($id,Request $request)
    {
        $company_name = $request->company_name;

        if($company_name == "hygiene"){
        $lims_warehouse_data = Warehouse_Hygiene::find($id);
        }else if ($company_name == "sweet"){
            $lims_warehouse_data = Warehouse_Sweet::find($id);
        }else if ($company_name == "hafko"){
        $lims_warehouse_data = Warehouse_Hafko::find($id);
        }else if ($company_name == "sanfora"){
        $lims_warehouse_data = Warehouse_Sanfora::find($id);
        }else if ($company_name == "service"){
        $lims_warehouse_data = Warehouse_Service::find($id);
        }else if ($company_name == "goods"){
        $lims_warehouse_data = Warehouse_Goods::find($id);
        }

        $lims_warehouse_data->is_active = false;
        $lims_warehouse_data->save();
        

        return redirect('warehouse')->with('not_permitted', 'Data deleted successfully');
    }

    // -- 
    public function getNumberOfProducts($model,$warehouses){
        foreach($warehouses as $warehouse){
            $id = $warehouse->id;
            $data[$id] = $model::WarehouseNumberOfProducts($id);
        }
        return $data;
    }

    public function getStockQuantity($model,$warehouses){
        foreach($warehouses as $warehouse){
            $id = $warehouse->id;
            $data[$id] = $model::WarehouseStockQuantity($id);
        }
        return $data;
    }

    public function createWarehouse($company_name,$input){
        try {
        //    DB::connection($company_name)->insert("insert into `warehouses` (name,address,phone,email,is_active) = (?,?,?,?)",[$input->name,$input->address,$input->phone,$input->email,true]);
            DB::connection($company_name)->table("warehouses")->insert(["name"=>$input->name,"phone"=>$input->phone,"email"=>$input->email,"address"=>$input->address,"is_active"=>true]);    
        } catch (\Throwable $th) {
            return redirect('warehouse')->with('message', 'Warehouse was not created');
        }
    }
}
