<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SEO\Models\SeoTask; 
use Modules\SEO\Models\SeoSubmissionWebsites;
use Modules\SEO\Models\Website;
use  Auth;
use DB;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seotasklist=SeoTask::all();
        $seosubmissionwebsites = SeoSubmissionWebsites::all();
        $websitelist=Website::get();
        return view('SEO::seo-submission-url.index' ,compact('seotasklist','seosubmissionwebsites','websitelist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seotask=SeoTask::all();
        $websites = Website::all();
        return view('SEO::seo-submission-url.create' , compact('seotask','websites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request){
        $Seowebsites = new SeoSubmissionWebsites();
        $Seowebsites->website_id = $request->website;
        $Seowebsites->seo_task_id = $request->seotask;
        $Seowebsites->website_url = $request->website_url;
        $Seowebsites->website_username = $request->username;
        $Seowebsites->website_password = $request->password;
        $Seowebsites->da = $request->da;
        $Seowebsites->status= '1';
        $Seowebsites->save();

        return redirect()->route('submission.index')->with('success','Submission Website Added Successfully!!');
        }else{
            return redirect()->route('submission.index')->with('error','Submission Website Insertion Failed!!');
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
        $websites = Website::all();
        $seotask=SeoTask::all();
        $seosubmissionwebsites = SeoSubmissionWebsites::find($id);
         // dd($seosubmissionwebsites);
        return view('SEO::seo-submission-url.edit' ,compact('websites','seotask','seosubmissionwebsites'));
        }else{
            return redirect()->route('submission.index')->with('error','Submission Website Not Found!');
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
            $Seowebsites = SeoSubmissionWebsites::withoutGlobalScope('active')->find($id);
            $Seowebsites->website_id = $request->website;
            $Seowebsites->seo_task_id = $request->seotask;
            $Seowebsites->website_url = $request->website_url;
            $Seowebsites->website_username = $request->username;
            $Seowebsites->website_password = $request->password;
            $Seowebsites->da = $request->da;
            $Seowebsites->update();
            
            // $website_id = $request->website;
            // $seo_task_id = $request->seotask;
            // return $this->getSubmissionUrl($request->website, $request->seotask);
             // dd($request->website);
            // return response()->json($Seowebsites);

           return redirect()->route('submission.index')->with('success','Submission Website Updated Successfully!!');

        }else{
            return redirect()->route('submission.index')->with('success','Submission Website Updation Failed!');
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
        if(!empty($id)){
        $submission_id = SeoSubmissionWebsites::where('id', $id)->first();
            if (!empty($submission_id)) {

                $submission_id->delete();
                // UserHasRoles::where('users_id', $request->user_id)->delete();
                return response()->json(['submission_id'=>$submission_id,'success' => 'Submission Website Deleted Successfully']);
            } else{
                return response()->json(['error' => 'Submission Website Already Deleted!']);
            }
        }
    }

    public function getSubmissionUrl(Request $request)
    {

        // dd($request->all());
        $website_id = $request->website_id;
        $seo_task_id = $request->seo_task_id;
        $seosubmissionwebsites = array();

        if ($request->website_id && ($request->seo_task_id == '0')){
            
            $seosubmissionwebsites= DB::table('seo_submission_websites')->select('id','website_id','seo_task_id','website_url','website_username','website_password','created_at','status')->where('website_id', $website_id)->get();
          
           
        } else if ($request->seo_task_id && ($request->website_id == '0')){
           
            $seosubmissionwebsites = DB::table('seo_submission_websites')->select('id','website_id','seo_task_id','website_url','website_username','website_password','created_at','status')->where('seo_task_id', $seo_task_id)->get();
          
          
        } else if(!empty($website_id) && !empty($seo_task_id)){
              
            $seosubmissionwebsites= DB::table('seo_submission_websites')->select('id','website_id','seo_task_id','website_url','website_username','website_password','created_at','status')->where('website_id', $website_id)->where('seo_task_id', $seo_task_id)->get();
           
           
        }
      

        $seotasklist=SeoTask::get();
        $Websitelist=Website::get();
        $data['seotasklist']=$seotasklist;
        $data['websitelist']=$Websitelist;
        $data['seosubmissionwebsites']=$seosubmissionwebsites;
        return response()->json($data);

           
    }

    public function ChangeSubmissionStatus(Request $request)
    {
        $user = SeoSubmissionWebsites::find($request->id);
        $user->status = $request->status;
        $user->update();
        return response()->json(['status' => 1, 'success' => 'Submission Website Status changed Successfully']);
    }


}
