<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Title;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Image;

class TitleController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
  
    public function index()
    {
       
        $sertitle=Session::get('ttitle');
        $txtstatus=Session::get('txtstatus');
        $language_id=Session::get('language_id');
       
        if (!empty($sertitle)) {
            $lists = Title::where('titleType','title');
            $lists->where('title', 'LIKE', "%{$sertitle}%");
           
        }else{
            $lists = Title::where('titleType','title');
        }
        if (!empty($txtstatus)) {
           
            $lists->where('txtstatus',$txtstatus);
        }
        if (!empty($language_id)) {
           
            $lists->where('language',$language_id);
        }
        $list=$lists->orderBy('created_at', 'DESC')->select('id','title','page_url','language','icons','titleType','txtstatus','admin_id')->paginate(10);
        $title="Title List";
         
         return view('admin/titles/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Title ";
        return view('admin/titles/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->search)){
             $ttitle=clean_single_input(trim($request->ttitle));
             $txtstatus=clean_single_input($request->txtstatus);
             $language_id=clean_single_input($request->language_id);
             Session::put('ttitle', $ttitle);
             Session::put('txtstatus', $txtstatus);
             Session::put('language_id', $language_id);
             return redirect('admin/title');
           }
        if(isset($request->cmdsubmit)){  
        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'for' => 'required',
            'txtstatus' => 'required'
        );
        $rule = array(
            'menu_title.required' => 'Please Enter Title',
            'language.required' => 'Please Select Language',
            'for.required' => 'Please Enter For',
            'txtstatus.required' => 'Please Select Status'
        );
         $validator = Validator::make($request->all(), $rules,$rule);
        if ($validator->fails()) {
      
            return redirect('admin/title/create')->withErrors($validator)->withInput();
            
        }else{
           
            
            $user_login_id=Auth()->user()->id; 
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['icons']  				        = clean_single_input($request->icons);
            $pArray['page_url']  				    = Str::slug(clean_single_input($request->for));
			$pArray['admin_id']  					= $user_login_id;
            $pArray['titleType']  					= 'title';
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			//dd($pArray);
			$create 	= Title::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Title Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/title')->with('success','Title has successfully added');
			}
           
        }
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title="Edit Title ";
        $id=clean_single_input($id);
        $data = Title::find($id);
        return view('admin/titles/edit',compact(['title','data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'for' => 'required',
            'txtstatus' => 'required'
        );
        $rule = array(
            'menu_title.required' => 'Please Enter Title',
            'language.required' => 'Please Select Language',
            'for.required' => 'Please Enter For',
            'txtstatus.required' => 'Please Select Status'
        );
       
        $validator = Validator::make($request->all(), $rules,$rule);
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
           
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['language']    					= clean_single_input($request->language); 
            $pArray['icons']  				        = clean_single_input($request->icons);
            $pArray['page_url']  				    = Str::slug(clean_single_input($request->for));
			$pArray['admin_id']  					= $user_login_id;
            $pArray['titleType']  					= 'title';
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);

            $create 	= Title::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Title Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/title')->with('success','Title has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Title $title)
    {

        $delete = $title->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $title->id,
                            'page_name'             =>  clean_single_input($title->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($title->language),
                            'page_title'        	=> 'Title Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/title')->with('success','Title deleted successfully');
         }
       
        
    }
}
