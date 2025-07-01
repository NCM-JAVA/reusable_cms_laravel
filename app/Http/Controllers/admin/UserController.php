<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function index()
    {
        $lists = User::where('user_type','!=',1);
        $user_name = Session::get('user_name');
        $user_status = Session::get('user_status');
           if (!empty($user_name)) {
              
                $lists->where('user_name',$user_name);
            }
            if (!empty($user_status)) {
               
                $lists->where('user_status',$user_status);
            }
     $title="User List";
     $user= $lists->paginate(10);
     return view('admin.user.users',compact(['user','title']));
    }

     public function create()
    {
        $title="User List";
         return view('admin.user.adduser',compact(['title']));
    }
    public function store(Request $request)
    {
        if(isset($request->search)){
            $user_name=clean_single_input(trim($request->user_name));
            $user_status=clean_single_input($request->user_status);
            Session::put('user_name', $user_name);
            Session::put('user_status', $user_status);
            return redirect('admin/user');
        }
       $request->validate([
            'name' => 'required |alpha|max:255',
            'user_name' => 'required|alpha|max:255',
            'email'=>'required|email|unique:users',
            'login_name'=>'required|alpha',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'designation'=>'required',
            'user_status'=>'required',
            'user_type'=>'required'

        ]);
       $user_login_id=Auth()->user()->id;
         $user = array(
           'name' => clean_single_input($request['name']),
           'user_name' => clean_single_input($request['user_name']),
           'email' => clean_single_input($request['email']),
           'login_name' => clean_single_input($request['login_name']),
           'password' => \Hash::make(clean_single_input($request['password'])),
           'designation' => clean_single_input($request['designation']),
           'user_status' => clean_single_input($request['user_status']),
           'user_type' => clean_single_input($request['user_type'])
        );
           $create  = User::create($user);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'               =>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->name),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->user_name),
            'lang'                  =>  clean_single_input($request->user_status),
            'page_title'            => 'User Model',
            'approve_status'        => clean_single_input($request->user_type),
            'usertype'              => 'Admin'
        );
                           
               audit_trail($audit_data);
       
        return redirect('admin/user')->with('success','User created successfully.');
    }
}
    public function show(Request $request)
    {
        //
    }

   
    public function edit(User $user)
    {
         $title=" Edit USer";
        return view('admin.user.useredit',compact('user','title'));

    }
    public function update(Request $request, $id)
    {
        $id=clean_single_input($id);
        $rules = array(
            'name' => 'required |alpha|max:255',
            'user_name' => 'required|alpha|max:255',
            'email'=>'required|email',
            'login_name'=>'required|alpha',
            'designation'=>'required',
            'user_status'=>'required',
            'user_type'=>'required',

);           $validator = Validator::make($request->all(), $rules);
           if(!empty($request['password'])){

                  $rules = array(
                 'password' => 'required|confirmed|min:6',
                  'password_confirmation' => 'required',
                  );
             $validator = Validator::make($request->all(), $rules);
            }
             
           if ($validator->fails()) {
        
          return  back()->withErrors($validator)->withInput();
            
           }else{
                $user = User::find($id);
                $user['name'] = clean_single_input($request['name']);
                $user['user_name'] = clean_single_input($request['user_name']);
                $user['email'] = clean_single_input($request['email']);
                $user['login_name'] = clean_single_input($request['login_name']);
                $user['password'] = \Hash::make(clean_single_input($request['password']));
                $user['designation'] = clean_single_input($request['designation']);
                $user['user_status'] = clean_single_input($request['user_status']);
                $user['user_type'] = clean_single_input($request['user_type']);
                $user->save();

                  $user_login_id=Auth()->user()->id;
             if($id > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'               =>   $id,
                    'page_name'             =>  clean_single_input($request->name),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->user_name),
                    'lang'                  =>  clean_single_input($request->user_status),
                    'page_title'            => 'User Model',
                    'approve_status'        => clean_single_input($request->user_type),
                    'usertype'              => 'Admin'
                );
                           
               audit_trail($audit_data);

                   
             }
         return redirect('admin/user')->with('success','User updated successfully');
      }
  }

     public function destroy(User $user)
    {
        $delete= $user->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $user->id,
                            'page_name'             =>  clean_single_input($user->name),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  1,
                            'page_title'        	=> 'User  Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/user')->with('success','User deleted successfully');
        }
       
    }
}