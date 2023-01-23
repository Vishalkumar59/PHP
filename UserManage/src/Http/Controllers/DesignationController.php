<?php

namespace Modules\UserManage\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\UserManage\Models\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $designation_list = Designation::orderBy('created_at','DESC')->get();
        return view('UserManage::designation.index' ,compact('designation_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('UserManage::designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      
        $designation = new Designation();
        $designation->designation_name = $request->designation_name;
        $designation->status           = 1;
        $designation->save();
        return redirect()->route('designation.index')->with('success','Designation Added Successfully');
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
       
        $designation = Designation::find($id);
        return response($designation);
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
            //
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }

    public function designationtUpdate(Request $request)

    {
      

        $designation =  Designation::where('designation_id', $request->designation_id)->first();
        $designation->designation_name = $request->designation_name;
        $designation->update();
        return response()->json(['status'=>1, 'success'=>'Designation Updated Successfully']);

    }

   public function changeDesignationStatus(Request $request)
    {
        
        $designation =  Designation::where('designation_id' ,$request->designation_id)->first();
        $designation->status = $request->status;
        $designation->update();
        return response()->json(['status'=>1, 'message'=>' Designation Status Changed Successfully']);
    }
    public function designationDestroy(Request $request)
    {
        
        $designation = Designation::where('designation_id', $request->designation_id)->delete();
        return response()->json(['success' => 'Designation Deleted Successfully']);
    }
}
