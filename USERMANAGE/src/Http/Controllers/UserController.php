<?php

namespace Modules\USERMANAGE\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\USERMANAGE\Models\User;
use Modules\USERMANAGE\Models\Role;
use Illuminate\Support\Facades\Hash;
use Modules\USERMANAGE\Models\UserHasRoles;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_list = User::with('role')->get();
        $role_list = UserHasRoles::with('roles')->get();
        return view('user.index', compact('user_list', 'role_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_list = Role::all();
        return view('user.create', compact('role_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = '1';
        $user->save();

        $user_id = $user->id;

        UserHasRoles::create([
            'roles_id' => $request->role,
            'users_id' => $user_id,
        ]);

        return redirect()->route('user.index')->with('success', 'User Added successfully');
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
        $role_list = Role::all();
        $user = User::find($id);
        $role_list1 = UserHasRoles::where('users_id', $user->id)->first();
        return view('user.edit', compact('role_list', 'user', 'role_list1'));
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
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->update();


        return redirect()->route('user.index')->with('success', 'User details Updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        UserHasRoles::where('users_id', $id)->delete();
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',

        ]);

        User::find(Auth::id())->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back()->with('success', 'Password Updated Successfully.');;
    }



    public function ChangeUserStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->update();
        return response()->json(['status' => 1, 'message' => 'User Status changed Successfully']);
    }
}
