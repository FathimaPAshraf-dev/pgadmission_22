<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use App\PaymentTrans;
use PaymentGateway\Atom\Facades\Atompay;
use App\Gateway\TransactionRequest;
use App\Gateway\TransactionResponse;
use Redirect;
use Session;

class ViewPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
    
    
    
  public function viewpayment(Request $request)
  {
       $id=Auth::user()->postpgapp_appid;
       $postpgadm=DB::select("select * from asw_postpg_adm where adm_appid=?",[$id]);   
//       if(count($postpgadm)>0){
//           return view('memo.paymentview', compact('postpgadm')) ;      
//        
//       }
       
       $load =DB::select('SELECT 
  asw_postpg_allotment.appid,
    asw_postpg_adm.adm_centid ,
  asw_postpg_adm.adm_appid,
  tbz_postpg_ranklist.rank_stud_name, 
  tbz_postpg_ranklist.rank_appid, 
  tbz_postpg_ranklist.rank, 
  tbz_postpg_ranklist.rank_adscsl, 
  tbz_postpg_ranklist.centre_sl, 
  tbz_postpg_ranklist.allot_category, 
  asw_postpg_adm.adm_fees, 
  asw_postpg_adm.adm_pgmid, 
  asw_postpg_adm.adm_category, 
  asw_postpg_adm.onlinepay_status, 
  asw_postpg_adm.onlinepay_merchanttxnid, 
  asw_postpg_adm.onlinepay_amount, 
  asw_postpg_adm.onlinepay_tdate
  
FROM 
  public.asw_postpg_allotment, 
  public.asw_postpg_adm, 
  public.tbz_postpg_ranklist
  
WHERE 
  asw_postpg_allotment.appid = asw_postpg_adm.adm_appid AND
  tbz_postpg_ranklist.rank_appid = asw_postpg_allotment.appid AND 
  
     tbz_postpg_ranklist.rank_adscsl = asw_postpg_allotment.pgmid and tbz_postpg_ranklist.rank_appid=?',[$id]);  
       
   $utyservice='MPHIL/PHD ADMISSION FEE-2020';    
     $response =DB::select('SELECT * from tbz_atom_transactions where client_code=? and ucity_service=? and res_verified=?',[$id,$utyservice,'SUCCESS']);
//     dd($response);
     foreach($response as $key){
         $resverified=$key->res_verified;
     }
      if(count($postpgadm)>0){
    return view('memo.paymentview', compact('postpgadm','load','response')) ;  
      }
      else{
          return "Payment is not initiated";
      }
  }   

//mphiladmpayment
public function mphiladmpayment(Request $request)
    {
    //return "ll";
    $appid=Auth::user()->postpgapp_appid;
    $email=Auth::user()->postpgapp_email;
    $mobile=Auth::user()->postpgapp_mobile;
    $stud_name=Auth::user()->postpgapp_studname;
//         dd($request);
//         return  $email ;
            $dt_now = Carbon::now();
            $trn_date= $dt_now->toDateString();
            date_default_timezone_set('Asia/Calcutta');
            $datenow = date("d/m/Y h:m:s");
            $transactionDate = str_replace(" ", "%20", $datenow);
            $datereg=Carbon::now();
            $data = $request->all();
             
            $adm_appid=$request->input('adm_appid');   
            $stud_name=$request->input('stud_name');    
            $adm_fees=$request->input('adm_fees'); 
           
            $transactionId = rand(100000,100000000);   
           //return   $transactionId;
            $clentcode= $request->input('adm_appid');  
            DB::beginTransaction();
          try{
            $paymenttrans=new PaymentTrans;
                                     $paymenttrans->merchanttxnid=$transactionId;
                                     $paymenttrans->trans_amt=$adm_fees;
//                                    $paymenttrans->merchantid=71480;
                                    $paymenttrans->tdate=$trn_date;
                                    $paymenttrans->client_code=$clentcode;
                                    $paymenttrans->res_udf9_clientcode=$adm_appid;
                                    
                                    $paymenttrans->ucity_service='MPHIL/PHD ADMISSION FEE-2020';
                                    $paymenttrans->trans_timestamp=Carbon::now();
                                    $paymenttranssave = $paymenttrans->save();
      
                                      
        $asw_postpg_adm = DB::update('update asw_postpg_adm set onlinepay_merchanttxnid=?, onlinepay_amount=?,onlinepay_tdate=? where adm_appid= ? ', [$transactionId,$adm_fees,$datereg,$adm_appid]);
                                      
                                      
      
                                    
                                    $transactionRequest = new TransactionRequest();


                          
                                   //Setting all values here
//                                     $transactionRequest->setMode("test");
//                                     $transactionRequest->setLogin(197);
//                                    $transactionRequest->setPassword("Test@123");
//                                    $transactionRequest->setProductId("NSE");
//                                    $transactionRequest->setAmount($adm_fees);
//                                    $transactionRequest->setTransactionCurrency("INR");
//                                    $transactionRequest->setTransactionAmount($adm_fees);
//                                    $transactionRequest->setReturnUrl("http://14.139.185.106:92/feeresponse");
//                                     $transactionRequest->setClientCode(123);
//                                     $transactionRequest->setTransactionId($transactionId);
//                                     $transactionRequest->setTransactionDate($transactionDate);
//                                    $transactionRequest->setCustomerName("Test Name");
//                                     $transactionRequest->setCustomerEmailId('vishnupriyapradeep25690@gmail.com');
//                                     $transactionRequest->setCustomerMobile(9447534928);
//                                     $transactionRequest->setCustomerBillingAddress("Kerala");
//                                     $transactionRequest->setAppId($adm_appid);
//                                     $transactionRequest->setCustomerAccount("639827");
//                                     $transactionRequest->setReqHashKey("KEY123657234");  
//                                    
//                                          
                                   //for live 
                                    


                                    $transactionRequest->setMode("live");
                                    $transactionRequest->setLogin(71480);
                                    $transactionRequest->setPassword("SREE@123");
                                    $transactionRequest->setProductId("UNIVERSITY");
                                    $transactionRequest->setAmount($adm_fees);//$total
                                    $transactionRequest->setTransactionCurrency("INR");
                                    $transactionRequest->setTransactionAmount($adm_fees);//$total
                                    $transactionRequest->setReturnUrl("http://14.139.185.106:92/feeresponse");
                                    $transactionRequest->setClientCode($clentcode);
                                    $transactionRequest->setTransactionId($transactionId);
                                    $transactionRequest->setTransactionDate($transactionDate);
                                    $transactionRequest->setCustomerName($stud_name);//$name_stud
                                    $transactionRequest->setCustomerEmailId($email);//$email
                                    $transactionRequest->setCustomerMobile($mobile);//$mob_no
                                    // $transactionRequest->setCustomerBillingAddress("Kerala");
                                    $transactionRequest->setAppId($appid);
                                    $transactionRequest->setCustomerAccount("639827");
                                    $transactionRequest->setReqHashKey("e0a176300774097599");
//
//
                                    $url = $transactionRequest->getPGUrl();
                                     DB::commit();
                                     return Redirect::to($url);   
                      
          }
          
          
           catch(Exception $e){
              DB::rollback();
              return "error";
             } 
         
      //return "yes";
      
    }  
    public function feeresponse(Request $request){

        $transactionResponse = new TransactionResponse();
//       $transactionResponse->setRespHashKey("KEYRESP123657234");
$transactionResponse->setRespHashKey("ef929d2be4c79a7b99");

//       dd($_POST);
if($transactionResponse->validateResponse($_POST)){
  
            $mmp_txn = isset($_POST['mmp_txn']) ? $_POST['mmp_txn'] : 'NULL';
            $mer_txn = isset($_POST['mer_txn']) ? $_POST['mer_txn'] : 'NULL';
            $amt = isset($_POST['amt']) ? $_POST['amt'] : 'NULL';
            $prod = isset($_POST['prod']) ? $_POST['prod'] : 'NULL';
            $dateofpay = isset($_POST['date']) ? $_POST['date'] : 'NULL';
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
            $CardNumber = isset($_POST['CardNumber']) ? $_POST['CardNumber'] : 'NULL';
            $udf1 = isset($_POST['udf1']) ? $_POST['udf1'] : 'NULL';
       
       
       
    
    if ($f_code == 'Ok') {

        
        
    $datastudexam = DB::update('update asw_postpg_adm set onlinepay_status=1  where adm_appid= ? ', [$udf9]);     
        
    
      $datapay=PaymentTrans::where('merchanttxnid',$mer_txn)
                      
                      ->update([
                       'res_bankname' => $bank_name,
                         'res_bid'=>$bank_txn,
                        
                         'res_discriminator'=>$discriminator,
                          'res_atomtxn_id'=>$mmp_txn,
                         'res_card_number'=>$CardNumber,
                          'res_surcharge'=>$surcharge,
                           'res_txn_date'=>$dateofpay,
                          'res_udf9_clientcode'=>$udf9,
                          'res_verified'=>'SUCCESS',

                        ]);          
    
           Session::flash('message', "Payment Succesfully Completed!!!");
           Session::flash('alert-class', 'alert-success');  
            return redirect()->route('viewpayment');
           //return redirect()->route('pay_details');
    
    }
    else if($f_code == 'C'){

        Session::flash('message', "Payment Cancelled!!!");
           Session::flash('alert-class', 'alert-warning');   
           return redirect()->route('viewpayment');
    }
      else if($f_code == 'F'){
          
          
    $datastudexam = DB::update('update asw_postpg_adm set onlinepay_status=0  where adm_appid= ? ', [$udf9]);        

        $datapay=PaymentTrans::where('merchanttxnid',$mer_txn)
                      
                      ->update([
                       'res_bankname' => $bank_name,
                         'res_bid'=>$bank_txn,
                         'res_atomtxn_id'=>$mmp_txn,
                         'res_discriminator'=>$discriminator,
                        'merchanttxnid'=>$mer_txn,
                         'res_card_number'=>$CardNumber,

                           'res_txn_date'=>$dateofpay,
                          'res_verified'=>'FAILED',

                          

                        ]); 

        Session::flash('message', "Payement Failed Try again!!!");
           Session::flash('alert-class', 'alert-danger');   
           return redirect()->route('viewpayment');
    }
} 
else {
    return "Invalid Signature";
   
}
              
}

    public function pay_details()
    {
        $pay_details = DB::table('tb_postpgapp')->select('tbz_atom_transactions.*')
                   ->join('tbz_atom_transactions','tb_postpgapp.onlinepay_merchanttxnid','tbz_atom_transactions.merchanttxnid')
                   
                   ->where('tb_postpgapp.postpgapp_serial',Auth::user()->postpgapp_serial)->get(); 
                foreach ($pay_details as $value) {
                    $res_verified=$value->res_verified;
                }
          
//                dd($pay_details);
              return view('finalpg', compact('pay_details'));
    }  

  public function receiptdownload()
    {
           $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            
        $id=Auth::user()->postpgapp_appid;
      //return $ids;
           $utyservice='MPHIL/PHD ADMISSION FEE-2020'; 
  $load =DB::select('SELECT 
  asw_postpg_allotment.appid,
    asw_postpg_adm.adm_centid ,
  asw_postpg_adm.adm_appid,
  asw_postpg_adm.adm_appname,
  getcentrename(asw_postpg_adm.adm_centid)as allot_cent,
  tbz_postpg_ranklist.rank_stud_name, 
  tbz_postpg_ranklist.rank_appid, 
  tbz_postpg_ranklist.rank, 
  tbz_postpg_ranklist.rank_adscsl, 
  tbz_postpg_ranklist.centre_sl, 
  tbz_postpg_ranklist.allot_category, 
  asw_postpg_adm.adm_fees, 
  asw_postpg_adm.adm_pgmid, 
  asw_postpg_adm.adm_category, 
  asw_postpg_adm.onlinepay_status, 
  asw_postpg_adm.onlinepay_merchanttxnid, 
  asw_postpg_adm.onlinepay_amount, 
  asw_postpg_adm.onlinepay_tdate
  
FROM 
  public.asw_postpg_allotment, 
  public.asw_postpg_adm, 
  public.tbz_postpg_ranklist
  
WHERE 
  asw_postpg_allotment.appid = asw_postpg_adm.adm_appid AND
  tbz_postpg_ranklist.rank_appid = asw_postpg_allotment.appid AND 
  
     tbz_postpg_ranklist.rank_adscsl = asw_postpg_allotment.pgmid and tbz_postpg_ranklist.rank_appid=?',[$id]);  
//     return $load;      
            
        $response =DB::select('SELECT * from tbz_atom_transactions where res_udf9_clientcode=? and ucity_service=? and res_verified=?',[$id,$utyservice,'SUCCESS']);
         
            
       $pdf = PDF::loadView('memo.paymentpdf',compact('postpgapp','category','curnt_date','time','load','response'));

        return $pdf->download('fee_receipt.pdf');
//              return view('memo.paymentpdf');
    }     

  
    
     
}
