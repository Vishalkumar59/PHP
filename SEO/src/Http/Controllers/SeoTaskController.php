<?php
namespace Modules\SEO\Http\Controllers;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Modules\SEO\Models\SeoTask;

class SeoTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seotask = SeoTask::all();
        return view('SEO::seo-settings.seo-task.create',compact('seotask'));
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
        if($request){
        $task = new SeoTask();
        $task->seo_task_title = $request->seo_task_title;
        $task->task_priority = $request->task_priority;
        $task->task_frequency = $request->task_frequency;
        $task->no_of_submission = $request->no_of_submission;
        $task->status = '1';
        $task->save();

        return redirect()->route('workReport')->with('success','Task Added Successfully!');
        }else{
            return redirect()->route('workReport')->with('error','Task Insertion Failed!');
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
        $seotask = SeoTask::find($id);
        return view('SEO::seo-settings.seo-task.edit',compact('seotask'));
        }else{
            return redirect()->route('workReport')->with('error','Task Not Found!');
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
        
        
        if(isset($id)){
        $seotask = SeoTask::find($id);
        $seotask->seo_task_title =  $request->seo_task_title;
        $seotask->task_priority =  $request->task_priority;
        $seotask->task_frequency =  $request->task_frequency;
        $seotask->no_of_submission =  $request->no_of_submission;
        $seotask->update();
        return redirect()->route('workReport')->with('success','Task Updated Successfully!');
        }else{
            return redirect()->route('workReport')->with('error','Task Updation Failed');
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
        if($id){
        SeoTask::find($id);
        SeoTask::destroy($id);
        return response()->json(['success' => 'Task Deleted Successfully!']);
        }else{
             return response()->json(['error' => 'Task Already Deleted !']);
        }
    }
    public function changeTaskStatus(Request $request)
    {
       
        $task =  SeoTask::where('id' ,$request->task_id)->first();
        $task->status = $request->status;
        $task->update();
        return response()->json(['status'=>1, 'success'=>'Task Status Changed Successfully']);
    }
}
