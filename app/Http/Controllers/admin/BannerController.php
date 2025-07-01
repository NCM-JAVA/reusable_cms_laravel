<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
   
    /**
     * Display a listing of the Banner list 30-10-23 by pushpendra.
     */
  
    public function index()
    {
            
         $title="Banner List";
         $approve_status=session()->get('approve_status');
         $sertitle=Session::get('title');
         $approve_status=Session::get('approve_status');
         $txttype=Session::get('txttype');
         $language_id=Session::get('language_id');
         $lists = Banner::whereNotNull('txtuplode');
         if (!empty($title)) {
             $lists->where('title', 'LIKE', "%{$sertitle}%");
         }
         if (!empty($approve_status)) {
            
             $lists->where('txtstatus',$approve_status);
         }
         if (!empty($txttype)) {
            //dd($txttype);
            $lists->where('txttype',$txttype);
        }
         if (!empty($language_id)) {
            
             $lists->where('language',$language_id);
         }
         $list = $lists->orderBy('created_at', 'DESC')->paginate(10);

         return view('admin/banners/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new Banner.
     */
    public function create()
    {
        $title="Add Banner ";
        return view('admin/banners/add',compact(['title']));
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->search)){
            $title=clean_single_input(trim($request->title));
             $approve_status=clean_single_input($request->approve_status);
             $txttype=clean_single_input($request->txttype);
             $language_id=clean_single_input($request->language_id);
             Session::put('title', $title);
             Session::put('approve_status', $approve_status);
             Session::put('txttype', $txttype);
             Session::put('language_id', $language_id);
             return redirect('admin/banner');
           }
        if(isset($request->cmdsubmit)){  
        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txttype' => 'required',
            'txtstatus' => 'required',
            'txtuplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        );
        $valid
        =array(
            'menu_title.required'=>'Menu title field  is required',
            //'banner_link.required'=>'Image upload field is required',
            'txtuplode.required'=>'Image upload field is required',
            'txtstatus.required' =>'status field is required'

        );
         $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('admin/banner/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/banner/')) {
                mkdir('public/upload/admin/cmsfiles/banner/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/banner/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/banner/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){

                $txtuplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_banner'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/banner/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/banner/');
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//banner/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles//banner/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['banner_link']    				= $request->banner_link;
            $pArray['language']    					= clean_single_input($request->language); 
            $pArray['txttype']    					= $request->txttype; 
			$pArray['txtuplode']  				    = $txtuplode;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			
			$create 	= Banner::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Banner Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);

                if($request->txttype == 1){
                    return redirect('admin/banner')->with('success','Banner has successfully added');
                } else{
                    return redirect('admin/banner')->with('success','Poster has successfully added');
                }
                
			}
           
        }
      }
   }

    /**
     * Display the specified banner.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(string $id)
    {
        $title="Edit Banner ";
        $id=clean_single_input($id);
        $data = Banner::find($id);
        return view('admin/banners/edit',compact(['title','data']));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'txttype' => 'required',
            'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
            'menu_title.required'=>'Menu title field  is required',
             'txtstatus.required' =>'status field is required'

        );
        if(!empty($request->txtuplode)){
            $rules = array(
                'txtuplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                
            );
            $validator = Validator::make($request->all(), $rules);

        }else{
            $validator = Validator::make($request->all(), $rules, $valid);
        }
        
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/banner/')) {
                mkdir('public/upload/admin/cmsfiles/banner/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/banner/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/banner/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){
                $txtuplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_banner'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/banner/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/banner/');
              
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//banner/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode1);
                }
                $thumbnail1 ='upload/admin/cmsfiles//banner/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['banner_link']    				= $request->banner_link;
            $pArray['txttype']    					= $request->txttype; 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = !empty($txtuplode)?$txtuplode:$oldimg;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);

            $create 	= Banner::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Banner Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);

                if($request->txttype == 1){
                    return redirect('admin/banner')->with('success','Banner has successfully Updated');
                }else{
                    return redirect('admin/banner')->with('success','Poster has successfully Updated');
                }
                
			}
           
        }
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Banner $banner)
    {

        $delete = $banner->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $banner->id,
                            'page_name'             =>  clean_single_input($banner->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($banner->language),
                            'page_title'        	=> 'Banner Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/banner')->with('success','Banner deleted successfully');
         }
       
        
    }
}
