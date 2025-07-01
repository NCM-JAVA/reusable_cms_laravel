<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Photogallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $title="Photogallery List";
        
		 $list = Photogallery::paginate(10);
         return view('admin/gallery/index',compact(['list','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Gallery ";
        return view('admin/gallery/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imguplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            'imguplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        );
        $valid
        =array(
            'menu_title.required'=>'Title field  is required',
             'txtstatus.required' =>'Status field is required',
             'imguplode.required' => 'Image field is required'

        );
        $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('admin/gallery/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/photos/')) {
                mkdir('public/upload/admin/cmsfiles/photos/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/photos/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/photos/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->imguplode)){

                $imguplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_gallery'.'.'.$request->imguplode->extension();  
                $image = $request->file('imguplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/photos/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$imguplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/photos/');
                $image->move($destinationPath, $imguplode);

                $imguplode1 ='upload/admin/cmsfiles//photos/'.$imguplode; //die();
				
                if (file_exists($imguplode1)) {
                    unlink($imguplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles//photos/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = $imguplode;
			$pArray['category_id']  				= 1;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			//dd($pArray);
			$create 	= Photogallery::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Gallery Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/gallery')->with('success','Gallery has successfully added Thank you');
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
        $title="Edit Photogallery ";
        $id=clean_single_input($id);
        $data = photogallery::find($id);
        return view('admin/gallery/edit',compact(['title','data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $imguplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
             'menu_title.required'=>'Title field  is required',
             'txtstatus.required' =>'Status field is required'
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
            if (!is_dir('public/upload/admin/cmsfiles/photos/')) {
                mkdir('public/upload/admin/cmsfiles/photos/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/photos/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/photos/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){

                $imguplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_gallery'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/photos/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$imguplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/photos/');
                $image->move($destinationPath, $imguplode);

                $imguplode1 ='upload/admin/cmsfiles/photos/'.$imguplode; //die();
				
                if (file_exists($imguplode1)) {
                    unlink($imguplode1);
                }
                $thumbnail1 ='upload/admin/cmsfiles/photos/'.$imguplode; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($thumbnail1);
                }
           
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = !empty($imguplode)?$imguplode:$oldimg;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
           // dd($pArray);
            $create 	= photogallery::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  '',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Banner Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/gallery')->with('success','Gallery has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photogallery $photogallery,$id)
    {
		$photogallerys = photogallery::find($id);
        $photogallerys= $photogallerys->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $photogallerys->id,
                            'page_name'             =>  clean_single_input($photogallerys->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($photogallerys->language),
                            'page_title'        	=> 'photogallerys Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/gallery')->with('success','Gallery deleted successfully');
        }
       
      }
}
