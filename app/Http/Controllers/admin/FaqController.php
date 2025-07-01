<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    /**
     * Display a listing of the Faq.
     */
    public function index()
    {
         $title="Faq List";
         $approve_status=session()->get('approve_status');
         $sertitle=Session::get('title');
         $approve_status=Session::get('approve_status');
         $language_id=Session::get('language_id');
         $lists = Faq::whereNotNull('title');
         if (!empty($title)) {
             $lists->where('title', 'LIKE', "%{$sertitle}%");
         }
         if (!empty($approve_status)) {
            
             $lists->where('txtstatus',$approve_status);
         }
         if (!empty($language_id)) {
            
             $lists->where('language',$language_id);
         }
         $list = $lists->orderBy('created_at', 'DESC')->select('id','title','url','admin_id', 'page_url','category','language','description','txtstatus')->paginate(10);

         return view('admin/faq/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new Faq.
     */
    public function create()
    {
        $title="Faq List";
         return view('admin/faq/add',compact(['title']));
    }

    /**
     * Store a newly created Faq in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->search)){
            $title=clean_single_input(trim($request->title));
             $approve_status=clean_single_input($request->approve_status);
             $language_id=clean_single_input($request->language_id);
             Session::put('title', $title);
             Session::put('approve_status', $approve_status);
             Session::put('language_id', $language_id);
             return redirect('admin/faq');
           }
        if(isset($request->cmdsubmit)){ 
            $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'language'=>'required',
            'description'=>'required',
            'txtstatus'=>'required',

            ],
            ['txtstatus.required'=>'Status field is required']
        
        );
          $user_login_id=Auth()->user()->id;
          $Faq = array(
           'title' => clean_single_input($request['title']),
           'url' => clean_single_input($request['url']),
           'page_url' => clean_single_input($request['url']),
           'language' => clean_single_input($request['language']),
           'description' => $request['description'] ,
           'txtstatus' => clean_single_input($request['txtstatus']),
           'admin_id'=> $user_login_id,
          );
           $create  = Faq::create($Faq);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'               =>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->title),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->url),
            'lang'                  =>  clean_single_input($request->language),
            'page_title'            => 'Faq Model',
            'approve_status'        => clean_single_input($request->txtstatus),
            'usertype'              => 'Admin'
        );
                           
               audit_trail($audit_data);
       
        return redirect('admin/faq')->with('success','Faq created successfully.');

      }
    }
}
    

    /**
     * Display the specified Faq.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified Faq.
     */
    public function edit($id)
    {
         $title=" Edit Faq";
         $id=clean_single_input($id);
         $list=faq::find($id);
        return view('admin.faq.edit',compact(['list','title']));
    }

    /**
     * Update the specified resource in Faq.
     */
    public function update(Request $request,$id)
    {
            $id=clean_single_input($id);
            $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'language'=>'required',
            'description'=>'required',
            'txtstatus'=>'required',

            ],
            ['txtstatus.required'=>'status field is required']);
            $user_login_id=Auth()->user()->id;
            $faqs = Faq::find($id);
            $faqs['title'] = clean_single_input($request['title']);
            $faqs['url'] = clean_single_input($request['url']);
            $faqs['page_url'] = clean_single_input($request['url']);
            $faqs['language'] = clean_single_input($request['language']);
            $faqs['description'] = $request['description'] ; //clean_single_input($request['description']);
            $faqs['txtstatus'] = clean_single_input($request['txtstatus']);
            $faqs['admin_id']=   $user_login_id;
            $faqs->save();

            $user_login_id=Auth()->user()->id;
           if($id > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'               =>   $id,
                    'page_name'             =>  clean_single_input($request->tender_title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'            => 'Faq Model',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'              => 'Admin'
                );
                           
               audit_trail($audit_data);
              return redirect('admin/faq')->with('success','faq updated successfully');
    }
}

    /**
     * Remove the specified resource from Faq.
     */
    public function destroy(faq $faq)
    {
        $delete= $faq->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $faq->id,
                            'page_name'             =>  clean_single_input($faq->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($faq->language),
                            'page_title'        	=> 'faq Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/faq')->with('success','FAQ deleted successfully');
         }
    }
}
