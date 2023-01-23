<?php

namespace Modules\Newsletter\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Newsletter\Models\Template;
use Modules\Newsletter\Models\TemplateList;
use Modules\Newsletter\Models\TemplateToGroup;
use Redirect;

class TemplateListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template_list = TemplateList::paginate(10);
        return view('Newsletter::templatelist.index', compact('template_list','TemplateToGroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template_group_list = Template::where('status',1)->get();
        return view('Newsletter::templatelist.create',compact('template_group_list'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $template = new TemplateList();
        $template->subject = $request->subject;
        $template->content = $request->content;
        $template-> updated_at = null;
        $template->save();
        
        $templateid = $template->id;
         
        $templategroup = TemplateToGroup::create([
            'group_id'    => $request->group_list,
            'template_id' => $templateid,
            'status'      => 1,
        ]);

        return redirect('template-lists/'.$templategroup->group_id)->with('success', 'Template Added successfully');  
        // return Redirect::back()->with('success', 'Template Added successfully');
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
    public function TemplateList(Request $request,$id)
    {
        $templategroup = Template::find($id);
        $template_list = TemplateList::paginate(10);
        $TemplateToGroup = TemplateToGroup::where(['group_id' => $templategroup->id])->get();
        return view('Newsletter::templatelist.index', compact('template_list','templategroup','TemplateToGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $templategroup = TemplateToGroup::find($id);
        $template = TemplateList::where('id',$templategroup->template_id)->first();
        $edittemplategroup = Template::where('id',$templategroup->group_id)->first();
        $template_group_list = Template::where('status',1)->get();
        return view('Newsletter::templatelist.edit', compact('template','template_group_list','edittemplategroup','templategroup'));

        // return response($template);
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
        
        $template = TemplateList::find($id);
        $template->subject = $request->subject;
        $template->content  = $request->content;
        $template->update();
        $templategroup = TemplateToGroup::where('template_id',$id)->first();
        $templategroup->group_id = $request->group_list;
        $templategroup->update();
        // return redirect()->route('template-list.index')->with('success', 'Template  Updated successfully');
        return Redirect::back()->with('success', 'Template  Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       
        // return response()->json(['status' => 1, 'message' => 'Employee Status changed Successfully']);

    }

    public function TemplateListUpdate(Request $request)
    { 

        // $template =  TemplateList::where('id', $request->id)->update([

        //     'subject' => $request->subject,
        //     'content' => $request->content,
        // ]);
        // return response()->json(['template' => $template, 'success' => 'Template Update Successfully']);
    }


    public function TemplateListDestroy(Request $request)
    {  
        if (TemplateList::find($request->id)->exists()) {
        $template = TemplateList::find($request->id)->delete();
            return response()->json(['template' => $template, 'success' => 'Template Deleted Successfully']);
        }else{
            return response()->json(['error' => "Template can't be Deleted"]);
        }
    }

    public function ChangeTemplateListStatus(Request $request)
    {
        $template = TemplateToGroup::find($request->id);
        $template->status = $request->status;
        $template->update();
        return response()->json(['success' => 'Template Status Change Successfully']);
    }
}
