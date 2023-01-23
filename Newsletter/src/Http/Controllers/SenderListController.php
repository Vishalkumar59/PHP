<?php

namespace Modules\Newsletter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Newsletter\Models\SenderEmail;
use Modules\Newsletter\Models\ServerMail;
use Illuminate\Support\Facades\Hash;
// use Modules\UserManage\Models\UserHasRoles;
use Auth;

class SenderListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sender_list = SenderEmail::paginate(10);
        $server_list = ServerMail::paginate(10);
        return view('Newsletter::settings.index',compact('sender_list','server_list'));
        
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
        // dd($request->all());
        $request->validate([
            'sender_name' => 'required',
            'sender_email' => 'required|unique:mkt_sender_email,sender_email',
        ]);
        $sender = new SenderEmail();
        $sender->sender_name = $request->sender_name;
        $sender->sender_email = $request->sender_email;
        $sender->email_server_id = $request->server_name;
        $sender->updated_at = null;
        $sender->save();
        return response()->json([ 'success'=>'Sender Added successfully']);

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
        $edit_sender = SenderEmail::find($id);
        return response()->json(['edit_sender'=>$edit_sender]);
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
    public function SenderUpdate(Request $request)
    {
          $request->validate(
             [
                'edit_sender_name'=>'required|string',
                'edit_email'=>'required',
              ]);

        $update_sender =  SenderEmail::where('id', $request->edit_hidden_id)->update([

                'sender_name'     =>$request->edit_sender_name,
                'sender_email'    =>$request->edit_email,
                'email_server_id' => $request->edit_server_name,
                // 'status'=>$request->edit_status,

        ]);
       return response()->json(['success'=>' Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (SenderEmail::where('id', $id)->exists()) {
            SenderEmail::where('id',$id)->delete();
            return response()->json(['success' => 'Sender deleted successfully']);
        } else{
            return response()->json(['error' => 'Sender already deleted!']);
        }
        
    }
    public function ChangeSenderStatus(Request $request)
    {
        $sender =  SenderEmail::where('id' ,$request->sender_id)->first();
        $sender->status = $request->status;
        $sender->update();
        return response()->json(['success'=>'Sender Status Changed Successfully']);
    }
}
