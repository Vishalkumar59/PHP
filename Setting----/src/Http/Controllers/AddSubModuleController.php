<?php
namespace Modules\Setting\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Setting\Models\AppModule;
use Modules\Setting\Models\AppModuleSection;


class AddSubModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_module = AppModule::all();
        return view('module-management.module_management',compact('app_module'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appmodulesection = new AppModuleSection();
        $appmodulesection->module_id =  $request->module_id;
        if($sub_module->parent_section_id = ''){
           $sub_module->parent_section_id = 0;
        }  
        else{
            $sub_module->parent_section_id = $request->Parent_section;
        }
        $appmodulesection->section_name = $request->section_name;
        $appmodulesection->section_slug = Str::lower($request->section_name);
        $appmodulesection->section_icon = $request->section_icon;
        $appmodulesection->section_url  = $request->section_url;
        $appmodulesection->sort_order   = $request->sort_order;
        $appmodulesection->save();

        return redirect()->route('module-management.index')->with('success','Sub_Module added succesfully');
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
    public function edit($lead_id)
    {

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

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
    }
   
}
 