<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\MinistersInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MinistersInfoController extends Controller
{
    public function index(){
        $title="Ministers List";
        $sername=Session::get('name');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id')??1;
        $minister_catg=Session::get('minister_catg');

        $list = MinistersInfo::where('language', $language_id);
        if($sername){
            $list->where('name', 'like', '%' . $sername . '%');
        }
        if($approve_status){
            $list->where('txtstatus', $approve_status);
        }
        if($minister_catg){
            $list->where('ministers_type', $minister_catg);
        }
		
		$list = $list->orderBy('ministers_type', 'ASC')->orderByRaw('CASE 
        WHEN info_position IS NULL THEN 1 
        WHEN info_position = 0 THEN 1 
        ELSE 0 
        END ASC')->orderBy('info_position', 'ASC')->paginate(10);
        
        //$list = $list->orderBy('created_at', 'DESC')->paginate(10);

        // $list = MinistersInfo::paginate(10);
        return view('admin/ministersInfo/index',compact(['list','title']));
    }

    public function create()
    {
        $title="Add Minister's Information";
        return view('admin/ministersInfo/add',compact(['title']));
    }

    public function store(Request $request){

        if(isset($request->search)){
            $name=clean_single_input(trim($request->name));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            $category = clean_single_input($request->minister_catg);
            Session::put('name', $name);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            Session::put('minister_catg', $category);
            return redirect('admin/ministers-info');
        }

        $rules = array(
            'ministers_type' => 'required',
            'name' => 'required',
            // 'email' => 'nullable|email',
            // 'room_no' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            'flag_id' => 'required'
        );
        $valid =array(
             'txtstatus.required' =>'Status field is required',
             'flag_id.required' => 'Text style field is required'
        );

        $validator = Validator::make($request->all(), $rules,$valid);
        if ($validator->fails()) {
            return redirect('admin/ministers-info/create')->withErrors($validator)->withInput();
        }else{
            
            $user_login_id=Auth()->user()->id;
            $pArray['ministers_type']    			= clean_single_input($request->ministers_type); 
            $pArray['name']    			            = $request->name; 
            $pArray['room_no']  				    = $request->room_no;
            $pArray['office_no']  				    = $request->office_no;
            $pArray['intercom']  				    = $request->intercom;
            $pArray['residence_no']  				= $request->residence_no;
            $pArray['email']  				        = $request->email;
			$pArray['language']    					= clean_single_input($request->language); 
            $pArray['designation']    			    = $request->designation; 
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
            $pArray['flag_id']  			        = clean_single_input($request->flag_id);
			
			
			$create 	= MinistersInfo::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
			

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->name),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> "Who's Who",
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/ministers-info')->with('success','Minister info type has successfully added');
			}
           
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $title="Edit Minister Info";
        $id=clean_single_input($id);
        $data = MinistersInfo::find($id);
        return view('admin/ministersInfo/edit',compact(['title','data']));
    }

    public function update(Request $request, string $id)
    {
        $id=clean_single_input($id);
        $rules = array(
            'ministers_type' => 'required',
            'name' => 'required',
            // 'email' => 'nullable|email',
            // 'room_no' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            'flag_id' => 'required'
        );
        $valid =array(
             'txtstatus.required' =>'Status field is required',
             'flag_id.required' => 'Text style field is required'
        );
            
        $validator = Validator::make($request->all(), $rules,$valid);
        if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
        }else{
            
            $user_login_id=Auth()->user()->id;
            $pArray['ministers_type']    			= clean_single_input($request->ministers_type); 
            $pArray['name']    			            = $request->name; 
            $pArray['room_no']  				    = $request->room_no;
            $pArray['office_no']  				    = $request->office_no;
            $pArray['intercom']  				    = $request->intercom;
            $pArray['residence_no']  				= $request->residence_no;
            $pArray['email']  				        = $request->email;
			$pArray['language']    					= clean_single_input($request->language); 
            $pArray['designation']    			    = $request->designation; 
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
            $pArray['flag_id']  			        = clean_single_input($request->flag_id);

            $create = MinistersInfo::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->name),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> "Who's Who",
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/ministers-info')->with('success','Minister info type has successfully Updated');
			}
           
        }
    }

    public function destroy(MinistersInfo $ministersinfo, $id)
    {
        $data = MinistersInfo::find($id);
        $delete= $data->delete();
        // $delete= $ministersinfo->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $data->id,
                            'page_name'             =>  clean_single_input($data->name),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> "Who's Who",
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                         
            audit_trail($audit_data);
            return redirect('admin/ministers-info')->with('success','Minister info type deleted successfully');
        }
       
    }
}
