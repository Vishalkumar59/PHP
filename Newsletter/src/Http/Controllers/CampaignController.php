<?php

namespace Modules\Newsletter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Newsletter\Models\TemplateList;
use Modules\Newsletter\Models\ServerMail;
use Modules\Newsletter\Models\ContactGroup;
use Modules\Newsletter\Models\Campaign;


use Illuminate\Support\Facades\Hash;
// use Modules\UserManage\Models\UserHasRoles;
use Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template_list = TemplateList::all();
        $contactgroup = ContactGroup::all();
        $server_mail = ServerMail::all();
        $Campaign_list = Campaign::all();

        return view('Newsletter::campaign.index',compact('template_list','contactgroup','server_mail','Campaign_list'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        // $request->validate([
        //     'name'             => 'required',
        //     'subject'          => 'required',
        //     'description'      => 'required',
        //     'campaign_template'=> 'required',
        //     'smtp_server'      => 'required',
        //     'group'            => 'required',
        // ]);
        $separtegroup = (implode(',', $request->group));
        $campaign = new Campaign();
        $campaign->campaign_name           = $request->name;
        $campaign->campaign_subject        = $request->subject;
        $campaign->description             = $request->description;
        $campaign->template_id             = $request->campaign_template;
        $campaign->smtp_server_id          = $request->smtp_server;
        $campaign->group_ids               = $separtegroup;
        $campaign->updated_at              = null;
        $campaign->save();
        // return response()->json([ 'success'=>'Campaign Added successfully']);
        return redirect()->route('campaign.index')->with('success', 'Campaign Added successfully');

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
        $edit_campaign = Campaign::find($id);
        $grouplist = $edit_campaign->group_ids;
        $arraygroup = explode(',', $grouplist);
        $template_list = TemplateList::all();
        $server_mail = ServerMail::all();
        $contactgroup = ContactGroup::all();
        return view('Newsletter::campaign.edit', compact('edit_campaign','template_list','server_mail','contactgroup','arraygroup'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $request->validate([
        //     'edit_name'             => 'required',
        //     'edit_subject'          => 'required',
        //     'edit_description'      => 'required',
        //     'edit_template'         => 'required',
        //     'edit_smtp_server'      => 'required',
        //     'edit_group'            => 'required',
        // ]);
        $updateseprategroup = (implode(',', $request->edit_group));
        $update_sender =  Campaign::where('id',$id)->update([

            'campaign_name'       =>$request->edit_name,
            'campaign_subject'    =>$request->edit_subject,
            'description'         =>$request->edit_description,
            'template_id'         =>$request->edit_template,
            'smtp_server_id'      =>$request->edit_smtp_server,
            'group_ids'           =>$updateseprategroup,
           

    ]);
    return redirect()->back()->with('success', 'Campaign Updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if (Campaign::where('id', $id)->exists()) {
            Campaign::where('id',$id)->delete();
            return response()->json(['success' => 'Campaign deleted successfully']);
        } else{
            return response()->json(['error' => 'Campaign already deleted!']);
        }
        
    }
    public function ChangeCampaignStatus(Request $request)
    {
        if (Campaign::where('id', $request->campaign_id)->exists()) {
        $campaign_status =  Campaign::where('id' ,$request->campaign_id)->first();
        $campaign_status->status = $request->status;
        $campaign_status->update();
            return response()->json(['success'=>'Campaign Status Changed Successfully']);
        }else{
            return response()->json(['error'=>'Campaign Status dont Changed']);
        }
    }
    public function CampaignView(Request $request)
    {
        
        $view_campaign = Campaign::find($request->campaign_view_id);
        $getTemplateId = $view_campaign->template_id;
        $getSMTPid = $view_campaign->smtp_server_id;
        $getGroup = $view_campaign->group_ids;
        $arraygroup = explode(',', $getGroup);
        $GetGroupName = [];

        foreach($arraygroup as $data)
        {
           // $GetGroupName = ContactGroup::where(['id'=> $data])->get('group_name');
            array_push($GetGroupName, [
               ContactGroup::where(['id'=> $data])->pluck('group_name')
            ]);
        }
        $templateName = TemplateList::where('id',$getTemplateId)->get('subject');
        // $GetGroupName = ContactGroup::where(['id'=> $arraygroup])->get('group_name');
        $GetServerName = ServerMail::where('id',$getSMTPid)->get('driver');

        return response()->json(['view_campaign'=>$view_campaign,'templateName' => $templateName,'GetGroupName' => $GetGroupName,'GetServerName' => $GetServerName]);
    }
}
