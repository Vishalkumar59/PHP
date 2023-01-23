<?php
namespace Modules\UserManage\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\UserManage\Models\Department;
use Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $department_list = Department::orderBy('created_at','DESC')->get();
        return view('UserManage::department.index', compact('department_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {    
        // return view('department.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

        

        $department = new Department();
        $department->dept_name = $request->department_name;
        $department->dept_details = $request->department_details;
        $department->created_by = Auth::user()->id;
        $department->status = 1;
        $department->save();

    return redirect()->route('department.index')->with('success','Department Added Successfully');

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
        $department = Department::find($id);
        return response($department);
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        

        $department = Department::find($id);
        $department->dept_name = $request->department_name;
        $department->dept_details = $request->department_details;
        $department->created_by = Auth::user()->id;
        $department->update();

        return redirect()->route('department.index')->with('success',' Department Updated Successfully');


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

    public function departmentUpdate(Request $request){

        
       $department =  Department::find($request->department_id);
       $department->dept_name = $request->dept_name;
       $department->dept_details = $request->dept_details;
       $department->update();  
       return response()->json(['status'=>1, 'success'=>'Department Updated Successfully']);
   }

   public function changedepartmentStatus(Request $request)
    {
        $department =  Department::find($request->department_id);
        $department->status = $request->status;
        $department->update();
        return response()->json(['status'=>1, 'message'=>' Department  Status changed Successfully']);
        
    }  
    public function departmentDestroy(Request $request)
    {
        
        $department = Department::where('department_id', $request->department_id)->delete();
        return response()->json(['success' => 'Departmnet Deleted Successfully']);
    }
}
