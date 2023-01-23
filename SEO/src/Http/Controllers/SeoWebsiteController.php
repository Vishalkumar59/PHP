<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use Modules\SEO\Models\Website;
use Modules\SEO\Models\Country;
use Modules\CRM\Models\Customer;
use Modules\UserManage\Models\User;


// use Modules\SEO\Models\Customer;

class SeoWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $web_setting = Website::all();
        $customer_list = Customer::all();
        $country_list = Country::all();
        $customerlist = User::with('role')->get();
        
        
        return view('SEO::seo-settings.seo-website.create' ,compact('web_setting','country_list','customer_list','customerlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'website_name' => 'required',
            'website_url' => 'required',
            // 'countries_id' => 'required',
            // 'start_Date' => 'required|date',
            // 'status' => 'required',
        ]);
        // dd($request->countries_id);
        if($request){
        $web_setting = new Website();
        $web_setting->website_name = $request->website_name;
        $web_setting->website_url = $request->website_url;
        $web_setting->countries_id = $request->country;   
        $web_setting->start_date  = date('Y-m-d', strtotime($request->start_Date));  
        $web_setting->status = '1';
        $web_setting->user_id = $request->customer;
        // $web_setting->updated_at = '';
        $web_setting->save();
        return redirect()->route('workReport')->with('success','Website Added Successfully');
        }else{
            return redirect()->route('workReport')->with('error','Website Insertion Failed');
        }

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
        if($id){
        $web_setting = Website::find($id);
        $country = Country::all();
        $customer_list = Customer::all();
        $customerlist = User::with('role')->get();
         
        return view('SEO::seo-settings.seo-website.edit' ,compact('country','web_setting','customer_list','customerlist'));
        }else{
            return redirect()->route('workReport')->with('error','Website  Not Found');
        }
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
        
        if($id){
        $web_setting = Website::find($id);
        $web_setting->website_name = $request->website_name;
        $web_setting->website_url = $request->website_url;
        $web_setting->countries_id = $request->country;   
        $web_setting->start_date  = date('Y-m-d', strtotime($request->start_Date));
        $web_setting->user_id = $request->customer;  
        $web_setting->update();
        return redirect()->route('workReport')->with('success','Website Updated Successfully');
        }else{
             return redirect()->route('workReport')->with('error','Website Updation Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
        Website::find($id);
        Website::destroy($id);
        return response()->json(['success' => 'Website Delete Successfully']);
        }else{
            return response()->json(['error' => 'Website Already Deleted']);
        }
        // return redirect()->route('workReport')->with('success','Record delete successfully');
    }

    public function changeWebsiteStatus(Request $request)
    {
        // dd($request->all());
        $website =  Website::where('id' ,$request->website_id)->first();
        $website->status = $request->status;
        $website->update();
        return response()->json(['status'=>1, 'success'=>' Website Status Changed Successfully']);
    }
}
