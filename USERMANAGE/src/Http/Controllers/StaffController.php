<?php

namespace Modules\USERMANAGE\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\USERMANAGE\Models\Staff;
use Modules\USERMANAGE\Models\StaffAddress;
use Modules\USERMANAGE\Models\User;
use Modules\USERMANAGE\Models\Department;
use Modules\USERMANAGE\Models\Designation;
use Modules\USERMANAGE\Models\Country;
use Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff_list = Staff::orderBy('created_at', 'DESC')->get();
        $staff_addess_list = StaffAddress::orderBy('created_at', 'DESC')->get();
        return view('staff.index', compact('staff_list', 'staff_addess_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        $user_list = User::all();
        $department_list = Department::all();
        $designation_list = Designation::all();
        $country_list = Country::all();

        return view('staff.create', compact('user_list', 'department_list', 'designation_list', 'country_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $staff = new Staff();
        $staff->employee_id     = $request->employee_id;
        $staff->user_id         = $request->user_id;
        $staff->department_id   = $request->department_id;
        $staff->designation_id  = $request->designation_id;
        $staff->gender          = $request->gender;
        $staff->marital_status  = $request->marital_status;
        $staff->staff_name      = $request->staff_name;
        $staff->staff_email     = $request->staff_email;
        $staff->staff_phone     = $request->staff_phone;
        $staff->date_of_birth   = $request->dataOfBirth;
        $staff->date_of_joining = $request->dateOfJoining;
        $staff->salary          = $request->salary;
        $staff->save();

        $staff_id = $staff->staff_id;

        $staffAddress = StaffAddress::create([
            'street_address'     =>  $request->street_address,
            'city'               =>  $request->city,
            'state'              =>  $request->state,
            'postcode'           =>  $request->pincode,
            'countries_id'       =>  $request->country,
            'phone_no'           =>  $request->phone_no,
            'staff_id'        =>     $staff_id,
        ]);
        return redirect()->route('employee.index')->with('success', 'Employee Added successfully');
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

        $staff = Staff::find($id);
        //    dd($staff);
        $user_list = User::all();
        $department_list = Department::all();
        $designation_list = Designation::all();
        $country_list = Country::all();

        $staff_address = StaffAddress::where('staff_id', $staff->staff_id)->first();
        // dd($staff_address);
        return view('staff.edit', compact('staff', 'staff_address', 'user_list', 'department_list', 'designation_list', 'country_list'));
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

        $staff = Staff::find($id);
        $staff->employee_id     = $request->employee_id;
        $staff->user_id         = $request->user_id;
        $staff->department_id   = $request->department_id;
        $staff->designation_id  = $request->designation_id;
        $staff->gender          = $request->gender;
        $staff->marital_status  = $request->marital_status;
        $staff->staff_name      = $request->staff_name;
        $staff->staff_email     = $request->staff_email;
        $staff->staff_phone     = $request->staff_phone;
        $staff->date_of_birth   = $request->dataOfBirth;
        $staff->date_of_joining = $request->dateOfJoining;
        $staff->salary          = $request->salary;
        $staff->update();

        $staff_id = $staff->staff_id;
        $staffAddress = StaffAddress::create([
            'street_address'     =>  $request->street_address,
            'city'               =>  $request->city,
            'state'              =>  $request->state,
            'postcode'           =>  $request->pincode,
            'countries_id'       =>  $request->country,
            'phone_no'           =>  $request->phone_no,
            'staff_id'        =>     $staff_id,
        ]);
        return redirect()->route('employee.index')->with('success', 'Employee Upddated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $staff = Staff::find($id);
        $staff->delete();

        return redirect()->route('employee.index')->with('success', 'Employee Deleted Successfully');
    }

    public function changeEmployeeStatus(Request $request)
    {

        $staff =  Staff::find($request->staff_id);
        $staff->status = $request->status;
        $staff->update();
        return response()->json(['status' => 1, 'message' => 'Employee Status changed Successfully']);
    }
}
