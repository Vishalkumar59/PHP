<?php

namespace Modules\CRM\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\CRM\Models\Lead;
use Modules\CRM\Models\LeadContact;
use Modules\CRM\Models\LeadSocialLink;
use Modules\CRM\Models\LeadSource;
use Modules\CRM\Models\Industry;
use Modules\CRM\Models\MasCountry;
use Modules\CRM\Models\LeadStatus;




class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $lead = Lead::orderBy('created_at', 'desc')->paginate(10);
       $leadStatus = LeadStatus::where('status',1)->get();
       return view('CRM::lead.index',compact('lead','leadStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $leadSource  = LeadSource::where('status',1)->get();
       $industry    = Industry::where('status',1)->get();
       $country     = MasCountry::where('status',1)->get();
       return view('CRM::lead.create',compact('leadSource','industry','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
        $Lead = new Lead();
        $Lead->source_id    = $request->source;
        $Lead->industry_id  = $request->industry;
        $Lead->contact_name = $request->contact_name;
        $Lead->contact_email = $request->contact_email;
        if($request->contact_phone == null){
            $Lead->phone == null;
        }
        else{
            $Lead->phone = $request->contact_phone;
        }
        $Lead->save(); 
        $Lead_id = $Lead->lead_id;
       
        
        $leadContact = new LeadContact();
        $leadContact->lead_id        = $Lead_id;
        $leadContact->website        = $request->website;
        $leadContact->street_address = $request->street_address;
        $leadContact->city           = $request->city;
        $leadContact->state          = $request->state;
        $leadContact->zipcode        = $request->zipcode;
        $leadContact->country_code   = $request->country_code;
        $leadContact->save();
       
       $socialLink = $request->social_link?$request->social_link:0;
       $socialType = $request->social_type?$request->social_type:0;
     
       foreach($socialLink as $key => $value){
            $social_link    = LeadSocialLink::create([
            'social_link'   =>  $value??0,
            'social_type'   =>  $social_type[$key]??0,
            'lead_id'       =>  $Lead->lead_id,
        ]);

       }
        
        return redirect()->route('leads.index')->with('success','Data inserted succesfully');
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
    public function edit($lead_id)
    {   
        $lead          = Lead::find($lead_id);
        $leadSource    = LeadSource::where('status',1)->get();
        $industry      = Industry::where('status',1)->get();
        $country       = MasCountry::where('status',1)->get();
        $socialLink    = LeadSocialLink::where('lead_id',$lead->lead_id)->get();

        return view('CRM::lead.edit',compact('lead','industry','leadSource','country','socialLink'));
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
        

        $lead = Lead::find($id);
        $lead->source_id    = $request->source;
        $lead->industry_id  = $request->industry;
        $lead->contact_name = $request->contact_name;
        $lead->contact_email = $request->contact_email;
        if($request->contact_phone == null){
            $lead->phone == null;
        }
        else{
            $lead->phone = $request->contact_phone;
        }
        $lead->update();

        $lead_contact = LeadContact::where('lead_id',$id)->first();

        $lead_contact->website =$request->website;
        $lead_contact->street_address = $request->street_address;
        $lead_contact->city = $request->city;
        $lead_contact->state  = $request->state;
        $lead_contact->zipcode = $request->zipcode;
        $lead_contact->country_code = $request->country_code;
        $lead_contact->save();
      
        $social_link = $request->social_link?$request->social_link:0;
        $social_type = $request->social_type?$request->social_type:0;

        LeadSocialLink::where('lead_id', $lead->lead_id)->delete();

        foreach($social_link as $key => $value){
                $ins_data = [   
                    'social_link'   =>  $value??0,
                    'social_type'   =>  $social_type[$key]??0,
                    'lead_id'       => $id
                ];
                    LeadSocialLink::create($ins_data);
            }
        return redirect()->route('leads.index')->with('success','Record updated successfully');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Lead::find($id)->exists()) {
        $leadContact    = LeadContact::where('lead_id',$id)->delete();
        $socialLink = LeadSocialLink::where('lead_id',$id)->delete();
        $lead       = Lead::find($id)->delete();
           return response()->json(['success' => 'Lead Record deleted successfully!']);
        }else{
            return response()->json(['error' => 'Lead already deleted!']);
        }
    }

    public function addmoredelete(Request $request)
    {
        $social_link_delete = LeadSocialLink::where('social_link_id',$request->social_link_id)->delete();
        return response()->json(['status'=>1, 'message'=>'Data deleted successfully']);
    }

    public function followStatus(Request $request)
    {
        $followstatus = 
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->update();
        return response()->json(['status' => 1, 'message' => 'User Status changed Successfully']);
    }
}
 