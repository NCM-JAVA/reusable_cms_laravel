<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
{
    /**
     * Display a listing of the Module.
     */
    public function index(Request $request): View
    {
        $lists = Module::where('submenu_id',0);
        $module_name=Session::get('module_name');
        $approve_status=Session::get('approve_status');
       
        
            if (!empty($module_name)) {
              
                $lists->where('module_name',$module_name);
            }
            if (!empty($approve_status)) {
               
                $lists->where('module_status',$approve_status);
            }
           
        
        $list=$lists->orderby('created_at','DESC')->select('submenu_id','slug','id','module_name','mod_order_id','module_status','publish_id_module','icons','module_language_id','page_type','page_url')->paginate(10);
        $title="Module List";
        return view('admin/modules/index',compact(['list','title']));
    }

    /**
     * Show the form for creating a new Module.
     */
    public function create()
    {
        $title="Add Module";
        
        return view('admin/modules/add',compact(['title']));
    }

    /**
     * Store a newly created Module in storage.
     */
    public function store(Request $request) {
       
        if(isset($request->search)){
           $module_name=clean_single_input(trim($request->module_name));
            $approve_status=clean_single_input($request->approve_status);
            Session::put('module_name', $module_name);
            Session::put('approve_status', $approve_status);
            return redirect('admin/module');
          }
        if(isset($request->cmdsubmit)){  
        
            $rules = array(
                'module_name' => 'required|max:120',
                'page_url' => 'required|max:120',
                'language' => 'required',
                'mod_order_id' => 'required|unique:modules',
                'submenu_id' => 'required',
            //  'icons' => 'required',
                'txtstatus' => 'required'
            );
            $valid
            =array(
                 'txtstatus.required' =>'Status field is required'
                
            );
        
                $validator = Validator::make($request->all(), $rules,$valid);
            
            if ($validator->fails()) {
        
                return redirect('admin/module/create')->withErrors($validator)->withInput();
                
            }else{
                $user_login_id=Auth()->user()->id;
                $dataArr = array(); 
                $pArray['module_name']    					= clean_single_input($request->module_name); 
                $pArray['slug']  						     = clean_single_input($request->page_url);
                $pArray['page_url']  						= clean_single_input($request->page_url);//Str::slug(clean_single_input($request->page_url));//seo_url(clean_single_input($request->url));
                $pArray['module_language_id']    			= clean_single_input($request->language);
                $pArray['submenu_id']    				    = clean_single_input(!empty($request->submenu_id)?$request->submenu_id:0);
                $pArray['page_type']  					    = 'cms_page';
                $pArray['icons']  					        = $request->icons;
                $pArray['publish_id_module']  		        = clean_single_input($user_login_id);
                $pArray['module_status']  			        = clean_single_input($request->txtstatus);
                $pArray['mod_order_id']  		            = clean_single_input( $request->mod_order_id);
                
                
                $create 	= Module::create($pArray);
                $lastInsertID = $create->id;
                $user_login_id=Auth()->user()->id;

                if($lastInsertID > 0){
                    $audit_data = array('user_login_id'     =>  $user_login_id,
                                    'page_id'           	=>  $lastInsertID,
                                    'page_name'             =>  clean_single_input($request->module_name),
                                    'page_action'           =>  'Insert',
                                    'page_category'         =>  clean_single_input($request->submenu_id),
                                    'lang'                  =>  clean_single_input($request->language),
                                    'page_title'        	=> 'Module Model',
                                    'approve_status'        => clean_single_input($request->txtstatus),
                                    'usertype'          	=> 'Admin'
                                );
                                
                    audit_trail($audit_data);
                    return redirect('admin/module')->with('success','Module has successfully added');
                }
            
            }
           
             
        }
    }

    /**
     * Display the specified Module.
     */
    public function show(string $id)
    {
        $title="Child Module List";
        $whEre  = "";
        $list = Module::where('submenu_id',$id)->paginate(10);
         return view('admin/modules/index',compact(['list','title']));
    }

    /**
     * Show the form for editing the specified Module.
     */
    public function edit(string $id)
    {
        $title="Edit Module";
        $data = Module::find($id);
        return view('admin/modules/edit',compact(['title','data']));
    }

    /**
     * Update the specified Module in storage.
     */
    public function update(Request $request, string $id)
    {
        $id= clean_single_input($id);
        
        $rules = array(
            'module_name' => 'required|max:120',
            'page_url' => 'required|max:120',
            'language' => 'required',
            'mod_order_id' => 'required',
            'submenu_id' => 'required',
          //  'icons' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
             'txtstatus.required' =>'Status field is required'
            
        );
        $validator = Validator::make($request->all(), $rules,$valid);
        if ($validator->fails()) {
      
            return  back()->withErrors($validator)->withInput();
            
        }else{
            $user_login_id=Auth()->user()->id;
            $pArray['module_name']    					= clean_single_input($request->module_name); 
            $pArray['slug']  						    = clean_single_input($request->page_url);
			$pArray['page_url']  						= clean_single_input($request->page_url); //Str::slug(clean_single_input($request->page_url));//seo_url(clean_single_input($request->url));
			$pArray['module_language_id']    			= clean_single_input($request->language);
			$pArray['submenu_id']    				    = clean_single_input(!empty($request->submenu_id)?$request->submenu_id:0);
			$pArray['page_type']  					    = 'cms_page';
            $pArray['icons']  					        = $request->icons;
            $pArray['publish_id_module']  		        = clean_single_input($user_login_id);
			$pArray['module_status']  			        = clean_single_input($request->txtstatus);
			$pArray['mod_order_id']  		            = clean_single_input( $request->mod_order_id);
			
			$create 	= Module::where('id', $id)->update($pArray);
            $lastInsertID = $id;
            $user_login_id=Auth()->user()->id;

            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->module_name),
								'page_action'           =>  'Insert',
								'page_category'         =>  clean_single_input($request->submenu_id),
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Module Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/module')->with('success','Module has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified Module from storage.
     */
    public function destroy(Module $module)
    {
      
        $delete= $module->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $module->id,
                            'page_name'             =>  clean_single_input($module->module_name),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($module->module_language_id),
                            'page_title'        	=> 'module Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/module')->with('success','Module deleted successfully');
        }
  }
}
