<?php

namespace Modules\Newsletter\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Newsletter\Models\ContactGroup;
use Modules\Newsletter\Models\ContactToGroup;



class ContactGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactData = ContactGroup::paginate(10);
        $contactgroupcount = ContactToGroup::all();
        return view('Newsletter::contact.index', compact('contactData','contactgroupcount'));
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
        
        $contactGroup = new ContactGroup();
        $contactGroup->group_name = $request->group_name;
        $contactGroup->description = $request->details;
        $contactGroup->updated_at = null;
        $contactGroup->save();
        return redirect()->route('contact-group-list.index')->with('success', 'Contact Group Added Successfully');
        
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
        $contactGroup = ContactGroup::find($id);
        return response()->json(['contactGroup'=>$contactGroup]);
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
        
    }

     public function contactGroupUpdate(Request $request)
    {
        $request->validate([
            'group_name'       => 'required',
            'details'       => 'required',

        ]);
        $contactGroup =  ContactGroup::where('id', $request->contact_id)->update([
                'group_name'=>$request->group_name,
                'description'=>$request->details,
        ]);

        return response()->json(['contactGroup'=>$contactGroup, 'success'=>'Contact Group Updated  Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

     public function deleteContactGroup(Request $request)
    {
        if (ContactGroup::where('id',$request->group_id)->exists()) {
        ContactGroup::where('id' ,$request->group_id)->first()->delete();
        ContactToGroup::where('group_id',$request->group_id)->delete();
             return response()->json(['success'=>' Contact Group Deleted Successfully']);
        }else{
            return response()->json(['error'=>"Contact Group can't Deleted"]);
        }
    }

     public function changeContactGroupStatus(Request $request)
    {
        $contactStatus = ContactGroup::where('id' ,$request->contact_id)->first();
        $contactStatus->status = $request->status;
        $contactStatus->update();
        return response()->json(['message'=>' Contact Group Status Changed Successfully']);
    }
    public function GetContactList(Request $request)
    {
        $ShowContact = ContactToGroup::where('group_id',$request->contact_group_id)->get();
        
        return response()->json(['ShowContact'=>$ShowContact]);
    }

    
}

 
 