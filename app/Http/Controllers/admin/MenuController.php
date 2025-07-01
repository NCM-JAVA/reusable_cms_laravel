<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the Menu.
     */
    public function index(Request $request): View
    {
        
            $title="Menu List";
            $approve_status=session()->get('approve_status');
            $sertitle=Session::get('Mtitle');
            $approve_status=Session::get('approve_status');
            $language_id=Session::get('language_id');
           
            if (!empty($sertitle)) {
                $lists = Menu::whereNotNull('m_title');
                $lists->where('m_title', 'LIKE', "%{$sertitle}%");
            }else{
                $lists = Menu::where('m_flag_id',0);
            }
            if (!empty($approve_status)) {
               
                $lists->where('approve_status',$approve_status);
            }
            if (!empty($language_id)) {
               
                $lists->where('language_id',$language_id);
            }
            $list=$lists->orderBy('page_postion', 'ASC')->paginate(10);
        return view('admin/menus/menu',compact(['list','title']));
    }

    /**
     * Show the form for creating a new Menu.
     */
    public function create()
    {
        $title="Add Menu";
        
        return view('admin/menus/add_menu',compact(['title']));
    }

    /**
     * Store a newly created Menu in storage.
     */
    public function store(Request $request): mixed {
        if(isset($request->search)){
            $Mtitle=clean_single_input(trim($request->title));
             $approve_status=clean_single_input($request->approve_status);
             $language_id=clean_single_input($request->language_id);
             Session::put('Mtitle', $Mtitle);
             Session::put('approve_status', $approve_status);
             Session::put('language_id', $language_id);
             return redirect('admin/menu');
           }
        if(isset($request->cmdsubmit)){  
         $txtuplode1 ='';
        $rules = array(
            'menu_title' => 'required',
            'url' => 'required',
            'language' => 'required',
            'menutype' => 'required',
            'txtpostion' => 'required',
            'txtstatus' => 'required',
            //'welcomedescription' => 'required'
        );
        $valid
        =array(
             'menutype.required'=>'Menu type field  is required',
             'txtpostion.required'=>'Content postion  field  is required',
             //'welcomedescription.required'=>'Welcome description  field  is required',
             'txtstatus.required' =>'Pages Status field is required'

        );
        $validator = '';
        if($request->menutype == 1){
            $rules = array(
                'description' => 'required',
                'metakeyword' => 'required|max:64',
                'metadescription' => 'required|max:250'
            );
             
            $validator = Validator::make($request->all(), $rules,$valid);
		}elseif($request->menutype == 2){
			if (!empty($request->txtuplode)){

                if (!is_dir('public/upload/admin/cmsfiles/menus/')) {
                    mkdir('public/upload/admin/cmsfiles/menus/', 0777, TRUE);
                }
                
                    $rulesdsad = array(
                        'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
                    );
                    $txtuplode1 = str_replace(' ','_',clean_single_input($request->menu_title)).'menu'.'.'.$request->txtuplode->extension();  
            
                    $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/menus/'), $txtuplode1);
                    
                    
                    if($res){
                        $txtuplode1 =$txtuplode1;
                    }
                    $txtuplode2 ='upload/admin/cmsfiles//menus/'.$txtuplode1; //die();
                    
                    if (file_exists($txtuplode2)) {
                        unlink($txtuplode2);
                    }
                        $validator = Validator::make($request->all(), $rulesdsad);
			}
		}elseif($request->menutype == 3){
            $rules = array(
                'txtweblink' => 'required|max:64'
            );
			   
            $validator = Validator::make($request->all(), $rules);
        }
            $validator = Validator::make($request->all(), $rules,$valid);
        
        if ($validator->fails()) {
      
            return redirect('admin/menu/create')->withErrors($validator)->withInput();
            
        }else{
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['m_name']    					= clean_single_input($request->menu_title); 
			$pArray['m_url']  						= Str::slug(clean_single_input($request->url));
			$pArray['language_id']    			    = clean_single_input($request->language);
			$pArray['m_flag_id']    				= clean_single_input(!empty($request->menucategory)?$request->menucategory:0);
			$pArray['m_type']  						= clean_single_input($request->menutype);
			$pArray['m_title']  					= clean_single_input($request->menu_title);
			$pArray['m_keyword']    				= clean_single_input($request->metakeyword);
			//$pArray['welcomedescription']  	        = clean_single_input($request->welcomedescription);
			$pArray['m_description']				= clean_single_input($request->metadescription);
			$pArray['content']    					= $request->description; //clean_single_input($request->description);
			$pArray['doc_uplode']  				    = clean_single_input($txtuplode1);
			$pArray['linkstatus']    				= clean_single_input($request->txtweblink);
			$pArray['admin_id']  					= clean_single_input($user_login_id);
			$pArray['approve_status']  			    = clean_single_input($request->txtstatus);
			$pArray['menu_positions']  		        =clean_single_input( $request->txtpostion);
			$pArray['current_version']  			= 0;
			
			$create 	= Menu::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Insert',
								'page_category'         =>  clean_single_input($request->menutype),
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> clean_single_input($request->menu_title),
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/menu')->with('success','Menu has successfully added');
			}
           
        }
    }
      
    }

    /**
     * Display the specified Menu.
     */
    public function show(string $id)
    {
        $title="Child Menu List";
        $whEre  = "";
        $id=clean_single_input($id);
        $list = Menu::where('m_flag_id',$id)->paginate(10);
         return view('admin/menus/menu',compact(['list','title','id']));
    }

    /**
     * Show the form for editing the specified Menu.
     */
    public function edit(string $id)
    {
        $id=clean_single_input($id);
        $title="Edit Menu";
        $data = Menu::find($id);
        return view('admin/menus/edit_menu',compact(['title','data']));
    }

    /**
     * Update the specified Menu in storage.
     */
    public function update(Request $request, string $id)
    {
        $id= clean_single_input($id);
        $txtuplode1 ='';
        $rules = array(
            'menu_title' => 'required',
            'url' => 'required',
            'language' => 'required',
            'menutype' => 'required',
            'txtpostion' => 'required',
            'txtstatus' => 'required',
            //'welcomedescription' => 'required'
        );
        $valid
        =array(
             'menutype.required'=>'Menu type field  is required',
             'txtpostion.required'=>'Content postion  field  is required',
             //'welcomedescription.required'=>'Welcome description  field  is required',
             'txtstatus.required' =>'Pages Status field is required'

        );
        $validator = '';
        if($request->menutype == 1){
            $rules = array(
                'description' => 'required',
                'metakeyword' => 'required|max:155',
                'metadescription' => 'required|max:250'
            );
             
            $validator = Validator::make($request->all(), $rules);
		}elseif($request->menutype == 2){
			if (!empty($request->txtuplode)){

                if (!is_dir('public/upload/admin/cmsfiles/menus/')) {
                    mkdir('public/upload/admin/cmsfiles/menus/', 0777, TRUE);
                }
                
                   $rulesdsad = array(
                       'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
                   );
                   $txtuplode1 = str_replace(' ','_',clean_single_input($request->menu_title)).'menu'.'.'.$request->txtuplode->extension();  
           
                    $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/menus/'), $txtuplode1);
                  
                   
                    if($res){
                       $txtuplode1 =$txtuplode1;
                    }
                    $txtuplode2 ='upload/admin/cmsfiles//menus/'.$txtuplode1; //die();
                    
                    if (file_exists($txtuplode2)) {
                        unlink($txtuplode2);
                    }
                     $validator = Validator::make($request->all(), $rulesdsad);
			}else{
                $txtuplode1 =$request->olduplode;
            }
		}elseif($request->menutype == 3){
            $rules = array(
                'txtweblink' => 'required|max:64'
            );
			   
            $validator = Validator::make($request->all(), $rules);
        }
            $validator = Validator::make($request->all(), $rules, $valid);
        
        if ($validator->fails()) {
      
            return  back()->withErrors($validator)->withInput();
            
        }else{
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
          
			$pArray['m_name']    					= clean_single_input($request->menu_title); 
			$pArray['m_url']  						= Str::slug(clean_single_input($request->url));
			$pArray['language_id']    			    = clean_single_input($request->language);
			$pArray['m_flag_id']    				= clean_single_input($request->menucategory);
			$pArray['m_type']  						= clean_single_input($request->menutype);
			$pArray['m_title']  					= clean_single_input($request->menu_title);
			//$pArray['welcomedescription']  	        = clean_single_input($request->welcomedescription);


            if($request->menutype == 1){
                $pArray['doc_uplode']  				    = ''; 
                $pArray['linkstatus']    				= '';
                $pArray['content']    			        = $request->description; 
                $pArray['m_keyword']    			    = clean_single_input($request->metakeyword); 
                $pArray['m_description']				= clean_single_input($request->metadescription); 
             }elseif($request->menutype == 2){
                 $pArray['m_keyword']    			    = ''; 
                 $pArray['m_description']				= ''; 
                 $pArray['linkstatus']    				= ''; 
                 $pArray['content']    			        = '';
                 $pArray['doc_uplode']  				= clean_single_input($txtuplode1); 
                 
            }elseif($request->menutype == 3){
             $pArray['m_keyword']    			    = ''; 
             $pArray['m_description']				= ''; 
             $pArray['doc_uplode']    				= ''; 
             $pArray['content']    			        = '';
             $pArray['linkstatus']  				    = clean_single_input($request->txtweblink); 
            }else{
 
            }
			$pArray['admin_id']  					= $user_login_id;
			$pArray['approve_status']  			    = clean_single_input($request->txtstatus);
			$pArray['menu_positions']  		        = clean_single_input($request->txtpostion);
			$pArray['current_version']  			= 0;
			//dd($pArray);
			$create 	= Menu::where('id', $id)->update($pArray);
            $lastInsertID = $id;
            $user_login_id=Auth()->user()->id;

            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Update',
								'page_category'         =>  clean_single_input($request->menutype),
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> clean_single_input($request->menu_title),
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/menu')->with('success','Menu has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified Menu from storage.
     */
    public function destroy(Menu $menu)
    {
       
        $delete= $menu->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $menu->id,
                            'page_name'             =>  clean_single_input($menu->m_name),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($menu->language_id),
                            'page_title'        	=> clean_single_input($menu->menu_title),
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/menu')->with('success','Menu deleted successfully');
        }
        
    }
   
}
