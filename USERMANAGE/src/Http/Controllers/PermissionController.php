<?php
namespace Modules\USERMANAGE\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\USERMANAGE\Models\Permission;



class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userpermissionlist = Permission::all();
        return view('permission.index' ,compact('userpermissionlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->permissions_name = $request->permissions_name;
        $permission->permissions_slug = $request->permissions_slug;
        $permission->sort_order = $request->sort_order;
        $permission->status = $request->status;

        $permission->save();

        return redirect()->route('permission.index')->with('success','Record Inserted successfully');

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
        $permission = Permission::find($id);
        return view('permission.edit' , compact('permission'));
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
        $permission =  Permission::find($id);
        $permission->permissions_name = $request->permissions_name;
        $permission->permissions_slug = $request->permissions_slug;
        $permission->sort_order = $request->sort_order;
        $permission->status = $request->status;

        $permission->update();

        return redirect()->route('permission.index')->with('success','Record Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->route('permission.index')->with('success','Record delete successfully');
    }
}
