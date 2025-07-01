<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use auth;
use App\Traits\ModulesTraits; 
class ModulesAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    use ModulesTraits;
    public function handle($request, Closure $next)
    {
        
         $user_id=Auth()->user()->id;
         $pageurl = clean_single_input(request()->segment(2));
         $action="";
         $res1=  clean_single_input(request()->segment(3));
         $res2=  clean_single_input(request()->segment(4));
         $res= $res1??$res2;
        if($res=='create'){
            $action="Add"; 
        }elseif($res2=='edit'){
            $action="Edit";
        }elseif(is_numeric($res)){
           $action="Delete";
        }else{
            $action="View";
        }
         $mid=  $this->module_id($pageurl);
        if (Auth::user() &&  Auth::user()->user_type == 1) {
            return $next($request);
        }else{
            if(has_module_permission($action,$user_id,$mid, $pageurl)){
              return $next($request);
            }
        }
        
         return response()->view('errors.check-permission');
    }
}
