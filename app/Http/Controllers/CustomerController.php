<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
    //
    public function CustomerList(){
        
    $customers  = Customer::all();
    
    return view('customer.CustomerList',compact('customers'));


     

    }

public function CustomerStore(Request $request){

                    

                $validateData = $request->validate([
                    'customer_name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                
                    'address' => 'required',
                ]);
                $customer= new Customer;
                $customer->customer_name=$request->customer_name;
                $customer->email=$request->email;
                $customer->phone=$request->phone;
                $customer->city=$request->city;
                $customer->country=$request->country;
                $customer->address=$request->address;
                $customer->save();






                $notification = array(
                'message' => 'Customer created',
                'alert-type' => 'success',
                );




                return redirect()->route('customer.list')->with($notification);






    }



    public function fetchcustomer()
    {
        $customers = Customer::all();
        return response()->json([
            'customers'=>$customers,
        ]);
    }
 




        public function edit( $id)
        {
            $customer=Customer::find($id);
          
        
    
            if($customer)
            {
                return response()->json([
                    'status'=>200,
                    'customer'=> $customer,
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Customer Found.'
                ]);
            }
    
        }
    
        

        public function update(Request $request, $id)
        { 
            
            
     
    
          
                $customer = Customer::find($id);
                if($customer)
                { 
                  $customer->customer_name=$request->input('customer_name');
                  $customer->email=$request->input('email');
                  $customer->phone=$request->input('phone');
                  $customer->city=$request->input('city');
                  $customer->country=$request->input('country');
                  $customer->address=$request->input('address');
                
              
                    $customer->update();
                    return response()->json([
                        'status'=>200,
                        'message'=>'customer Updated Successfully.'
                    ]);
                }
                else
                {
                    return response()->json([
                        'status'=>404,
                        'message'=>'No custmer Found.'
                    ]);
                }
    
            }
    
    
            public function destroy($id){
   
                $customer = Company::find($id);
                $customer->delete();
                return response()->json([
                  'message' => 'Data deleted successfully!'
                ]);
            }


}





