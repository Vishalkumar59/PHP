<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SEO\Models\Website;
use Modules\SEO\Models\SeoTitle;
use Carbon\Carbon;
use DB;
use Modules\SEO\Models\SeoWebsiteResult;

class SeoWebsiteResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $web_setting = Website::get();
        $seotitle = SeoTitle::OrderBy('sort_order', 'asc')->where('parent_id', 0)->get();

        $now = Carbon::now();

        $year = $now->format('Y');

        $month = $now->format('m');

        $yeardata = Carbon::now()->addYear(28);
        $addyear = $yeardata->format('Y');

        $subdata = Carbon::now()->subYear(10);
        $subyear = $subdata->format('Y');
       
        if (!empty($seotitle)) {
            $seotitle = $seotitle->map(function ($result) {
                $result->child = SeoTitle::where('parent_id', $result->id)->get();
                return $result;
            });
        }

        $this->seotitle = $seotitle;

       
        return view('SEO::seo-monthly-result.index' , compact('web_setting','seotitle','year','month','addyear','subyear'));
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

        $result_value=$request->result_value;
        $title_id=$request->title_id;
         
        $count_items = count($result_value);
        for($i=0; $i <= $count_items; $i++){
       
            if(!empty($result_value[$i])){
            SeoWebsiteResult::updateOrCreate([
            'result_title_id'=>$title_id[$i]
            ],
            [
                'result_value'=>$result_value[$i],
                'website_id'=>$request->website_id,
                'month' =>  $request->month,
                'year'  =>  $request->year,
            ]);
        }
       

        return redirect()->route('seo-result.index')->with('success','Updated successfully!!');

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
        //
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



    public function getMonthlyResult(Request $request)
    {

        // GET SEO RESULT
        $seo_result = array();
        $seo_result = DB::table('seo_website_result')
            ->select('id','result_title_id', 'result_value')
            ->where([
                "website_id" => $request->website_id,
                "month" => $request->month,
                "year" => $request->year
            ])
            ->get();
           

        $result_array = array();
        if (!empty($seo_result)) {
            foreach ($seo_result as $result) {
                $result_array[$result->result_title_id] = $result->result_value;
            }
        }



        // GET PARENT TITLE
        $seo_title = SeoTitle::select('id', 'title_name', 'parent_id', 'status', 'created_at')
            ->OrderBy('sort_order', 'asc')
            ->where('parent_id', 0)
            ->get();

        // GET CHILD TITLE
        if (!empty($seo_title)) {
            $seo_title = $seo_title->map(function ($title) {

                $title->child = SeoTitle::where('parent_id', $title->id)->get();

                return $title;
            });
        }

        $data['seo_title'] = $seo_title;
        $data['seo_result'] = $result_array;


        return response()->json($data);
    }
}
