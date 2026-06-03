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
use App\RevalDetail;
use App\StudExam;

class ExamRevaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {  
        $stud_regno=Auth::user()->stud_registerno;
        $ugexam=DB::select("select  tb1.exam_name,exam_sem_sl,tb1.exam_sl,is_reval from tb_exam tb1 
                    inner join tb_studexam tb2 on tb1.exam_sl=tb2.exstd_exam_sl 
                   
                    where tb2.exstd_registerno=? and publish_status=1  order by exam_sl  desc" ,[$stud_regno]);
        
//           dd($ugexam);  
           
           $reval_master= DB::table('tbz_ug_reval_master')
                 ->select('pay_refno')
                 ->where('regno','=',$stud_regno)
                
                 ->get();
//           dd($reval_master);
        return view('ug.exam_revaluation.home',compact('ugexam'));
            
       
    }
    public function marklistrevaluation(Request $request){
       
        $stud_regno=Auth::user()->stud_registerno;
        $sem=$request->input('sem');
        $examsl=$request->input('examsl');
//        dd($examsl);

        $exam_name=DB::select("select  tb1.exam_name,tb1.exam_sem_sl,upper(tb2.tb_name_of_stud) as tb_name_of_stud,tb2.tb_center_name,
                            tb2.exstd_exam_sl,tb2.exstd_withheld,tb2.exstd_provisional_verify,tb1.exam_type,exam_sl
                            from tb_exam tb1 inner join tb_studexam tb2 on tb1.exam_sl=tb2.exstd_exam_sl 
                            where tb2.exstd_registerno=?  and tb1.exam_sem_sl=? and tb1.exam_sl=?" ,[$stud_regno,$sem,$examsl]);

//        dd($exam_name);
        foreach($exam_name as $res){
            $centre=$res->tb_center_name;
            $exstd_withheld=$res->exstd_withheld;
            $exstd_provisional_verify=$res->exstd_provisional_verify;
         }
        if($exstd_withheld==1 || $exstd_provisional_verify==1){

           session()->flash('message', 'Result Provisionally withheld !!! Please contact office/department');
           return redirect('/index');

        }
        $center=DB::select("select centre_name from tb_centre where centre_sl=?" ,[$centre]);

        $pdetsl=DB::select("select s.pdetsl,s.sem,s.intx,s.extx,s.mxintx,s.mxextx,s.totx,s.mxx,s.grade,s.grdpt,s.cgp,s.sgpa,p.pdet_credit,p.pdet_code,p.pdet_name,p.pdet_ptype_sl,t.ptype_name,t.ptype_sl 
                from tbz_studexamdet s inner join tb_paperdetails p on s.pdetsl=p.pdet_sl
                inner join tb_papertype t on t.ptype_sl=p.pdet_ptype_sl
                where s.regno=? and s.sem=? and s.exmsl=? order by p.pdet_code asc",[$stud_regno,$sem,$examsl]);
        
        $coureresult=DB::select("select exstd_sem,exstd_cgpa,exstd_cgpa_grd,exam_type from tb_studexam tb1 inner join tb_exam tb2
                     on tb2.exam_sl=tb1.exstd_exam_sl where tb1.exstd_registerno=? and exstd_sem=? and exam_sl=?" ,[$stud_regno,$sem,$examsl]);
      
        $examfeestruct= DB::table('tbz_examfeestruct')
                 ->select('fee_per_paper')
                 ->where('exam_fee_code','=','UG-BA-REVALUATION')
                 ->get();
         foreach ($examfeestruct as $key){
             $fee_per_paper=$key->fee_per_paper;
         }
       
        return view('ug.exam_revaluation.revaluationpreview')->with('exam_name',$exam_name)->with('center',$center)->with('pdetsl',$pdetsl)
                ->with('coureresult',$coureresult)->with('fee_per_paper',$fee_per_paper);

    } 
    public function payment(Request $request){
        
        $this->validate($request,[
             'chkpaper' =>'required',
             
         ]
         
        );   
              
            $paperchked=$request->chkpaper;
            
            $stud_id=Auth::user()->stud_sl;
            $stud_registerno=Auth::user()->stud_registerno;
            $examsl=$request->examsl;
            $randomId = rand(1,1000000);
            $clientcode=$stud_registerno.'-'.$examsl.'-'.$randomId;
//            dd($clientcode);
            
//            $totalamount=$request->totalamount;
            $totalamount=50;
            $pdetsl=DB::select("select s.pdetsl,s.sem,s.intx,s.extx,s.mxintx,s.mxextx,s.totx,s.mxx,s.grade,s.grdpt,s.cgp,s.sgpa,p.pdet_credit,p.pdet_code,p.pdet_name,p.pdet_ptype_sl,t.ptype_name,t.ptype_sl 
                from tbz_studexamdet s inner join tb_paperdetails p on s.pdetsl=p.pdet_sl
                inner join tb_papertype t on t.ptype_sl=p.pdet_ptype_sl
                where s.regno=? and s.exmsl=? order by p.pdet_code asc",[$stud_registerno,$examsl]);
           
            
            $count = DB::table('tbz_ug_reval_master')->where('regno',$stud_registerno)->where('exam_sl',$request->examsl)->count();
            
            if($count<1){
                try{ 
                    DB::beginTransaction();
                    $revalmaster=array(
                                  'exam_sl'=>$request->examsl,
                                  'stud_id'=>$stud_id,
                                  'regno'=>$stud_registerno,
                                  'client_code'=>$clientcode,
//                                  'pay_refno'=>''
                              );

                    $RevalMaster=RevalMaster::create($revalmaster);
                    $reval_req_sl=$RevalMaster->reval_req_sl;
                    foreach ($paperchked as $key){  
                        $pdetsl=DB::select("select s.totx from tbz_studexamdet s inner join tb_paperdetails p on s.pdetsl=p.pdet_sl
                        inner join tb_papertype t on t.ptype_sl=p.pdet_ptype_sl
                        where s.regno=? and s.exmsl=? and s.pdetsl=?",[$stud_registerno,$examsl,$key]);
                        foreach ($pdetsl as $val){
                        $revaldetail=array(
                                  'reval_master_sl'=>$reval_req_sl,
                                  'reval_pdetsl'=>$key,
                                  'reval_score'=>$val->totx,
                                 
                        );
                       
                    $RevalMaster=RevalDetail::create($revaldetail);
                     }
                    }
//                    dd($reval_req_sl);
                    DB::commit();
                
                }
                catch(Exception $e){
                    DB::rollback();
                    return "error";
                }
            }
            else{
                $reval_reqs= RevalMaster::all()->where('regno',$stud_registerno)->where('exam_sl',$request->examsl);
                
                foreach ($reval_reqs as $reval_req){
                    $reval_req_sl=$reval_req->reval_req_sl;
                    DB::table('tbz_ug_reval_details')->where('reval_master_sl', '=', $reval_req_sl)->delete();
                }
                
                   foreach ($paperchked as $key){  
                        $pdetsl=DB::select("select s.totx from tbz_studexamdet s inner join tb_paperdetails p on s.pdetsl=p.pdet_sl
                        inner join tb_papertype t on t.ptype_sl=p.pdet_ptype_sl
                        where s.regno=? and s.exmsl=? and s.pdetsl=?",[$stud_registerno,$examsl,$key]);
                        foreach ($pdetsl as $val){
                        $revaldetail=array(
                                  'reval_master_sl'=>$reval_req_sl,
                                  'reval_pdetsl'=>$key,
                                  'reval_score'=>$val->totx,
                                 
                        );
                       
                    $RevalMaster=RevalDetail::create($revaldetail);
                     }
                    }
               
                
                    
//                dd($reval_req_sl);
                
            }
           
           
            $name_stud=Auth::user()->stud_name;
//            $email=Auth::user()->stud_email;
//            $mob_no=Auth::user()->stud_phone;
            
            $email='ashikboney@gmail.com';
            $mob_no='8848918817';
            $transactionRequest = new TransactionRequest();
            date_default_timezone_set('Asia/Calcutta');
            $datenow = date("d/m/Y h:m:s");
            
            $transactionDate = str_replace(" ", "%20", $datenow);
            $transactionId = rand(1,1000000);
            
            $transactionRequest->setMode("live");
            $transactionRequest->setLogin(71480);
            $transactionRequest->setPassword("SREE@123");
            $transactionRequest->setProductId("UNIVERSITY");
            $transactionRequest->setAmount($totalamount);
            $transactionRequest->setTransactionCurrency("INR");
            $transactionRequest->setTransactionAmount($totalamount);
            $transactionRequest->setReturnUrl("http://14.139.185.102:8082/response");
            $transactionRequest->setClientCode($clientcode);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($name_stud);
            $transactionRequest->setCustomerEmailId($email);
            $transactionRequest->setCustomerMobile($mob_no);
            $transactionRequest->setAppId($reval_req_sl);
            //$transactionRequest->setCustomerBillingAddress($postpgapp_permt_address);
            $transactionRequest->setCustomerAccount("639827");
            $transactionRequest->setReqHashKey("e0a176300774097599");
          
                //Setting all values here
//            $transactionRequest->setMode("test");
//            $transactionRequest->setLogin(197);
//            $transactionRequest->setPassword("Test@123");
//            $transactionRequest->setProductId("NSE");
//            $transactionRequest->setAmount($reval_amount);
//            $transactionRequest->setTransactionCurrency("INR");
//            $transactionRequest->setTransactionAmount($reval_amount);
//            $transactionRequest->setReturnUrl("http://10.10.100.14:8082/response");
//            $transactionRequest->setClientCode(123);
//            $transactionRequest->setTransactionId($transactionId);
//            $transactionRequest->setTransactionDate($transactionDate);
//            $transactionRequest->setCustomerName($name_stud);
//            $transactionRequest->setCustomerEmailId($email);
//            $transactionRequest->setCustomerMobile($mob_no);
//            $transactionRequest->setAppId(2673);
//            //$transactionRequest->setCustomerBillingAddress("Mumbai");
//            $transactionRequest->setCustomerAccount("639827");
//            $transactionRequest->setReqHashKey("KEY123657234");
            
            $url = $transactionRequest->getPGUrl();
//            dd($url);
            return Redirect::to($url);     
    }
    
    public function paymentresponse(Request $request){
        
        
        
        $output = $request->all();
//      dd($output);
        $clientcode=$output['clientcode'];
        $fcode = $output['f_code'];
        $_POST = $output;

        $transactionResponse = new TransactionResponse();
        $transactionResponse->setRespHashKey("ef929d2be4c79a7b99");

        //if($transactionResponse->validateResponse($_POST)){

        if (isset($_POST)) {
            $mmp_txn = isset($_POST['mmp_txn']) ? $_POST['mmp_txn'] : 'NULL';
            $mer_txn = isset($_POST['mer_txn']) ? $_POST['mer_txn'] : 'NULL';
            $amt = isset($_POST['amt']) ? $_POST['amt'] : 'NULL';
            $prod = isset($_POST['prod']) ? $_POST['prod'] : 'NULL';
            $date = isset($_POST['date']) ? $_POST['date'] : 'NULL';
            $bank_txn = isset($_POST['bank_txn']) ? $_POST['bank_txn'] : 'NULL';
            $f_code = isset($_POST['f_code']) ? $_POST['f_code'] : 'NULL';
            $clientcode = isset($_POST['clientcode']) ? $_POST['clientcode'] : 'NULL';
            $bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : 'NULL';
            $auth_code = isset($_POST['auth_code']) ? $_POST['auth_code'] : 'NULL';
            $ipg_txn_id = isset($_POST['ipg_txn_id']) ? $_POST['ipg_txn_id'] : 'NULL';
            $merchant_id = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : 'NULL';
            $desc = isset($_POST['desc']) ? $_POST['desc'] : 'NULL';
            $udf9 = isset($_POST['udf9']) ? $_POST['udf9'] : 'NULL';
            $discriminator = isset($_POST['discriminator']) ? $_POST['discriminator'] : 'NULL';
            $surcharge = isset($_POST['surcharge']) ? $_POST['surcharge'] : 'NULL';
            $cardNumber = isset($_POST['CardNumber']) ? $_POST['CardNumber'] : 'NULL';
            $udf1 = isset($_POST['udf1']) ? $_POST['udf1'] : 'NULL';

        if ($fcode != 'C') {
            $udf2 = isset($_POST['udf2']) ? $_POST['udf2'] : 'NULL';
            $udf3 = isset($_POST['udf3']) ? $_POST['udf3'] : 'NULL';
            $udf4 = isset($_POST['udf4']) ? $_POST['udf4'] : 'NULL';
            $udf5 = isset($_POST['udf5']) ? $_POST['udf5'] : 'NULL';
            $udf6 = isset($_POST['udf6']) ? $_POST['udf6'] : 'NULL';
//            return redirect()->route('revaluation');
        }

            $signature = isset($_POST['signature']) ? $_POST['signature'] : 'NULL';
            $newdate = date('Y-m-d', strtotime($date));

        }

        //dd($_POST);

        
//        $new_appid=$output['clientcode'];

        if ($fcode == 'Ok') {
           
//            $result = DB::update('update tbz_candidate_fee set cndfee_dd_refno=?,cndfee_refdate=?,cndfee_bankname=?,cndfee_bankbranch=? where cndfee_cndappln_no=?', [$bank_txn, $newdate, $paymenttype, $paymentstatus, $new_appid]);
            
             $dataRevalMaster=RevalMaster::where('reval_req_sl', $udf9)->update([
                         'pay_amount' => $amt,
                         'pay_refno' => $bank_txn,
             ]);
             $sels=RevalMaster::all()->where('reval_req_sl',$udf9);
              foreach($sels as $sel){
                 $selexam_sl=$sel->exam_sl;
                 $selregno=$sel->regno;
             }
             
              $datastudexam=StudExam::where('exstd_exam_sl',$selexam_sl)
                      ->where('exstd_registerno',$selregno)
                      ->update([
                         'is_reval' => 1,
                         
                        ]);
            
           Session::flash('message', "Successfully registered!!!");
           Session::flash('alert-class', 'alert-success');   
           return redirect()->route('examevaluation');

        } 
        else if ($fcode == 'F') {
//            $flag = 0;
//            $candid = $appid;
//            $paymenttype = "Online";
//            $paymentstatus="";
//            $result = DB::update('update tbz_candidate_fee set  cndfee_bankbranch=? where  cndfee_cndappln_no=?',[$paymentstatus,$new_appid]);
            return redirect()->route('examevaluation');
        }
        else if ($fcode == 'C') {
             Session::flash('message', "Oops Something went wrong!!!");
             Session::flash('alert-class', 'alert-danger'); 
            return redirect()->route('examevaluation');
//            $flag = 0;
//            $candid = $appid;
//            $paymenttype = "Online";
//            $paymentstatus="";
//            $result = DB::update('update tbz_candidate_fee set  cndfee_bankbranch=? where cndfee_cndappln_no=?',[$paymentstatus,$new_appid]);
//             // $result = DB::update('update tbz_candidate_fee set  cndfee_bankbranch=?,cndfee_bankname=? where cndfee_id=?',[$paymentstatus,$paymentstatus,$appid]);
//            return view('auth.submitpayment', compact('candid', 'flag'));
        } 
        else {
             Session::flash('message', "Oops Something went wrong!!!");
             Session::flash('alert-class', 'alert-danger'); 
            return redirect()->route('examevaluation');
            $flag = 2;
            $candid = $appid;
            $paymenttype = "";
            $paymentstatus = "";
            $result = DB::update('update tbz_candidate_fee set cndfee_bankbranch=? where cndfee_cndappln_no=?', [$paymentstatus, $new_appid]);
            return view('auth.submitpayment', compact('candid', 'flag'));
        }
}
    

            
       public function revaluationpdf(Request $request)
    {
         $input=$request->all();
//      dd($input);
//         $regno=$request->input('regno');
//         $crsreg_id = $request->input('crsreg_id');
//         $sturegsem = $request->input('sturegsem');
//         
      
//         $Courseregmaster= Courseregmaster::all()->where('crsreg_id',$crsreg_id)->where('crsreg_sem',$sturegsem);
       
         

    
    $date = date_create($datetime);
     

    
    
//    switch ($sem) {
//      case '1':
//        $semester="FIRST SEMESTER";
//        break;
//         case '2':
//        $semester="SECOND SEMESTER ";
//        break;
//         case '3':
//        $semester="THIRD SEMESTER";
//        break;
//         case '4':
//        $semester="FOURTH SEMESTER";
//        break;
//         case '5':
//        $semester="FIFTH SEMESTER";
//        break;
//         case '6':
//        $semester="SIXTH SEMESTER";
//        break;
//
//      
//      default:
//        $semester=" ";
//        break;
//    }

    $pdf = PDF::loadView('ug.exam_revaluation.pdf');
//    return view('ug.coursereg.pdf', compact('Courseregmaster','papers'));
	return $pdf->download('CourseRegistration.pdf');

       

    }       
         
}