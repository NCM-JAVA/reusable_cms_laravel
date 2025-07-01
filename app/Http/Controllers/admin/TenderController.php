<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Tender;
use App\Models\admin\Corrigendum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Tenders List";
        $approve_status=session()->get('approve_status');
        $sertitle=Session::get('Mtitle');
        $approve_status=Session::get('approve_status');
        $langid=Session::get('language_id')??1;

        $lists = Tender::query()
            ->leftJoin('corrigendums', 'tenders.id', '=', 'corrigendums.parent_id')
            ->select('tenders.*', DB::raw('MAX(corrigendums.parent_id)'), DB::raw('MAX(corrigendums.title) as cor_title'), DB::raw('MAX(corrigendums.txtuplode) as cor_file'), DB::raw('MAX(corrigendums.type) as cor_type'));

        if (!empty($sertitle)) {
            $lists->where('tender_title', 'LIKE', "%{$sertitle}%");
        }
        if (!empty($approve_status)) {
            $lists->where('txtstatus',$approve_status);
        }
        if (!empty($language_id)) {
            $lists->where('language',$langid);
        }
        $list=$lists->groupBy('tenders.id', 'tenders.tender_title', 'tenders.url', 'tenders.page_url','tenders.is_new','tenders.language','tenders.tendertype','tenders.menutype','tenders.metakeyword','tenders.metadescription','tenders.description','tenders.txtuplode','tenders.txtuplode','tenders.txtweblink','tenders.txtstatus','tenders.admin_id','tenders.start_date','tenders.end_date','tenders.created_at','tenders.updated_at')->orderBy('tenders.created_at', 'DESC')->paginate(10);
        
        return view('admin/tenders/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Tender";
        
        return view('admin/tenders/add',compact(['title']));
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
           //'tender_title' => 'required',
		   'tender_title' => 'required|regex:/^[\p{Devanagari}a-zA-Z0-9 ,()\'"\\/.&-]+$/u',
           'url' => 'required',
           'menutype' => 'required',
           //'tendertype' => 'required',
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

            if (!is_dir('public/upload/admin/cmsfiles/tenders/')) {
                mkdir('public/upload/admin/cmsfiles/tenders/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
			   
			   $clean_title = str_replace([' / ',', ',' ,',' , ','. ',' .',' . ',' & ','(',')','/', ',', '.','&'], '', $request->tender_title);
			   $txtuplode1 = str_replace(' ','_',clean_single_input($clean_title)).'_tender'.'.'.$request->txtuplode->extension();
               //$txtuplode1 = str_replace(' ','_',clean_single_input($request->tender_title)).'_tender'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/tenders/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//tenders/'.$txtuplode1; //die();
                
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
          
           $pArray['tender_title']    				= clean_single_input($request->tender_title); 
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
           //$pArray['tendertype']  		            = clean_single_input($request->tendertype); 
           $pArray['tendertype']  		            = 1; 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           
           $create 	= Tender::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'           	=>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->tender_title),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->menutype),
            'lang'                  =>  clean_single_input($request->language),
            'page_title'        	=> 'Tenders',
            'approve_status'        => clean_single_input($request->txtstatus),
            'usertype'          	=> 'Admin'
        );
                           
               audit_trail($audit_data);
               return redirect('admin/tender')->with('success','Tender has successfully added');
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
        $title="Edit Tender ";
        $id=clean_single_input($id);
        $data = Tender::find($id);
        return view('admin/tenders/edit',compact(['title','data']));
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
           'tender_title' => 'required|regex:/^[\p{Devanagari}a-zA-Z0-9 ,()\'"\\/.&-]+$/u',
           'url' => 'required',
           'menutype' => 'required',
           //'tendertype' => 'required',
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

            if (!is_dir('public/upload/admin/cmsfiles/tenders/')) {
                mkdir('public/upload/admin/cmsfiles/tenders/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
			   
			    $clean_title = str_replace([' / ',', ',' ,',' , ','. ',' .',' . ',' & ','(',')','/', ',', '.','&'], '', $request->tender_title);
			   $txtuplode1 = str_replace(' ','_',clean_single_input($clean_title)).'_tender'.'.'.$request->txtuplode->extension();
               //$txtuplode1 = str_replace(' ','_',clean_single_input($request->tender_title)).'_tender'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/tenders/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//tenders/'.$txtuplode1; //die();

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
          
         
           $pArray['tender_title']    				= clean_single_input($request->tender_title); 
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
           $pArray['tendertype']  		            = 1; 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $user_login_id=Auth()->user()->id;

           $create 	= Tender::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->tender_title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Tenders',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/tender')->with('success','Tender has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender)
    {
        $delete= $tender->delete();

        Corrigendum::where('parent_id',$tender->id)->where('type',1)->delete();

        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $tender->id,
                            'page_name'             =>  clean_single_input($tender->tender_title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($tender->language),
                            'page_title'        	=> 'Tenders',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/tender')->with('success','Tender deleted successfully');
        }
    }
	
	
}
