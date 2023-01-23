<?php
namespace Modules\UserManage\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request; 
use Modules\UserManage\Models\Role;
use Modules\UserManage\Models\Permission;
use Modules\UserManage\Models\User;
use Modules\Setting\Models\Module;
use Modules\Setting\Models\ModuleSection;
use Modules\UserManage\Models\RoleHasPermissions;
use Modules\UserManage\Models\UserHasRoles;
use Illuminate\Support\Str; 
use DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index1()
    // {
    //     
    // }
    public function index()
    {
        $role_list = Role::with('user')->orderBy('created_at', 'ASC')->get(); 
         
        return view('UserManage::role.index',compact('role_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module_name = Module::where('status',1)->get();
        $module_section = ModuleSection::where(['parent_section_id' => 0,'status' => 1])->get();
        $permission_list = Permission::where('status',1)->get();
        return view('UserManage::role.create' , compact('permission_list','module_name','module_section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'role_name' => 'required',
        ]);

        /* sort order */
        $sort_order = Role::max('sort_order');
        $sort_order = $sort_order+1;

        $role = new Role();
        $role->roles_key = \Str::slug($request->role_name, '_');
        $role->roles_name = $request->role_name;
        $role->sort_order = $sort_order;
        $role->save();

        $permissionList=[];
      
        if(sizeof($request->permission) > 0 ){
            foreach ($request->permission as $sectionId => $permission){
                $data = explode('.',$permission);
                    if(!empty($data) && $role->roles_id){
                        array_push($permissionList, [
                            'section_id'=>$data[0],
                            'roles_id'=>$role->roles_id,
                            'permissions_ids'=>$data[1],
                            'permission_types_id'=>$data[2],  
                        ]);
                    }
                }
            }

        foreach($permissionList as $permission){
            $permission_details = RoleHasPermissions::create($permission);
        }

        return redirect()->route('role.index')->with('success', 'Role Created Successfully');

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
     
        $module_name = Module::all();
        $module_section = ModuleSection::where('parent_section_id',0)->get();
        $role_list = Role::find($id);
       
        $permission_list = Permission::all();

        $rolePermissionList = RoleHasPermissions::where('roles_id',$role_list->roles_id)->get();
        return view('UserManage::role.edit', compact('role_list','permission_list','rolePermissionList','module_name','module_section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roles_id)
    {
        $request->validate([
            'role_name' => 'required',
        ]);

        $role = Role::where('roles_id' , $roles_id)->update([
            'roles_key' => \Str::slug($request->role_name, '_'),
            'roles_name'=>  $request->role_name,
        ]);
        $permissionList=[];
        
        if(sizeof($request->permission) > 0 ){
            foreach ($request->permission as $key => $permission){

                $perms_ary = explode('.',$permission);
                if(!empty($perms_ary)){
                    $section_id = $perms_ary[0];
                    $permission_id = $perms_ary[1];
                    $permission_type_id = $perms_ary[2];

                    // create or update permission 

                    $permission_details = RoleHasPermissions::updateOrCreate(
                        [
                           'roles_id'   =>$roles_id,
                           'section_id' => $section_id,
                           'permissions_ids' =>$permission_id,
                        ],
                        [
                           'permission_types_id' => $permission_type_id,

                        ]
                    );

                }
                
            }
        }
        return  redirect()->route('role.index')->with('success', 'Role updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($roles_id)
    {
        if (Role::where('roles_id', $roles_id)->exists()) {
        Role::where('roles_id' , $roles_id)->delete();
        UserHasRoles::where('roles_id', '=', $roles_id)->delete();
          return response()->json(['success' => 'Record delete successfully']);
        }else{
            return response()->json(['error' => 'User already deleted!']);
        }
    }

    public function sortorder(Request $request){
        $change_sortOrder =  Role::find($request->role_id);
        $change_sortOrder->sort_order = $request->sort_order;
        $change_sortOrder->update();
        return response()->json(['status'=>1, 'message'=>'Status Updated successfully']);
    }
}
