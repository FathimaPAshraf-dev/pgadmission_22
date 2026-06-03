<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

use App\User;
use App\Studadmin;

use Session;
use DB;
use Illuminate\Support\Facades\Auth;







  
class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('viewdataug');
      
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost1(Request $request)
    {
           $ids =Auth::user()->pgapp_id;
       //  dd($ids);
            $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);
         $file_name= $ids.'plustwo'.'.'.$request->file->extension();
        //dd($file_name);
          $file->move('images/ugphoto',$file_name);
   
    }
    public function fileUploadPost(Request $request)
    {
           $ids =Auth::user()->pgapp_id;
           $st=1;
          // dd($ids);
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);
        
  //dd($request);
        $fileName = $ids.'.'.$request->file->extension();  
   
//        $request->file->move(public_path('uploads'), $fileName);
       $request->file->move('images/pgcertificates',$fileName);
DB::update('update asw_pgapp set pgapp_certificate=?,pgapp_certificate_status=? where pgapp_id=?',[$fileName,$st,$ids]);  
DB::update('update tb_pgapp set pgapp_certificate=?,pgapp_certificate_status=? where pgapp_id=?',[$fileName,$st,$ids]);  
      
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
   
    }
}