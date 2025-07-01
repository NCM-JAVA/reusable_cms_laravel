<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\admin\PressRelease;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PressReleaseController extends Controller
{
    public function index()
    {
        // dd(session()->all());
        $list1 = PressRelease::all();
        $title="Press Release List";
        $sertitle=Session::get('title');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id')??1;

        $list = PressRelease::where('language', $language_id);

        if($sertitle){
            $list->where('title', 'like', '%' . $sertitle . '%');
        }

        if($approve_status){
            $list->where('txtstatus', $approve_status);
        }
        
        $list = $list->orderBy('created_at', 'DESC')->select('id','title','language','description','url','txtuplode','txtweblink','txtstatus','start_date','end_date')->paginate(10);
        
        return view('admin/pressRelease/index',compact(['list','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Press Release";
        return view('admin/pressRelease/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        
        if(isset($request->search)){
            $title=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('title', $title);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/press-release');
        }

        $txtuplode1 ='';
        $rules = array(
           'language' => 'required',
           //'title' => 'required',
		   'title' => 'required|regex:/^[\p{Devanagari}a-zA-Z0-9 ,()\'"\\/.&-]+$/u',
           'url' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
       );
       $validator = '';
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules);
       }elseif($request->menutype == 2){
          if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/pressRelease/')) {
                mkdir('public/upload/admin/cmsfiles/pressRelease/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
			   
			   $clean_title = str_replace([' / ',', ',' ,',' , ','. ',' .',' . ',' & ','(',')','/', ',', '.','&'], '', $request->title); 
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->clean_title)).'press_release'.'.'.$request->txtuplode->extension();  
               //$txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_press_release'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/pressRelease/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//pressRelease/'.$txtuplode1; //die();
                
                if (file_exists($txtuplode2)) {
                    unlink($txtuplode2);
                }
                 $validator = Validator::make($request->all(), $rulesdsad);
          }
       }elseif($request->menutype == 3){
           $rules = array(
               'txtweblink' => 'required'
           );
              
           $validator = Validator::make($request->all(), $rules);
       }
        $validator = Validator::make($request->all(), $rules);
       
       if ($validator->fails()) {
        return  back()->withErrors($validator)->withInput();
           
       }else{
           $user_login_id=Auth()->user()->id;
          
           $pArray['title']    				        = clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url));
           $pArray['page_url']                      = Str::slug(clean_single_input($request->url));
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
           $pArray['metadescription']				= clean_single_input($request->metadescription); 
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           $pArray['txtweblink']    				= clean_single_input($request->txtweblink); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['start_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->startdate)));
		   $pArray['end_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           
           $create 	= PressRelease::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                'page_id'           	=>  $lastInsertID,
                'page_name'             =>  clean_single_input($request->title),
                'page_action'           =>  'Insert',
                'page_category'         =>  clean_single_input($request->menutype),
                'lang'                  =>  clean_single_input($request->language),
                'page_title'        	=> 'Press release',
                'approve_status'        => clean_single_input($request->txtstatus),
                'usertype'          	=> 'Admin'
            );
                           
               audit_trail($audit_data);
               return redirect('admin/press-release')->with('success','Press release has successfully added');
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
        $title="Edit Press Release";
        $id=clean_single_input($id);
        $data = PressRelease::find($id);
        return view('admin/pressRelease/edit',compact(['title','data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=  clean_single_input($id);
       $txtuplode1 ='';
       $rules = array(
           'language' => 'required',
           //'title' => 'required',
		   'title' => 'required|regex:/^[\p{Devanagari}a-zA-Z0-9 ,()\'"\\/.&-]+$/u',
           'url' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
       );
       $validator = '';
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules);
       }elseif($request->menutype == 2){

           if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/pressRelease/')) {
                mkdir('public/upload/admin/cmsfiles/pressRelease/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
			   
			   $clean_title = str_replace([' / ',', ',' ,',' , ','. ',' .',' . ',' & ','(',')','/', ',', '.','&'], '', $request->title); 
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->clean_title)).'press_release'.'.'.$request->txtuplode->extension();  
               //$txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_press_release'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/pressRelease/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//pressRelease/'.$txtuplode1; //die();

                if (file_exists($txtuplode2)) {
                    unlink($txtuplode2);
                }
                 $validator = Validator::make($request->all(), $rulesdsad);
           }else{
            $txtuplode1 =$request->olduplode;
           }
       }elseif($request->menutype == 3){
        
           $rules = array(
               'txtweblink' => 'required'
           );
              
           $validator = Validator::make($request->all(), $rules);
       }
        $validator = Validator::make($request->all(), $rules);
       
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
          
         
           $pArray['title']    				= clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url));
           $pArray['page_url']                      = Str::slug(clean_single_input($request->url));
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           if($request->menutype == 1){
               $pArray['txtuplode']  				    = ''; 
               $pArray['txtweblink']    				= '';
               $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
               $pArray['metadescription']				= clean_single_input($request->metadescription); 
            }elseif($request->menutype == 2){
                $pArray['metakeyword']    			    = ''; 
                $pArray['metadescription']				= ''; 
                $pArray['txtweblink']    				= ''; 
                $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           }elseif($request->menutype == 3){
            $pArray['metakeyword']    			    = ''; 
            $pArray['metadescription']				= ''; 
            $pArray['txtuplode']    				= ''; 
            $pArray['txtweblink']  				    = clean_single_input($request->txtweblink); 
           }else{

           }
          
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['start_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->startdate)));
		   $pArray['end_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $user_login_id=Auth()->user()->id;

           $create 	= PressRelease::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Press release',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/press-release')->with('success','Press release has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PressRelease $pressRelease)
    {
        $delete= $pressRelease->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $pressRelease->id,
                            'page_name'             =>  clean_single_input($pressRelease->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($pressRelease->language),
                            'page_title'        	=> 'Press release',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/press-release')->with('success','Press release deleted successfully');
        }
       
       
    }
}
