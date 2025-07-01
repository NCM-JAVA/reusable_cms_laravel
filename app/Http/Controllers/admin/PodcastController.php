<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Podcast;
use Illuminate\Support\Facades\Session;

class PodcastController extends Controller
{
    public function index(){
        $title = 'Podcast List';
        $approve_status=session()->get('approve_status');
        $sertitle=Session::get('title');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id');
        $lists = Podcast::whereNotNull('txtuplode');
        if (!empty($title)) {
            $lists->where('title', 'LIKE', "%{$sertitle}%");
        }
        if (!empty($approve_status)) {
        
            $lists->where('txtstatus',$approve_status);
        }
        if (!empty($language_id)) {
        
            $lists->where('language',$language_id);
        }

        $lists = $lists->orderBy('id', 'DESC')->paginate(10);

        return view('admin/podcast/index', compact(['title', 'lists']));
    }

    public function create(){
        $title = 'Add Podcast';
        return view('admin/podcast/add', compact(['title']));
    }

    public function store(Request $request){
        if(isset($request->search)){

            $title=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('title', $title);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/podcast');
        }

        if(isset($request->cmdsubmit)){  
            $txtuplode ='';
            $rules = array(
                'title' => 'required',
                'language' => 'required',
                'txtstatus' => 'required',
                'txtuplode' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'
            );
            $valid
            =array(
                'title.required'=>'Title field  is required',
                'txtuplode.required'=>'Audio upload field is required',
                'txtstatus.required' =>'status field is required'

            );
            $validator = Validator::make($request->all(), $rules, $valid);
            if ($validator->fails()) {
                return redirect('admin/podcast/create')->withErrors($validator)->withInput();
            } else{

                if (!is_dir('public/upload/admin/cmsfiles/podcast/')) {
                    mkdir('public/upload/admin/cmsfiles/podcast/', 0777, TRUE);
                }
                if(!empty($request->txtuplode)){
    
                    $txtuplode = str_replace(' ','_',clean_single_input($request->title)).'_podcast'.'.'.$request->txtuplode->extension();  
                    $audio = $request->file('txtuplode');
                 
                    $destinationPath = public_path('upload/admin/cmsfiles/podcast/');
                    $audio->move($destinationPath, $txtuplode);
    
                    $txtuplode1 ='upload/admin/cmsfiles//podcast/'.$txtuplode;
                    
                    if (file_exists($txtuplode1)) {
                        unlink($txtuplode);
                    }
                    
                    $user_login_id=Auth()->user()->id;
                    $dataArr = array(); 
                    $pArray['title']    					= clean_single_input($request->title); 
                    $pArray['description']    				= $request->description; 
                    $pArray['language']    					= clean_single_input($request->language); 
                    $pArray['txtuplode']  				    = $txtuplode;
                    $pArray['admin_id']  					= $user_login_id;
                    $pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
                    
                    $create = Podcast::create($pArray);
                    $lastInsertID = $create->id;
                    $usertype=Auth()->user()->designation;

                    if($lastInsertID > 0){
                        $audit_data = array('user_login_id'     =>  $user_login_id,
                                        'page_id'           	=>  $lastInsertID,
                                        'page_name'             =>  clean_single_input($request->title),
                                        'page_action'           =>  'Insert',
                                        'page_category'         =>  '',
                                        'lang'                  =>  clean_single_input($request->language),
                                        'page_title'        	=> 'Rap Songs',
                                        'approve_status'        => clean_single_input($request->txtstatus),
                                        'usertype'          	=> $usertype??'Admin'
                                    );
                                    
                        audit_trail($audit_data);
                        return redirect('admin/podcast')->with('success', 'Podcast added successfully');
                    }
                }

            }
        }
    }

    public function show(){
        //
    }

    public function edit($id){
        $title="Edit Podcast ";
        $id=clean_single_input($id);
        $data = Podcast::find($id);
        return view('admin/podcast/edit',compact(['title','data']));
    }

    public function update(Request $request, $id){
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            // 'txtuplode' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'
        );
        $valid
        =array(
            'title.required'=>'Title field  is required',
            // 'txtuplode.required'=>'Audio upload field is required',
            'txtstatus.required' =>'status field is required'
        );
        $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
            return redirect('admin/podcast')->withErrors($validator)->withInput();
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/podcast/')) {
                mkdir('public/upload/admin/cmsfiles/podcast/', 0777, TRUE);
            }

            if(!empty($request->txtuplode)){
                $txtuplode = str_replace(' ','_',clean_single_input($request->title)).'_podcast'.'.'.$request->txtuplode->extension();  
                $audio = $request->file('txtuplode');
             
                $destinationPath = public_path('upload/admin/cmsfiles/podcast/');
              
                $audio->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//podcast/'.$txtuplode; //die();
                
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode1);
                }
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']                        = clean_single_input($request->title); 
            $pArray['description']                  = clean_single_input($request->description); 
            $pArray['language']    					= clean_single_input($request->language); 
            $pArray['txtuplode']                    = !empty($txtuplode)?$txtuplode:$oldimg;
            $pArray['admin_id']                     = $user_login_id;
            $pArray['txtstatus']                    = clean_single_input($request->txtstatus);

            $create = Podcast::where('id', $id)->update($pArray);
            if($create > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                                'page_id'               =>  $id,
                                'page_name'             =>  clean_single_input($request->title),
                                'page_action'           =>  'Update',
                                'page_category'         =>  '',
                                'lang'                  =>  1,
                                'page_title'            => 'Rap Songs',
                                'approve_status'        => clean_single_input($request->txtstatus),
                                'usertype'              => 'Admin'
                            );
                            
                audit_trail($audit_data);
                return redirect('admin/podcast')->with('success','Podcast has successfully Updated');
            }
           
        }
    }

    public function destroy($id){
        $data = Podcast::find($id);
        $podcast_data = $data->delete();

        if($podcast_data > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $id,
                            'page_name'             =>  clean_single_input($data->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> 'Rap Songs',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/podcast')->with('success','Podcast deleted successfully');
        }
    }
}