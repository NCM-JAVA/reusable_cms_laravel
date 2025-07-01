<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\WebsiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Session;
use Illuminate\Support\Str;
use DB;
class WebsiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Common Setting";
        $user_login_id=Auth()->user()->id;
        $websiteSetting=WebsiteSetting::paginate(100);
       
        return view('admin/setting/index',compact(['title','websiteSetting']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $title="Common Setting";
        return view('admin/setting/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage. language
     */
    public function store(Request $request)
    {  
         $rules = array(
            'website_name' => 'required',
            'language' => 'required',
            'website_short_name' => 'required',
            'website_tags_name' => 'required'
        );
       
        if(empty($request->oldLogo)){
            $rules =['logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'];
            $validator = Validator::make($request->all(), $rules);
        }
        if(empty($request->oldfav)){
            $rules =['favicon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512'];
            $validator = Validator::make($request->all(), $rules);
        }
        //$rules=array_merge($rules);
      
        $validator = Validator::make($request->all(), $rules);

      
       if ($validator->fails()) {
          
            return redirect('admin/setting')->withErrors($validator);
            
        } else {

           if(empty($request->logo)){

                if(!empty($request->oldLogo)){
                    $logo = $request->oldLogo;
                }
                 
           }else{
                if(!empty($request->logo)){
                    $logo = 'logo'.'.'.$request->logo->extension();  
                    $request->logo->move(public_path('upload/admin/setting/'), $logo);
                }
                
           }
            if(empty($request->favicon)){

                if(!empty($request->oldfav)){
                    $favicon = $request->oldfav;
                  
                }
                
                   
            }else{
                if(!empty($request->favicon)){
                    $favicon = 'favicon'.'.'.$request->favicon->extension();  
                    $request->favicon->move(public_path('upload/admin/setting/'), $favicon);
                }
               
            }
             
          
            $website_name = $request->website_name;  
            $language = $request->language; 
            $themes = $request->themes; 
            $website_short_name = $request->website_short_name;  
            $website_tags_name = $request->website_tags_name;  
            
            $logo1 ='upload/admin/setting/'.$logo; //die();
				
            if (file_exists($logo1)) {
                unlink($logo);
            }
            $favicon1 ='upload/admin/setting/'.$favicon; //die();
				
            if (file_exists($favicon1)) {
                unlink($favicon);
            }
           
            
            $user_login_id=Auth()->user()->id;
           
            
                $create = WebsiteSetting::create([
                    'logo' => "$logo",
                    'favicon' =>   "$favicon",
                    'user_login_id' =>   "$user_login_id",
                    'language' =>   "$language",
                    'themes' =>   "$themes",
                    'website_name' =>   "$website_name",
                    'website_short_name' =>   "$website_short_name",
                    'website_tags_name' =>   "$website_tags_name"
                ]);
                $lastInsertID = $create->id;
            
            if($lastInsertID > 0){
                $user_login_id=Auth()->user()->id;
				$audit_data = array('user_login_id'     => $user_login_id,
								'page_id'           	=> $lastInsertID,
								'page_name'             => $website_name,
								'page_action'           => 'Insert',
								'page_category'         => "Setting",
								'lang'              	=> '1',
								'page_title'        	=> 'Setting',
								'approve_status'        => '1',
								'usertype'          	=> "Admin"
							);
							
				audit_trail($audit_data);
				
			}
           
            return redirect('admin/setting')->with('success','Common setting successfully done');
          
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
        $title="Edit Common Setting";
    
        $websiteSetting=WebsiteSetting::find($id);
       
        return view('admin/setting/edit',compact(['title','websiteSetting']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $rules = array(
            'website_name' => 'required',
            'language' => 'required',
            'website_short_name' => 'required',
            'website_tags_name' => 'required'
        );
       
        if(empty($request->oldLogo)){
            $rules =['logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'];
        }
        if(empty($request->oldfav)){
            $rules =['favicon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512'];
        }
        $rules=array_merge($rules);
      
        $validator = Validator::make($request->all(), $rules);

      
       if ($validator->fails()) {
          
            return redirect('admin/setting')->withErrors($validator);
            
        } else {
         //dd($request);
           if(empty($request->logo)){

                if(!empty($request->oldLogo)){
                    $logo = $request->oldLogo;
                }
                 
           }else{
                if(!empty($request->logo)){
                    $logo = 'logo'.'.'.$request->logo->extension();  
                    $request->logo->move(public_path('upload/admin/setting/'), $logo);
                }
                
           }
            if(empty($request->favicon)){

                if(!empty($request->oldfav)){
                    $favicon = $request->oldfav;
                  
                }
                
                   
            }else{
                if(!empty($request->favicon)){
                    $favicon = 'favicon'.'.'.$request->favicon->extension();  
                    $request->favicon->move(public_path('upload/admin/setting/'), $favicon);
                }
               
            }
             
          
            $website_name = $request->website_name;  
            $language = $request->language; 
            $themes = $request->themes; 
            $website_short_name = $request->website_short_name;  
            $website_tags_name = $request->website_tags_name;  
            
            $logo1 ='upload/admin/setting/'.$logo; //die();
				
            if (file_exists($logo1)) {
                unlink($logo);
            }
            $favicon1 ='upload/admin/setting/'.$favicon; //die();
				
            if (file_exists($favicon1)) {
                unlink($favicon);
            }
           
            
            $user_login_id=Auth()->user()->id;
           
            
           
                $create =   WebsiteSetting::where('id', $id)->update([
                    'logo' => "$logo",
                    'favicon' =>   "$favicon",
                    'user_login_id' =>   "$user_login_id",
                    'language' =>   "$language",
                    'themes' =>   "$themes",
                    'website_name' =>   "$website_name",
                    'website_short_name' =>   "$website_short_name",
                    'website_tags_name' =>   "$website_tags_name"
                ]);
            
            if($create > 0){
                $user_login_id=Auth()->user()->id;
				$audit_data = array('user_login_id'     => $user_login_id,
								'page_id'           	=> $id,
								'page_name'             => $website_name,
								'page_action'           => 'Update',
								'page_category'         => "Setting",
								'lang'              	=> '1',
								'page_title'        	=> 'Setting',
								'approve_status'        => '1',
								'usertype'          	=> "Admin"
							);
							
				audit_trail($audit_data);
				
			}
           
            return redirect('admin/setting')->with('success','Common setting successfully done');
          
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
       
        $WebsiteSetting = WebsiteSetting::find($id);
        $delete= $WebsiteSetting->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     => $user_login_id,
                            'page_id'           	=> $WebsiteSetting->id,
                            'page_name'             => $WebsiteSetting->website_name,
                            'page_action'           => 'Reset',
                            'page_category'         => "Setting",
                            'lang'              	=> '1',
                            'page_title'        	=> 'Setting',
                            'approve_status'        => '1',
                            'usertype'          	=> "Admin"
                        );
                        
            audit_trail($audit_data);
            
        }
        return redirect('admin/setting')->with('success','Setting Reset successfully');
    }
}
