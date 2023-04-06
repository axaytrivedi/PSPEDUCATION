<?php

namespace App\Http\Controllers\Admin\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
class ModuleController extends Controller
{
    function Create()
    {
 
        return view('admin.Permissions.create');
    }

    function index($id)
    {
        
       $role_id=$id;
       $permisson =  Permission::all();
     
        $perant0 = array();
        $perant1 = array();

      
   
            foreach( $permisson as $key=>$val)
            { 
                if($val->moduleName != $id)
                {
                    $perant[]=["id"=>$val->id,"Name"=>$val->moduleName];
                    $id = $val->moduleName;
                }
              
            }
         
            $collection = new Collection();
            $collection =(isset($perant))?(object)$perant:$perant=[];
            $parent = $collection;
           
            
     return view('admin.Permissions.index',compact('permisson','perant','role_id'));

    }
    function store(Request $request)
    {
    

        $ModuleName =$request->ModuleName;

        if($request->ModuleType =='Sub-Maste')
        {
            $sub_master = $request->sub_master;
        }
        

        if($request->RouteType =="resource")
        {       
            if( $ModuleName == "OrderBook")
             $route_array= array('index','create','store','show','edit','update','destroy',"date",
                    "salesperson",
                    "priority_level",
                    "po_no",
                    "po_received_by",
                    "po_date",
                    "rate_category",
                    "po_rate",
                    "dic_order",
                    "billing_rate",
                    "dec_or_sku",
                    "category_industry",
                    "category_product",
                    "category_geography",
                    "category_make_or_buy",
                    "customer_part_number",
                    "internal_part_number",
                    "hsn_number",
                    "quantity",
                    "unit",
                    "size1",
                    "upper_limit1",
                    "lower_limit1",
                    "size2",
                    "upper_limit2",
                    "lower_limit2",
                    "size3",
                    "upper_limit3",
                    "lower_limit3",
                    "length",
                    "length_upper_limit",
                    "length_lower_limit",
                    "colour",
                    "critical_checking",
                    "gauge_fitting",
                    "master_batch",
                    "master_batch_qty",
                    "material_category",
                    "base_material",
                    "quantity_of_material_required_kg",
                    "custome_or_ex_stock",
                    "available_in_stock",
                    "material_send_to_production_yes_no",
                    "payment_terms",
                    "credit_preiod",
                    "credit_limit",
                    "pyment_status",
                    "amount_received_against_order",
                    "Passed_by_finance",
                    "send_to_in_production",
                    "production_machine_options",
                    "final_machine_scheduled",
                    "date_of_production_and_alert",
                    "machine_capacity_per_hour_per_shift_per_day",
                    "production_days_needed",
                    "production_date_from",
                    "production_date_to",
                    "production_status",
                    "send_to_cutting_assembly",
                    "send_to_packing",
                    "packing_instructions1",
                    "packing_instructions2",
                    "packing_instructions3",
                    "packing_instructions4",
                    "marking",
                    "despatch_quantity",
                    "despatch_from_godown",
                    "order_status",
                    "pending_quantity",
                    "ship_to_address_different_from_Bill_to_give_all_fields",
                    "despatch_destination",
                    "invoice_value_basic",
                    "less_discount",
                    "packing_and_forwarding_charges",
                    "freight_Paid_to_pay_bill_default_to_take_plus_changeable",
                    "freight_only_if_Paid_and_in_bill",
                    "taxable_amount",
                    "tax_from_sku_master",
                    "tax_amount",
                    "gross_amount",
                    "marking_or_sticker",
                    "marking_on_sticker",
                    "sticker_on_packing",
                    "tansporter",
                    "lr_date",
                    "despatch_lr_number",
                    "eway_bill",
                    "eway_bill_no",
                    "print_compound_file",
                    "label_for_weight_checking",
                    "status");
                elseif($ModuleName == "OrderList")                
                {
                    
                    $route_array= array(
                    "OrderNo",
                    "Orderdate",
                    "CustomerName",
                    "Product",
                    "Quantity_+unit",
                    "Billing_Rate",
                    "Specific_material",
                    "Quantity_of_specific_material_needed_+unit",
                    "Raw_material_quantity_needed_(in lots)",
                    "Printing",
                    "available_in_stock",
                    "Finance_clearance",
                    "Store_Clearance",
                 
              
                    "If_production",
                    "can_Print_inspection_and_packing_sticker_for_production_also_and_for_stock_item_also",
                    "Date_of_invoice",
                    "Invoice",
                    "Date of despatch",
                    "Despatch_details",
               
                    "Scan",
                    "Pending_quantity",
                    "Export_related_documents",
                    "Enter_payment_details",
                    "Pending_amount",
                    "Edit_Order",
                    "Show_Order",
                    "Delete_order");
                }
          
                elseif($ModuleName == "UserMenu")
                    {
                       
                        $route_array= array(
                            "Role",
                            "Users",
                            "Country",
                            "State",
                            "City",
                           ); 
                    }      
                else{
                    $route_array= array('index','create','store','show','edit','update','destroy');
                }
        }
        else
        {

            $route_array= array($request->ModuleName);
        }
      
        $auth =Auth::user();

   
        $role_name = Role::select('id','name')->find($auth->Role);

        $get_con_name= ($request->master!="")? $request->master: $request->sub_master;
        
        foreach($route_array as $key=>$value)
        {
               
     
            $permission = Permission::create(['name' => $get_con_name."-".$value, 'moduleName'=>$ModuleName]);
           
           
             if(isset($role_name->name) && $role_name->name =='Admin'){
                $auth->assignRole($role_name->name);
             }
            
        }


        session()->flash('msg', 'Module Created Updated Successfuly.');
      return redirect()->back();
    }


    function GivePermission(Request $request)
    {
     

        $permisson_req =  $request->child;
        $role_id=  $request->role;
      
        // $user= User::find($user_id);
        $role = Role::find($role_id);
      
        $modal = DB::table('role_has_permissions')->where('role_id',$role->id)->delete();

        if(!empty($permisson_req))
          {  
            foreach($permisson_req as $req)
            {
         
                $role->givePermissionTo($req);
         
            }
        
        }

     return redirect()->route('role.index');
    }
   
}
