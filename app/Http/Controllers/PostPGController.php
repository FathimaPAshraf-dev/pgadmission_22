<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use PaymentGateway\Atom\Facades\Atompay;
use App\Gateway\TransactionRequest;
use App\Gateway\TransactionResponse;
use Redirect;
use App\RevalMaster;
use Validator;
use Session;

class PostPGController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {  
          
        return view('auth.register');
            
       
    }
     public function storepostpg(Request $request){
       return 'd';
                           
        DB::beginTransaction();
            try{
                 $alumni=array(
                          'photo'=>$file_name,
                          'name'=>$request->input('name'),
                          'gender'=>$request->input('gender'),
                          'reg_no'=>$request->input('reg_no'),
                          'study_from'=>$request->input('study_from'),
                          'study_to'=>$request->input('study_to'),
                          'prgrm_name'=>$request->input('prgrm_name'),
                          'department'=>$request->input('department'),
                          'centre'=>$request->input('centre'),
                          'contactno'=>$request->input('contactno'),
                          'emailid'=>$request->input('emailid'),
                          'crntaddress'=>$request->input('crntaddress'),
                          'permant_address'=>$request->input('permant_address'),
                          'chkEdu'=>$request->input('chkEdu'),
                          'high_prgrm'=>$request->input('high_prgrm'),
                          'high_institut'=>$request->input('high_institut'),
                          'chkemployed'=>$request->input('chkemployed'),
                          'dateofplacemnt'=>$request->input('dateofplacemnt'),
                          'post_held'=>$request->input('post_held'),
                          'employername'=>$request->input('employername'),
                          'address'=>$request->input('address'),
                          'avg_salary'=>$request->input('avg_salary'),
                          'contribution'=>$request->input('contribution'),
                          'otherinformation'=>$request->input('otherinformation'),
                          'joinssus'=>$request->input('joinssus'),
                          
                      );

                AlumniReg::create($alumni);
                DB::commit();
                return redirect('/alumni/registration')->with('message', 'Your data has been successfully saved');  
            }
          
            catch(Exception $e){
                DB::rollback();
                return "error";
            }
      
       
    }
    
      public function viewranklist(Request $request)
     {
return "ff";
           
    
     }
         
}