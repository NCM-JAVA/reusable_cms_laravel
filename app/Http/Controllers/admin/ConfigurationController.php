<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigurationController extends Controller
{
    
    public function index()
    {
        $title="Configurations";
        $langid=!empty($langid)?$langid:1;
        $list = Configuration::orderBy('created_at', 'DESC')->select('*')->paginate(100);
        return view('admin/configuration/index',compact(['list','title']));
    }
    public function create()
    {
        $title="Configurations";
        return view('admin/configuration/add',compact(['title']));
    }

    public function store(Request $request){
        
       $rules = array(
           'language'       => 'required',
           'cof_type'       => 'required',
           'sender_name'    => 'required',
           'sender_mail'    => 'required',
           'password'       => 'required',
           'port'           => 'required',
           'contact_msg'    => 'required',
           'reset_pass_msg' => 'required',
           'reg_msg'        => 'required',
           'feedback_msg'   => 'required',
           'status'         => 'required'
       );
       
          
    $validator = Validator::make($request->all(), $rules);
     
       if ($validator->fails()) {
        return  back()->withErrors($validator)->withInput();
           
       }else{
           $user_login_id=Auth()->user()->id;
          
        $pArray['language']    			    	= clean_single_input($request->language); 
        $pArray['cof_type']    			    	= clean_single_input($request->cof_type);
        $pArray['sms_url']    			     	= clean_single_input($request->sms_url);
        $pArray['sender_name']    				= clean_single_input($request->sender_name);
        $pArray['sender_mail']    				= clean_single_input($request->sender_mail);
        $pArray['password']                     = clean_single_input($request->password);
        $pArray['port']    			            = clean_single_input($request->port); 
        $pArray['contact_msg']  				= clean_single_input($request->contact_msg);  
        $pArray['reset_pass_msg']    			= clean_single_input($request->reset_pass_msg); 
        $pArray['reg_msg']				        = clean_single_input($request->reg_msg); 
        $pArray['feedback_msg']    				= clean_single_input($request->feedback_msg); 
        $pArray['status']  				        = clean_single_input($request->status); 
           
    
           $create 	= Configuration::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'           	=>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->sender_name),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->cof_type),
            'page_title'        	=> 'Configuration Module',
            'approve_status'        => clean_single_input($request->status),
            'usertype'          	=> 'Admin'
        );
                           
               audit_trail($audit_data);
               return redirect('admin/configuration')->with('success','Configurations has successfully added');
           }
          
       }
    }
    public function edit(string $id)
    {
        $title="Edit Configurations";              
        $id=clean_single_input($id);
        $data = Configuration::find($id);
        return view('admin/configuration/edit',compact(['title','data']));
    }
        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=  clean_single_input($id);
       
        $rules = array(
            'language' => 'required',
           'cof_type' =>  'required',
           'sender_name' => 'required',
           'sender_mail' => 'required',
           'password' => 'required',
           'port' => 'required',
           'contact_msg' => 'required',
           'reset_pass_msg' => 'required',
           'reg_msg' => 'required',
           'feedback_msg' => 'required',
           'status' => 'required'
       );

       
       
          
    $validator = Validator::make($request->all(), $rules);
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
           $pArray['language']    				= clean_single_input($request->language); 
           $pArray['cof_type']    				= clean_single_input($request->cof_type);
           $pArray['sms_url']    				= clean_single_input($request->sms_url);
           $pArray['sender_name']    				= clean_single_input($request->sender_name);
           $pArray['sender_mail']    				= clean_single_input($request->sender_mail);
           $pArray['password']                      = clean_single_input($request->password);
           $pArray['port']    			            = clean_single_input($request->port); 
           $pArray['contact_msg']  					= clean_single_input($request->contact_msg);  
           $pArray['reset_pass_msg']    			= clean_single_input($request->reset_pass_msg); 
           $pArray['reg_msg']				        = clean_single_input($request->reg_msg); 
           $pArray['feedback_msg']    				= clean_single_input($request->feedback_msg); 
           $pArray['status']  				        = clean_single_input($request->status); 
          
           $create 	= Configuration::where('id', $id)->update($pArray);
           if($create > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                'page_id'           	=>  $id,
                'page_name'             =>  clean_single_input($request->sender_name),
                'page_action'           =>  'update',
                'page_category'         =>  clean_single_input($request->cof_type),
                'page_title'        	=> 'Configuration Module',
                'approve_status'        => clean_single_input($request->status),
                'usertype'          	=> 'Admin'
            );
                           
               audit_trail($audit_data);
               return redirect('admin/configuration')->with('success','Configurations has successfully Updated');
        }
          
       }
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(Configuration $configuration)
     {
         $delete= $configuration->delete();
         if($delete > 0){
             $user_login_id=Auth()->user()->id;
             $audit_data = array('user_login_id'     =>  $user_login_id,
                             'page_id'           	=>  $configuration->id,
                             'page_name'             =>  clean_single_input($configuration->sender_name),
                             'page_action'           =>  'delete',
                             'page_category'         =>  clean_single_input($configuration->cof_type),
                             'lang'                  =>  clean_single_input($configuration->language),
                             'page_title'        	=> 'configuration Module',
                             'approve_status'        => 1,
                             'usertype'          	=> 'Admin'
                         );
                         
             audit_trail($audit_data);
             return redirect('admin/configuration')->with('success','Configurations deleted successfully');
         }
        
        
     }
}
