<?php

namespace App\Http\Controllers\Lang;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function change(Request $request)
    {
        $def=$request->lang??1;
        App::setLocale($def);
        session()->put('locale', $def);
        return redirect()->back();
    }
}
