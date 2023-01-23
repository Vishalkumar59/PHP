<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SEO\Models\Website;
use Modules\SEO\Models\SeoTitle;
use Carbon\Carbon;
use DB;
use Modules\SEO\Models\SeoWebsiteResult;
use App\Helper\Helper;

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
       

        // if (!empty($seotitle)) {
        //     $seotitle = $seotitle->map(function ($result) {
        //         $result->child = SeoTitle::where('parent_id', $result->id)->get();
        //         return $result;
        //     });
        // }

        //$this->seotitle = $seotitle;

        return view('SEO::seo-monthly-result.index' , compact('web_setting','year','month','addyear','subyear'));
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

       
        if(!empty($request->website_id)){
            $title_id=$request->title_id;
            foreach($title_id as $key=>$value){
                $result_value=$request->input('result_change'.$value);
                SeoWebsiteResult::updateOrCreate([
                    'website_id'     =>$request->website_id,
                    'result_title_id'=>$value,
                    'month'          =>  $request->month,
                    'year'           =>  $request->year,
                    ],
                    [
                        'result_value'=>$result_value ?? '',
                       
                    ]);
            }
         return response()->json(['success'=>'Result Added successfully!!']);
        }else{
        return response()->json(['error'=>'Result insertion failed!']);
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

        // GET SEO RESULT of a website
        $seo_result = $seo_title = array();
        $result_array = array();
        $editable = 1;

        if(!empty($request->website_id)){

            $seo_result = DB::table('seo_website_result')
                ->select('id','result_title_id', 'result_value')
                ->where([
                    "website_id" => $request->website_id,
                    "month" => $request->month,
                    "year" => $request->year
                ])
                ->get();


           
            if (!empty($seo_result)) {
                foreach ($seo_result as $result) {
                    $result_array[$result->result_title_id] = $result->result_value;
                }
            }



            // GET PARENT TITLE
            $seo_title = SeoTitle::select('id', 'title_name', 'parent_id', 'status', 'created_at')
            ->OrderBy('sort_order', 'asc')
            ->where('parent_id', 0)
            ->where('status', '1')
            ->get();

            // GET CHILD TITLE
            if (!empty($seo_title)) {
                $seo_title = $seo_title->map(function ($title) {
                    $title->child = SeoTitle::where('parent_id', $title->id)->where('status', '1')->get();
                    $title->created_at->format('y-m-d');
                    return $title;
                });
            }




        }

       
   
        $this_month = Carbon::now();
        $input_month = Carbon::parse($request->year .'-'. $request->month.'-1');
        $diff = $input_month->diffInMonths($this_month);  // returns 1


        $role = Helper::role_slug();

        if($role=='super_admin'){
            $editable =1;
        } else if($role =='customer'){
            $editable = 0;
        } else{

            if($diff==0 || $diff<2){
                $editable =1;
            } else{
                $editable = 0;
            }
        }

      
        $data['seo_title'] = $seo_title;
        $data['seo_result'] = $result_array;
        $data['editable'] = $editable;


        return response()->json($data);
    }
}
