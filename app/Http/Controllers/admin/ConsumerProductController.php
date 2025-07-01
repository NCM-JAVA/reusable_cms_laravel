<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\ConsumerProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ConsumerProductController extends Controller
{

    public function index()
    {
        $title="Consumer Products List";
        $approve_status=session()->get('approve_status');
        $sertitle=Session::get('Mtitle');
        $approve_status=Session::get('approve_status');
        $langid=Session::get('language_id')??1;

        $list = ConsumerProduct::where('language',$langid)->paginate(10);
        
        return view('admin/consumerProduct/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Consumer Product";
        
        return view('admin/consumerProduct/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        if(isset($request->search)){
            $Mtitle=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('Mtitle', $Mtitle);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/tender');
        }
        
        $txtuplode1 ='';
        $rules = array(
            'language' => 'required',
            'title' => 'required',
            'type' => 'required',
            'txtstatus' => 'required',
            // 'txtuplode' => 'required|mimes:pdf|max:2048',
        );
        
        if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/consumer_products/')) {
                mkdir('public/upload/admin/cmsfiles/consumer_products/', 0777, TRUE);
            }
        
            $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_consumer_products'.'.'.$request->txtuplode->extension();  

            $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/consumer_products/'), $txtuplode1);
        
        
            if($res){
                $txtuplode1 =$txtuplode1;
            }
            $txtuplode2 ='upload/admin/cmsfiles//consumer_products/'.$txtuplode1; //die();
        
            if (file_exists($txtuplode2)) {
                unlink($txtuplode2);
            }
       
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return  back()->withErrors($validator)->withInput();
                
            }else{
                $user_login_id=Auth()->user()->id;
                
                $pArray['title']    				    = clean_single_input($request->title); 
                $pArray['language']    			        = clean_single_input($request->language); 
                $pArray['type']  					    = clean_single_input($request->type);
                $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
                $pArray['txtstatus']  			            = clean_single_input($request->txtstatus); 
                
                $create 	= ConsumerProduct::create($pArray);
                $lastInsertID = $create->id;
                $user_login_id=Auth()->user()->id;

                if($lastInsertID > 0){
                    $audit_data = array('user_login_id'     =>  $user_login_id,
                        'page_id'           	=>  $lastInsertID,
                        'page_name'             =>  clean_single_input($request->title),
                        'page_action'           =>  'Insert',
                        'page_category'         =>  clean_single_input($request->type),
                        'lang'                  =>  clean_single_input($request->language),
                        'page_title'        	=> 'Consumer Product Model',
                        'approve_status'        => clean_single_input($request->txtstatus),
                        'usertype'          	=> 'Admin'
                    );
                           
                    audit_trail($audit_data);
                    return redirect('admin/consumer-products')->with('success','Consumer Product has successfully added');
                }
          
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
        $title="Edit Consumer Product ";
        $id=clean_single_input($id);
        $data = ConsumerProduct::find($id);
        return view('admin/consumerProduct/edit',compact(['title','data']));
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
                'title' => 'required',
                'type' => 'required',
                'txtstatus' => 'required',
                // 'txtuplode' => 'nullable|mimes:pdf|max:2048',
            );
        $validator = '';

        if (!empty($request->txtuplode)){

        if (!is_dir('public/upload/admin/cmsfiles/consumer_products/')) {
            mkdir('public/upload/admin/cmsfiles/consumer_products/', 0777, TRUE);
        }
            
        $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_consumer_products'.'.'.$request->txtuplode->extension();  
       
        $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/consumer_products/'), $txtuplode1);
              
               
        if($res){
            $txtuplode1 =$txtuplode1;
        }
        $txtuplode2 ='upload/admin/cmsfiles//consumer_products/'.$txtuplode1; //die();

            if (file_exists($txtuplode2)) {
                unlink($txtuplode2);
            }
        }else{
            $txtuplode1 =$request->olduplode;
        }

        $validator = Validator::make($request->all(), $rules);
       
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
          
         
           $pArray['title']    				        = clean_single_input($request->title); 
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['type']  					    = clean_single_input($request->type);
           $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           $pArray['txtstatus']  			            = clean_single_input($request->txtstatus); 
           $user_login_id=Auth()->user()->id;

           $create 	= ConsumerProduct::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->type),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Consumer Products Model',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/consumer-products')->with('success','Consumer Products has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsumerProduct $consumerProduct)
    {
        $delete= $consumerProduct->delete();

        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $consumerProduct->id,
                            'page_name'             =>  clean_single_input($consumerProduct->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($consumerProduct->language),
                            'page_title'        	=> 'Consumer Product Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/consumer-products')->with('success','Consumer Product deleted successfully');
        }
       
       
    }
}
