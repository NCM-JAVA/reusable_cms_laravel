<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Corrigendum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CorrigendumController extends Controller
{

    public function create($id,$type)
    {
        // $item = YourModel::findOrFail($id);
        $data = Corrigendum::all();
        $title = "Add Corrigendum";
        $id = $id;
        $type = $type;
        return view('admin.corrigendum.create', compact(['title','id','type']));
    }

    public function store(Request $request)
    {
        $txtuplode1 ='';
        // $request->validate([
        //     'txtuplode' => 'required|mimes:pdf|max:2048',
        //     'title' => 'nullable|string',
        // ]);

        if (!empty($request->txtuplode)){
            // dd("Hello");
            if (!is_dir('public/upload/admin/cmsfiles/corrigendum/')) {
                mkdir('public/upload/admin/cmsfiles/corrigendum/', 0777, TRUE);
            }

            $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_corrigendum'.'.'.$request->txtuplode->extension();
       
            $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/corrigendum/'), $txtuplode1);

            if($res){
                $txtuplode1 =$txtuplode1;
            }
            $txtuplode2 ='upload/admin/cmsfiles//corrigendum/'.$txtuplode1; //die();
            
            if (file_exists($txtuplode2)) {
                unlink($txtuplode2);
            }

            $corrigendum_type = $request->corrigendum_type == 'tender' ? 1 : 2;
            Corrigendum::create([
                'parent_id' => $request->parent_id,
                'title' => $request->title,
                'txtuplode' => clean_single_input($txtuplode1),
                'type' => $corrigendum_type,
            ]);
        }

        if($request->corrigendum_type == 'tender'){
            return redirect('admin/tender')->with('success', 'Corrigendum uploaded and saved successfully.');
        }else{
            return redirect('admin/recruitment')->with('success', 'Corrigendum uploaded and saved successfully.');
        }
        
    }

    public function edit($id, $type){
        $data = Corrigendum::where('parent_id',$id)->get();
        // dd($data);
        $title = "Edit Corrigendum";
        $id = $id;
        $type = $type;
        return view('admin.corrigendum.edit', compact(['title','id','type','data']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'txtuplode' => 'nullable|mimes:pdf|max:2048',
        ]);

        $corr = Corrigendum::findOrFail($id);
        $corr->title = $request->title;

        if ($request->hasFile('txtuplode')) {
            $file = $request->file('txtuplode');
            $filename = str_replace(' ','_',clean_single_input($request->title)).'_corrigendum'.'.'.$request->txtuplode->extension();
            $file= $request->txtuplode->move(public_path('upload/admin/cmsfiles/corrigendum/'), $filename);
            // $filename = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/corrigendums', $filename);
            $corr->txtuplode = $filename;
        }

        $corr->save();
        return redirect()->back()->with('updated_corrigendum_id', $id);
    }
}
