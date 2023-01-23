<?php
namespace Modules\Setting\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Models\Industry;
use Modules\Setting\Models\LeadSource;
use Modules\Setting\Models\LeadStatus;

class LeadSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
           $source_list = LeadSource::orderBy('created_at','DESC')->get();
           $industry_list = Industry::orderBy('created_at','DESC')->get();
           $status_list = LeadStatus::orderBy('created_at','DESC')->get();
           return view('lead-setting.index', compact('source_list','industry_list','status_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate(
            [
                'source_name'=>'required|string',
              

            ]);

        $source = new LeadSource();
        $source->source_name = $request->source_name;
        $source->status = 1;
        $source->save();

        return redirect()->route('lead-setting.index')->with('success',' Source Added Successfully');
    }
    public function storeStatus(Request $request)
    { 

         $request->validate(
            [
                'status_name'=>'required|string',
                
            ]);

        $status = new LeadStatus();
        $status->status_name = $request->status_name;
        $status->status = 1;
        $status->save();
        return response()->json(['status'=>1, 'message'=>'Status name added successfully']);
    }
    
    public function storeIndustry(Request $request)
    {
        $request->validate(
            [
                'industry_name'=>'required|string',
                

            ]);

        $industry = new Industry();
        $industry->industry_name = $request->industry_name;
        $industry->status = 1;
        $industry->save();

      return response()->json(['status'=>1, 'message'=>'Industry name added successfully']);
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
        $source = LeadSource::find($id);
        $industry = Industry::find($id);
        $status = LeadStatus::find($id);

        return response()->json(['source'=>$source,'industry'=>$industry,'status'=>$status]);

        
        // return response($industry);

        
        // return response([$status,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function LeadSourceUpdate(Request $request)
    {

          $request->validate(
             [
                'source_name'=>'required|string',

              ]);

            $source =  LeadSource::where('source_id', $request->source_id)->update([

                'source_name'=>$request->source_name,
          ]);

       
       return response()->json(['status'=>1, 'message'=>'Lead Source Updated Successfully']);
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

    public function changesourceStatus(Request $request)
    {
   
        $source =  LeadSource::where('source_id' ,$request->source_id)->first();
        $source->status = $request->status;
        $source->update();

         return response()->json(['status'=>1, 'message'=>' Lead Source Status Changed Successfully']);
       
      
    }

     public function LeadStatusUpdate(Request $request)
    {

          $request->validate(
             [
                'status_name'=>'required|string',

              ]);

            $status =  LeadStatus::where('status_id', $request->status_id)->update([

                'status_name'=>$request->status_name,
          ]);

       
       return response()->json(['status'=>1, 'message'=>'Lead Status Updated Successfully']);
    }


    public function changeStatus(Request $request)
    {
            
   
        $status =  LeadStatus::where('status_id' ,$request->status_id)->first();
        $status->status = $request->status;
        $status->update();

         return response()->json(['status'=>1, 'message'=>' Lead  Status Changed Successfully']);
       
      
    }

    public function LeadIndustryUpdate(Request $request)
    {

          $request->validate(
             [
                'industry_name'=>'required|string',

              ]);

            $industry =  Industry::where('industry_id', $request->industry_id)->update([

                'industry_name'=>$request->industry_name,
          ]);

       
       return response()->json(['status'=>1, 'message'=>'Lead Industry Updated Successfully']);
    }

    public function changeIndustryStatus(Request $request)
    {
            
   
        $industry =  Industry::where('industry_id' ,$request->industry_id)->first();
        $industry->status = $request->status;
        $industry->update();

      return response()->json(['status'=>1, 'message'=>' Lead  Industry Status Changed Successfully']);
       
      
    }
}