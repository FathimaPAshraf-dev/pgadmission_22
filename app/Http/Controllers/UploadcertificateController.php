<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
//use Intervention\Image\ImageManagerStatic as Image;
//use Illuminate\Support\Facades\Image;
//use App\Http\Controllers\Auth\Image;
//use Request;
//use App\Http\Requests;
use App\User;
use App\Studadmin;
// use Hash;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;



class UploadcertificateController extends Controller
{  
    
     public function loadview(Request $request)
  {
           $ids =Auth::user()->pgapp_id;
          // return $ids;
          
            // $results=DB::select('select * from asw_pgapp where pgapp_id=?',[$ids]);
          
   $results=DB::select('select * from tb_pgapp where pgapp_id=?',[$ids]);
 //  dd($results);
       return view('viewdataug',compact('results')) ;
  
  } 
    
  
  
    
    
}