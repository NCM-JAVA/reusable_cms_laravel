<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Title;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;

class SocialmediaController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
  
    public function index()
    {
            
         $title="Social Media List";
         $sertitle=Session::get('Mtitle');
         $approve_status=Session::get('approve_status');
         $language_id=Session::get('language_id');

         $lists = Title::where('titleType','socialMedia');
           if (!empty($sertitle)) {
               $lists->where('title', 'LIKE', "%{$sertitle}%");
           }
           if (!empty($approve_status)) {
               $lists->where('txtstatus',$approve_status);
           }
           if (!empty($language_id)) {
               $lists->where('language',$language_id);
           }
           $list=$lists->orderBy('created_at', 'DESC')->paginate(10);
       
         $list = $lists->paginate(10);

         return view('admin/socialMedia/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Social Media ";
        return view('admin/socialMedia/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->search)){
            $Mtitle=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('Mtitle', $Mtitle);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/socialMedia');
        }

        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'page_url'=>'required',
            'txtstatus' => 'required'
        );
         $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
      
            return redirect('admin/socialMedia/create')->withErrors($validator)->withInput();
            
        }else{
           
            
            $user_login_id=Auth()->user()->id; 
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['icons']  				        = clean_single_input($request->icons);
            $pArray['page_url']  				    = clean_single_input($request->page_url);
			$pArray['admin_id']  					= $user_login_id;
            $pArray['titleType']  					= 'socialMedia';
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			
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
								'page_title'        	=> 'Social Media Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/socialMedia')->with('success','Social Media has successfully added');
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
        $title="Edit Social Media ";
        $id=clean_single_input($id);
        $data = Title::find($id);
        return view('admin/socialMedia/edit',compact(['title','data']));
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
            'page_url'=>'required',
            'txtstatus' => 'required'
        );
       
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
           
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['language']    					= clean_single_input($request->language); 
            $pArray['icons']  				        = clean_single_input($request->icons);
            $pArray['page_url']  				    = clean_single_input($request->page_url);
			$pArray['admin_id']  					= $user_login_id;
            $pArray['titleType']  					= 'socialMedia';
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);

            $create 	= Title::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Social Media Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/socialMedia')->with('success','Social Media has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Title $title, $id)
    {
        $data = Title::find($id);
        $delete= $data->delete();

        // $delete = $title->delete();

        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $data->id,
                            'page_name'             =>  clean_single_input($data->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> 'Social Media  Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/socialMedia')->with('success','Social Media deleted successfully');
         }
       
        
    }
}
