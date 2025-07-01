<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Guideline;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;

class GuidelinesController extends Controller
{
    /**
     * Display a listing of the Guidelines.
     */
    public function index()
    {
        $title="Guidelines List";
        $sertitle=Session::get('Mtitle');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id');

        $lists = Guideline::query();
        if (!empty($sertitle)) {
            $lists->where('menu_title', 'LIKE', "%{$sertitle}%");
        }
        if (!empty($approve_status)) {
            $lists->where('txtstatus',$approve_status);
        }
        if (!empty($language_id)) {
            $lists->where('language',$language_id);
        }
        $list=$lists->orderBy('created_at', 'DESC')->paginate(10);
          
        return view('admin/guideline/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new the Guidelines.
     */
    public function create()
    {
        $title="Add Guidelines ";
        return view('admin/guideline/add',compact(['title']));
    }

    /**
     * Store a newly created the Guidelines in storage.
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
            return redirect('admin/guidelines');
        }

        $txtuplode1 ='';
        $rules = array(
            'language' => 'required',
            'menu_title' => 'required',
            'txtstatus' => 'required',
            // 'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
            // 'txtuplode' => 'required|mimes:pdf|max:2048', 
        );

        if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/guidelines/')) {
                mkdir('public/upload/admin/cmsfiles/guidelines/', 0777, TRUE);
            }
            
            $txtuplode1 = str_replace(' ','_',clean_single_input($request->menu_title)).'_guidelines'.'.'.$request->txtuplode->extension();  
            $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/guidelines/'), $txtuplode1);
            
            if($res){
                $txtuplode1 =$txtuplode1;
            }
            $txtuplode2 ='upload/admin/cmsfiles//guidelines/'.$txtuplode1; //die();
            
            if (file_exists($txtuplode2)) {
                unlink($txtuplode2);
            }
        }
       
        $validator = Validator::make($request->all(), $rules);
       
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
          
           $pArray['menu_title']    				= clean_single_input($request->menu_title); 
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           
           $create 	= Guideline::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $lastInsertID,
                    'page_name'             =>  clean_single_input($request->menu_title),
                    'page_action'           =>  'Insert',
                    'page_category'         =>  '',
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'User Guideline',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/guidelines')->with('success','Guidelines has successfully added');
            }
          
        }
    }

    /**
     * Display the specified the Guidelines.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified Officer Messages.
     */
    public function edit(string $id)
    {
        $title="Edit Guidelines ";
        $id=clean_single_input($id);
        $data = Guideline::find($id);
        return view('admin/guideline/edit',compact(['title','data']));
    }

    /**
     * Update the specified the Guidelines in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'language' => 'required',
            'menu_title' => 'required',
            'txtstatus' => 'required',
            // 'txtuplode' => 'required|mimes:pdf,xlx,scsv|max:2048',
            // 'txtuplode' => 'required|mimes:pdf|max:2048', 
        );
        $valid = array(
            'menu_title.required'=>'Guideline title field  is required',
             'txtstatus.required' =>'Status field is required'
        );

        if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/guidelines/')) {
                mkdir('public/upload/admin/cmsfiles/guidelines/', 0777, TRUE);
            }
            
            $txtuplode1 = str_replace(' ','_',clean_single_input($request->menu_title)).'_guideline'.'.'.$request->txtuplode->extension();  
       
            $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/guidelines/'), $txtuplode1);
              
            if($res){
                $txtuplode1 =$txtuplode1;
            }
            $txtuplode2 ='upload/admin/cmsfiles//guidelines/'.$txtuplode1; //die();

            if (file_exists($txtuplode2)) {
                unlink($txtuplode2);
            }
            
        }else{
            $txtuplode1 =$request->olduplode;
        }

        $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
        }else{
            $user_login_id=Auth()->user()->id;

            $pArray['menu_title']    				= clean_single_input($request->menu_title); 
            $pArray['language']    			        = clean_single_input($request->language); 
            $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
            $pArray['admin_id']  					= clean_single_input($user_login_id); 
            $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 

            $create = Guideline::where('id', $id)->update($pArray);
            if($create > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                                'page_id'               =>  $id,
                                'page_name'             =>  clean_single_input($request->menu_title),
                                'page_action'           =>  'Update',
                                'page_category'         =>  '',
                                'lang'                  =>  1,
                                'page_title'            => 'User Guideline',
                                'approve_status'        => clean_single_input($request->txtstatus),
                                'usertype'              => 'Admin'
                            );
                            
                audit_trail($audit_data);
                return redirect('admin/guidelines')->with('success','Guidelines has successfully Updated');
            }
           
        }
    }

    /**
     * Remove the specified the Guidelines from storage.
     */
    public function destroy(Guideline $guideline)
    {
        $delete= $guideline->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'               =>  $guideline->id,
                            'page_name'             =>  clean_single_input($guideline->menu_title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  1,
                            'page_title'            => 'User Guideline',
                            'approve_status'        => 1,
                            'usertype'              => 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/guidelines')->with('success','Guideline deleted successfully');
        }
       
    }
}
