<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Audit_trail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title="Audit List";
        
		$query = DB::table('audit_trails')
        ->join('users', 'audit_trails.user_login_id', '=', 'users.id')
        ->select('audit_trails.*', 'users.name as user_name')
        ->orderBy('audit_trails.created_at', 'desc');

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('audit_trails.created_at', [
                $request->from_date . ' 00:00:00',
                $request->to_date . ' 23:59:59'
            ]);
        } elseif ($request->from_date) {
            $query->whereDate('audit_trails.created_at', $request->from_date);
        } elseif ($request->to_date) {
            $query->whereDate('audit_trails.created_at', $request->to_date);
        }

        $list = $query->paginate(50);
        return view('admin/audit/index',compact(['list','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
