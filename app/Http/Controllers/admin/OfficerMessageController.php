<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Officer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OfficerMessageController extends Controller
{
    /**
     * Display a listing of the Officer Messages.
     */
    public function index()
    {
        $title="Officer Messages List";
        $officers_name=Session::get('officers_name');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id');

        $lists = Officer::query();
        if (!empty($officers_name)) {
            $lists->where('officers_name', 'LIKE', "%{$officers_name}%");
        }
        if (!empty($approve_status)) {
            $lists->where('txtstatus',$approve_status);
        }
        if (!empty($language_id)) {
            $lists->where('language',$language_id);
        }
        $list=$lists->orderBy('created_at', 'DESC')->paginate(10);
    
        $list = $lists->paginate(10);
    
        return view('admin/officers/index',compact(['list','title']));
    }

    /**
     * Show the form for creating a new Officer Messages.
     */
    public function create()
    {
        $title="Add Officer Messages ";
        return view('admin/officers/add',compact(['title']));
    }

    /**
     * Store a newly created Officer Messages in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->search)){
            $officers_name=clean_single_input(trim($request->officers_name));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('officers_name', $officers_name);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/officers');
        }

        $txtuplode ='';
        $rules = array(
            'officers_name' => 'required',
            'designation' => 'required',
            //'contents' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            'txtuplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        );
        $valid
        =array(
             'txtuplode.required'=>'Image upload field  is required',
             //'contents.required'=>'Message field  is required',
             'txtstatus.required' =>'Status field is required'
            
        );
         $validator = Validator::make($request->all(), $rules,$valid);
        if ($validator->fails()) {
      
            return redirect('admin/officers/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/officers/')) {
                mkdir('public/upload/admin/cmsfiles/officers/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/officers/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/officers/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){

                $txtuplode = str_replace(' ','_',clean_single_input($request->officers_name)).'_banner'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/officers/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/officers/');
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles/officers/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles/officers/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['officers_name']    			= clean_single_input($request->officers_name); 
            $pArray['url']  						= Str::slug(clean_single_input($request->officers_name));
			$pArray['language']    					= clean_single_input($request->language); 
            $pArray['designation']    			    = clean_single_input($request->designation); 
            $pArray['contents']    					= $request->contents; //clean_single_input($request->contents); 
			$pArray['txtuplode']  				    = $txtuplode;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			
			$create 	= Officer::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
			

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->officers_name),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Officer Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/officers')->with('success','Officer has successfully added');
			}
           
        }
    }

    /**
     * Display the specified Officer Messages.
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
        $title="Edit Officer Messages ";
        $id=clean_single_input($id);
        $data = Officer::find($id);
        return view('admin/officers/edit',compact(['title','data']));
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
            'officers_name' => 'required',
            'designation' => 'required',
            // 'contents' => 'required',
            'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
           
            //  'contents.required'=>'Message field  is required',
             'txtstatus.required' =>'Status field is required'
            
        );
        if(!empty($request->txtuplode)){
            $rules = array(
                'txtuplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
                
            );
            $validator = Validator::make($request->all(), $rules);

        }else{
            $validator = Validator::make($request->all(), $rules ,$valid);
        }
        
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/officers/')) {
                mkdir('public/upload/admin/cmsfiles/officers/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/officers/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/officers/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){
                $txtuplode = str_replace(' ','_',clean_single_input($request->officers_name)).'_banner'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/officers/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/officers/');
              
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles/officers/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode1);
                }
                $thumbnail1 ='upload/admin/cmsfiles/officers/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['officers_name']    					 = clean_single_input($request->officers_name); 
            $pArray['url']  						         = Str::slug(clean_single_input($request->officers_name));
            $pArray['designation']    			             = clean_single_input($request->designation); 
            $pArray['contents']    					         = $request->contents;  //clean_single_input($request->contents); 
			$pArray['language']    					         = clean_single_input($request->language); 
			$pArray['txtuplode']  				             = !empty($txtuplode)?$txtuplode:$oldimg;
			$pArray['admin_id']  					         = $user_login_id;
			$pArray['txtstatus']  			                  = clean_single_input($request->txtstatus);

            $create 	= Officer::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->officers_name),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Officer Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/officers')->with('success','Officer has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified Officer Messages from storage.
     */
    public function destroy(Officer $officer)
    {
        $delete= $officer->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $officer->id,
                            'page_name'             =>  clean_single_input($officer->officers_name),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($officer->language),
                            'page_title'        	=> 'officer Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
             //            
            audit_trail($audit_data);
            return redirect('admin/officers')->with('success','Officer deleted successfully');
        }
       
    }
}
