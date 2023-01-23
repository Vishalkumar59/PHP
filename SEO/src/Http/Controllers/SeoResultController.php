<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\SEO\Models\SeoResult;

class SeoResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $result = SeoResult::all();
        $seoresult = SeoResult::where('parent_id',0)->get();
        return view('SEO::seo-settings.seo-result.create', compact('result','seoresult'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDropdown(Request $request){
        // dd($request->all());
        if($request){
        $seoresult = SeoResult::where('parent_id',0)->get();
       return response()->json(['seoresult' => $seoresult]);    
        }
    }
    public function store(Request $request)
    {
        
        $title = new SeoResult();
        // dd($request->parent_section_id);
            if($request->parent_section_id == '0'){

                $title->title_name = $request->title;
                $title->parent_id = $request->parent_section_id;

            }else if($request->parent_section_id != '0'){

                $title->title_name = $request->title;
                $title->parent_id = $request->parent_section_id;
            }
            $title->status = '1';

            $title->save();

        if($title){
            return response()->json(['success' => 'Result Added Successfully!']);
        }else{
            return response()->json(['error' => 'Result insertion failed']);
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
        $section =  SeoResult::where('id' , $id)->first();
        $seoresult = SeoResult::where('parent_id',0)->get();
        $data['result']= $seoresult;
        $data['section']= $section;
        return json_encode($data); 
        }else{
            return response()->json(['error' => 'Something Error']);
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
        
        
    }

    public function resultUpdate(Request $request){

        // dd($request->all());

        if($request->id){

        $title = SeoResult::find($request->id);
        // dd($title->parent_id);
        if($request->section_type == '1'){
            $title->title_name = $request->title;
            $title->parent_id = $request->parent_id;
        }else{
            $title->title_name = $request->title;
            $title->parent_id = $request->section_type;
        }
            // if($request->parent_id == null){
            //      $title->title_name = $request->title;
            //      $title->parent_id = 0;
            // }else if ($request->parent_id != null){
            //      $title->title_name = $request->title;
            //      $title->parent_id = $request->parent_id;
            // }
        $title->update(); 
        return response()->json(['success'=>'Result Updated Successfully!', 'title' => $title]);
        }else{
            return response()->json(['error'=>'Result Updation Failed!']);
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
        if (SeoResult::where('id', $id)->exists()) {
            SeoResult::where('id',$id)->delete();
            return response()->json(['success' => 'Parent deleted successfully']);
        } else{
            return response()->json(['error' => 'Parent already deleted!']);
        }
    }
    public function ChildDelete($id)
    {
        if (SeoResult::where('id', $id)->exists()) {

            SeoResult::where('id',$id)->delete();
            return response()->json(['success' => 'Child deleted successfully']);
        } else{
            return response()->json(['error' => 'Child already deleted!']);
        }
    }
    public function changeWebsiteStatus(Request $request)
    {
        // dd($request->all());
        $website =  Website::where('id' ,$request->website_id)->first();
        $website->status = $request->status;
        $website->update();
        return response()->json(['status'=>1, 'success'=>' Website Status Changed Successfully']);
    }
    public function changeResultStatus(Request $request)
    {
       $website =  SeoResult::where('id' ,$request->result_id)->first();
       $website->status = $request->status;
       $website->update();
       return response()->json(['status'=>1, 'success'=>' Result Status Changed Successfully']);
    }
}
