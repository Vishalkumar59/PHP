<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SEO\Models\SeoTask; 
use Modules\SEO\Models\SeoSubmissionWebsites;
use Modules\SEO\Models\Website;
use  Auth;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seotasklist=SeoTask::paginate(10);
        $seosubmissionwebsites = SeoSubmissionWebsites::paginate(10);
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
        $websites = Website::all();
        $seotask = SeoTask::all();
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
        

        $Seowebsites = new SeoSubmissionWebsites();
        $Seowebsites->website_id = $request->website;
        $Seowebsites->seo_task_id = $request->seotask;
        $Seowebsites->website_url = $request->website_url;
        $Seowebsites->website_username = $request->username;
        $Seowebsites->website_password = $request->password;
        $Seowebsites->da = $request->da;
        $Seowebsites->status=$request->status;
        $Seowebsites->save();

        return redirect()->route('submission.index')->with('success','Submission details Inserted successfully!!');

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
        $websites = Website::all();
        $seotask=SeoTask::all();

        $seosubmissionwebsites = SeoSubmissionWebsites::find($id);
        

        return view('SEO::seo-submission-url.edit' ,compact('websites','seotask','seosubmissionwebsites'));
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
        $Seowebsites = SeoSubmissionWebsites::withoutGlobalScope('active')->findOrFail($id);
        $Seowebsites->website_id = $request->website;
        $Seowebsites->seo_task_id = $request->seotask;
        $Seowebsites->website_url = $request->website_url;
        $Seowebsites->website_username = $request->username;
        $Seowebsites->website_password = $request->password;
        $Seowebsites->da = $request->da;
        $Seowebsites->status=$request->status;
        $Seowebsites->update();

        return redirect()->route('submission.index')->with('success','Submission details Updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (SeoSubmissionWebsites::where('id', $id)->exists()) {

            SeoSubmissionWebsites::where('id',$id)->delete();
            // UserHasRoles::where('users_id', $request->user_id)->delete();
            return response()->json(['success' => 'User deleted successfully']);
        } else{
            return response()->json(['error' => 'User already deleted!']);
        }
    }

    public function getSubmissionUrl(Request $request)
    {

        if($request->seo_task_id =='0' && $request->website_id != '0')  $search_ary = array('website_id'=>$request->website_id);
        else if($request->website_id =='0' && $request->seo_task_id !='0')  $search_ary = array('seo_task_id'=>$request->seo_task_id);
        else if ($request->seo_task_id !='0' && $request->website_id != '0')  $search_ary = array('website_id'=>$request->website_id,'seo_task_id'=>$request->seo_task_id);

        
        $seotasklist = SeoTask::get();
        $website = Website::get();

        $seosubmissionwebsites = SeoSubmissionWebsites::select('id','website_id','seo_task_id','website_url','website_username','website_password','date_added','status')->where($search_ary)->get();

       
        $data['seotasklist']=$seotasklist;
        $data['website']=$website;
        $data['seosubmissionwebsites']=$seosubmissionwebsites;

        return response()->json($data);
    }
}
