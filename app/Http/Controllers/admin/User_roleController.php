<?php

namespace App\Http\Controllers\admin;
use App\Models\Admin_role;
use App\Models\User;
use App\Models\admin\Module;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class User_roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
        $title="User Role List";
        //$user_role=admin_role::all();
		$user_role = DB::table('admin_roles')
        ->join('users', 'admin_roles.user_id', '=', 'users.id')
        ->select('admin_roles.*', 'users.name as user_name')
        ->get();        
        
        return view('admin/roles/user_role',compact(['user_role','title']));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="User Role Add";
         $user_role=User::leftJoin('admin_roles', 'admin_roles.user_id', '=', 'users.id')
         ->select('admin_roles.module_id','users.name' ,'users.id')
         ->get();
         $modules=Module::all();
        return view('admin/roles/add_user_role',compact(['user_role','title','modules']));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
                'user_id' => 'required|unique:admin_roles',
                'check_module'=>'required',
                'permissions'=>'required',
                'user_type'=>'required'
            ]);
        
        $Admin_role['role_name'] = clean_single_input($request->input('user_type'));
        $Admin_role['role_type'] = clean_single_input($request->input('user_type'));
        $Admin_role['role_id'] = clean_single_input($request->input('user_type'));
        $Admin_role['role_status'] = '1';
        $Admin_role['user_id'] =   clean_single_input($request->input('user_id'));
        $Admin_role['permissions'] = implode(",",$request->input('permissions')); 
        $Admin_role['module_id'] = implode(",",$request->input('check_module')); //clean_single_input($request->input('check_module'));
      //dd($Admin_role);
        $create = Admin_role::create($Admin_role);
        $lastInsertID = $create->id;
        $user_login_id=Auth()->user()->id;
         $data = User::find(clean_single_input($request->input('user_id'))); //die();
        if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $lastInsertID,
                            'page_name'             =>  $data->name,
                            'page_action'           =>  'Insert',
                            'page_category'         =>  clean_single_input($request->input('user_type')),
                            'lang'                  =>  '1',
                            'page_title'        	=> 'Role Model',
                            'approve_status'        =>  clean_single_input($request->input('user_type')),
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/user_role')->with('success','User role created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(admin_role $admin_role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
  
    { 
        $title=" Edit User role";
        $user_role_edit = Admin_role::leftJoin('users', 'users.id', '=', 'admin_roles.user_id')
        ->select('admin_roles.role_id','admin_roles.id as roleId','admin_roles.permissions as permissions','admin_roles.module_id','users.name' ,'users.id')->find($id);
        $modules=Module::all();
       // dd($user_role_edit);
        return view('admin/roles/user_role_edit',compact(['user_role_edit','title','modules']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      
         $id=clean_single_input($id);
       
           $request->validate([
           // 'user' => 'required',
            'check_module' => 'required',
            'permissions'=>'required',
            'user_type'=>'required'
            ]
           );
         //  dd($request);
            $Admin_role['role_name'] = clean_single_input($request->input('user_type'));
            $Admin_role['role_type'] = clean_single_input($request->input('user_type'));
            $Admin_role['role_id'] = clean_single_input($request->input('user_type'));
            $Admin_role['role_status'] = '1';
            $Admin_role['user_id'] =   clean_single_input($request->input('oldid'));
            $Admin_role['permissions'] = implode(",",$request->input('permissions')); 
            $Admin_role['module_id'] = implode(",",$request->input('check_module')); //clean_single_input($request->input('check_module'));
            $user_login_id=Auth()->user()->id;
            $data = User::find(clean_single_input($request->input('oldid')));
        
             $create 	= Admin_role::where('id', $id)->update($Admin_role);
           
            if($create > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                                'page_id'           	=>  $id,
                                'page_name'             =>  $data->name,
                                'page_action'           =>  'Update',
                                'page_category'         =>  clean_single_input($request->input('user_type')),
                                'lang'                  =>  '1',
                                'page_title'        	=> 'Role Model',
                                'approve_status'        =>  clean_single_input($request->input('user_type')),
                                'usertype'          	=> 'Admin'
                            );
                            
                audit_trail($audit_data);
                return redirect('admin/user_role')->with('success','User role  successfully Updated.');
            }
            
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin_role $admin_role,$id)
    {
        $aadmin_roles = Admin_role::find($id);
        $delete= $aadmin_roles->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $aadmin_roles->id,
                            'page_name'             =>  clean_single_input($aadmin_roles->role_name),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  1,
                            'page_title'        	=> 'User role Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/user_role')->with('success', 'User role deleted successfully');
        }
    }
}
