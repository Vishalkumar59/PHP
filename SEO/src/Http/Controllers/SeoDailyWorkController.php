<?php

namespace Modules\SEO\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\SEO\Models\SeoTask;
use Modules\SEO\Models\Website;
use Modules\SEO\Models\Country;
use Auth;
use Carbon\Carbon;
use Modules\SEO\Models\SeoSubmissionWebsites;
use Modules\SEO\Models\WorkReport;
use Validator;

class SeoDailyWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrylist = Country::all();
        $seo_task_listing = SeoTask::all();
        $website_listing = Website::all();
       
        // $website_listing->map(function ($seo) use ($countrylist) {
        // $seo->website = Website::where('countries_id', '=', $countrylist->countries_id)->get();
        // return $seo;
        if(!empty($website_listing)){
        $countryData = $website_listing->map(function($countrylist)  {
            $countrylist->parentName=Country::where('countries_id',$countrylist->countries_id)->get();
           
            return $countrylist;
           });
        }

         

        return view('SEO::seo-daily-report.index', compact('seo_task_listing','countrylist','website_listing'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $website_listing = Website::find($id);
        $website_name = $website_listing->website_name;

        $user_id = Auth::user()->id;
        $today_date = Carbon::today()->toDateString();



        $seo_task_listing = SeoTask::all();
        if(!empty($seo_task_listing)){
            $seo_task_listing->map(function ($seo) use ($website_listing, $today_date) {
                // dd($website_listing);
            $seo->website_submission = SeoSubmissionWebsites::where('website_id', '=', $website_listing->id)->get();
            // dd($seo->website_submission);
            $seo->work_report = WorkReport::where('website_id', '=', $website_listing->id)->where('seo_task_id', $seo->id)->where('created_at', 'LIKE', '%' . $today_date . '%')->get();
            return $seo;
            });
        }
        // dd($website_listing);
        $this->seo_task_listing = $seo_task_listing;

        return view('SEO::seo-daily-report.edit', compact('seo_task_listing', 'website_listing', 'user_id', 'website_name'));
        }else{
            return redirect()->route('daily-work')->with('error','Something Error!');
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


    public function work_report_update(Request $request, $id)
    {
        // dd($request->all());
       
        $website_id  = $request->website_id;
        
        $total_report = $request->total_report;

        // $count_items = count($website_url);
        
      
        // for ($i = 0; $i < $count_items; $i++) {
        //     if ($landing_url[$i] != '') {

        //         if(empty($update_id[$i])){
                    
 
        //            $work_report = WorkReport::create([

        //                 'user_id' => Auth::user()->id,
        //                 'website_id' => $request->website_id,
        //                 'seo_task_id' => $request->seo_task_id,
        //                 'submission_websites_id' => $submission_url[$i],
        //                 'website_url' => $website_url[$i],
        //                 'landing_url' => $landing_url[$i]
        //             ]);
                    
        //         }else{
                    
        //             $work_report = WorkReport::where('id', $update_id[$i])->update([

        //                 'submission_websites_id' => $submission_url[$i],
        //                 'website_url' => $website_url[$i],
        //                 'landing_url' => $landing_url[$i]
        //             ]);
                    
        //         }
        //     }
            
        //     // else{
        //     //     return response()->json(['error' => 'Please Add Data']);
        //     // }
        // }

        for($i = 1; $i<= $total_report; $i++ ){


            if($request->input('website_url_'.$i) != null) {
                $update_id = $request->input('update_id_'.$i);
                $website_url = $request->input('website_url_'.$i);
                $landing_url = $request->input('landing_url_'.$i);
                $submission_url = $request->input('postingWebsite_'.$i);


                WorkReport::updateOrCreate(
                    ['id' => $update_id],
                    [
                    'user_id' => Auth::user()->id,
                    'website_id' => $request->website_id,
                    'seo_task_id' => $request->seo_task_id,
                    'submission_websites_id' => $submission_url,
                    'website_url' => $website_url,
                    'landing_url' => $landing_url
                ]);
            }
        }



        return response()->json(['success' => 'Work Report Added Successfully']);
        
        
    }
    public function dailyWorkStatus(Request $request)
    {
        // dd($request->all());
        $website =  Website::where('id' ,$request->website_id)->first();
        $website->status = $request->status;
        $website->update();
        return response()->json(['status'=>1, 'success'=>' Daily Work Status Changed Successfully']);
    }
}
