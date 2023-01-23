<?php

namespace Modules\CRM\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\CRM\Models\Country;
use Illuminate\Http\Request;
use Modules\CRM\Models\Customer;
use Modules\CRM\Models\CustomerContact;
use Modules\CRM\Models\CustomerAddress;
use Modules\CRM\Models\Lead;
use Modules\CRM\Models\MasCountry;




class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact       = CustomerContact::all();
        $customer_list = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('CRM::customer.index', compact('customer_list','contact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lead_list      = Lead::where('status',1)->get();
        $country_list   = MasCountry::where('status',1)->get();
        return view('CRM::customer.create', compact('lead_list','country_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $customer               = new Customer();
        $customer->lead_id      = $request->lead_id;
        $customer->gender       = $request->gender;
        $customer->first_name   = $request->customer_name;
        $customer->email        = $request->customer_email;
        $customer->company_name = $request->company_name;
        $customer->website      = $request->website;
        $customer->save();
        
        $id= $customer->customer_id;
        
        $contactData = CustomerContact::create([
                'contact_name'  => $request->contact_name,
                'contact_email' => $request->contact_email,
                'customer_id'   => $id
            ]);
        if(!empty($request->add_contact_name) && !empty($request->add_contact_email))
        {
            $contact_name  = $request->add_contact_name;
            $contact_email = $request->add_contact_email;

            foreach($contact_name as $key => $value ){
                $data = CustomerContact::create([
                    'contact_name'  =>  $value,
                    'contact_email' => $contact_email[$key],
                    'customer_id'   => $id,
                ]);
            }
        }
        $customer_address = CustomerAddress::create([
            'address_type'  => $request->address_type,
            'street_address'=> $request->street_address,
            'city'          => $request->city,
            'state'         => $request->state,
            'countries_id'  => $request->country_id,
            'zipcode'       => $request->zip_code,
            'customer_id'   => $id,
        ]);
        return redirect()->route('customer.index')->with('success','Customer Add Successfully');
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
        $customer       = Customer::find($id);
        $lead_list      = Lead::all();
        $address        = CustomerAddress::where('customer_id', $customer->customer_id)->first();
        $contacts       = CustomerContact::where('customer_id',$customer->customer_id)->get();
        $country_list   = MasCountry::all();
        return view('CRM::customer.edit',compact('customer','lead_list','address','country_list','contacts'));
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
         
        
        $customer               = Customer::find($id);
        $customer->lead_id      = $request->lead_id;
        $customer->gender       = $request->gender;
        $customer->first_name   =$request->customer_name;
        $customer->email        =$request->customer_email;
        $customer->company_name = $request->company_name;
        $customer->website      = $request->website;
        $customer->update();

        $id = $customer->customer_id;

        $customerAddress                    = CustomerAddress::where('customer_id', $id)->first();
        $customerAddress->address_type      = $request->address_type;
        $customerAddress->street_address    = $request->street_address;
        $customerAddress->city              = $request->city;
        $customerAddress->state             = $request->state;
        $customerAddress->countries_id      = $request->country_id;
        $customerAddress->zipcode           = $request->zip_code;
        $customerAddress->update();

        if(!empty($request->contact_name) && !empty($request->contact_email)){

            $contact_name  = $request->contact_name;
            $contact_email = $request->contact_email;

            CustomerContact::where('customer_id', $id)->delete(); 
               
            foreach($contact_name as $key => $value ){
                $data = [
                'customer_id'   => $id,
                'contact_name'  =>  $value,
                'contact_email' => $contact_email[$key],
                ];
                CustomerContact::create($data);
            }
        }
        return redirect()->route('customer.index')->with('success','Customer Updated Successfully');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Customer::find($id)->exists()) {
        Customer::find($id)->delete();
            return response()->json(['success' => 'Customer Deleted Successfully']);
        }else{
            return response()->json(['error' => 'Customer already deleted!']);
        }
    }
}
