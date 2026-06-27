<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\User;
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

class PGAdmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allotmentdetails(Request $request)
    {
        
        $id=Auth::user()->pgapp_id;
        $adscl=Auth::user()->pgapp_adsc_sl;
        // dd($adscl);
  
         $allotusr=DB::select("select *,getcentrename(adm_centid) as centre,getpgm(adm_pgmid) as pgm from asw_pgadm where adm_appid=?",[$id]);
// dd($allotusr);
         if ($allotusr) {
            $centid = $allotusr[0]->adm_centid;
        }
    //    dd($centid);
         foreach($allotusr as $key){
             $pgmid=$key->adm_pgmid;
         }
        //  dd($pgmid);
         $allotstat=0;
          if (!empty($allotusr))
          {
              $allotstat=1;
          }
$codes = [
    'Uniform Fee' => 'UF',
    'Matriculation Fee' => 'MF',
    'Recognition Fee' => 'RF',
    'NCC Fee' => 'NCC',
    'Tuition Fee' => 'TF',
    'Admission Fee' => 'AF',
    'Special Fee' => 'SF',
    'Department Development Fund' => 'DDF',
    'First Sem Exam Fee' => 'FSEF',
    'PTA' => 'PTA',
    'Group Personal Accident Insurance Scheme' => 'GPAIS',
    'Silver Jubilee Welfare Fund for Students' => 'SJWF',
    'Caution Deposit' => 'CD',
];
          $total_adm_fee = DB::select("SELECT * FROM asw_pgadm_feestucture WHERE appid = ? AND pgmid = ?", [$id, $adscl]);
// dd($total_adm_fee);
                $data = [];

                foreach ($total_adm_fee as $fee) {
                    $data[$fee->fee_desc] = (float)$fee->amount;
                }
     
        
$merchant_param4 = '';

foreach ($data as $feeName => $amount) {
    $merchant_param4 .= ($codes[$feeName] ?? $feeName) . '_' . $amount . '+';
}
// dd($data);
$merchant_param4 = rtrim($merchant_param4, '+');

// dd($merchant_param4, strlen($merchant_param4));
// dd([
//     'data' => $data,
//     'merchant_param4' => $merchant_param4,
//     'total_fee' => array_sum($data),
//     'amount' => $amount ?? null
// ]);
          $account_code = null;

        $account_list=DB::select("select * from admn22.asw_account_list where pgm=? and centre=?",[$adscl,$centid]);
        // dd($account_list);

        foreach($account_list as $key){
            $account_code=$key->account_code;
        }
  

$total_fee = collect($total_adm_fee)->sum(function ($fee) {
    return (float) ($fee->amount ?? 0);
});

// dd($data);

    $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
        date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");
 
        return view('2022.pgallotmentview', compact('allotusr','allotstat','pgmid','account_code','merchant_param4'))->with('feeDetails', $data);



                
    }
    
    private function payment_success_status(){
        
           $id=Auth::user()->pgapp_id;
           $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('res_verified',"SUCCESS")
                   ->where('ucity_service',"PG-ADMISSION-FEE-2022")->count();
           
           return  $pay_details;      

    }
    
    // public function pgadmissionpayment2022(Request $request)
    public function initiatePayment(Request $request)
    {
        $appid=Auth::user()->pgapp_id;
        $adscl=Auth::user()->pgapp_adsc_sl;
        $amount=$request->input("totfee");
       // $amount=10;
        if($adscl==998){
           $adscl=$request->input("pgmid");

        }
        
//         $amount=10;
        $centid=$request->input("adm_centid");
        $account_list=DB::select("select * from admn22.asw_account_list where pgm=? and centre=?",[$adscl,$centid]);
//dd($account_list);
        foreach($account_list as $key){
            $account_code=$key->account_code;
        }
        
        if( ($this->payment_success_status() > 0) ){
            
            $updateadm=DB::update("update asw_pgadm set onlinepaystatus=1 where adm_appid=? ",[$appid]);
                
            Session::flash('message', "Successfully paid your admission fee !!!");
            Session::flash('alert-class', 'alert-success');   
            return redirect()->route('pay_details');
          
        }


        else 
{
// Get the authenticated user's registration number
//$regno = Auth::user()->stud_registerno; // Ensure regno is retrieved correctly
unset($request['_token']);
$request['tid'] = random_int(10000, 99999);
$request['order_id'] = random_int(10000, 99999);
// Add regno as client_code
$request['client_code'] = Auth::user()->pgapp_id;
// Initialize merchant data from request
$merchant_data = '';
foreach ($request->all() as $key => $value) {
$merchant_data .= $key . '=' . $value . '&';
}
$encrypted_data = CryptoHelper::encrypt($merchant_data, $this->working_key);
// CCAvenue production URL
$production_url = 'https://secure.ccavenue.com/transaction/transaction.do?
command=initiateTransaction&encRequest='
. $encrypted_data . '&access_code=' . $this->access_code;
$access_code = $this->access_code;
$purl = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';

// Return the view with the production URL for the iframe
return view('ccavenue.payment', compact('production_url', 'encrypted_data', 'access_code', 'purl'));
}
        
        // else {
           
        // $dt_now = Carbon::now();
        
        // $trn_date= $dt_now->toDateString();
        // date_default_timezone_set('Asia/Calcutta');
        // $datenow = date("d/m/Y h:m:s");
        // $transactionDate = str_replace(" ", "%20", $datenow);
        
        // $datereg=Carbon::now();
        // $pgapp_sl= Auth::user()->pgapp_sl;
        // $pgapp_mobile= Auth::user()->pgapp_mobile;
        // $pgapp_email= Auth::user()->pgapp_email;
        // $pgapp_name= Auth::user()->pgapp_name;
        // $transactionId = rand(100000,100000000).$pgapp_sl;
        // $clentcode= Auth::user()->pgapp_id;
        // $pgapp_stream_id= Auth::user()->pgapp_stream_id;
        // $pgapp_community= Auth::user()->pgapp_community;


        // $paymenttrans=new PaymentTrans;
        // $paymenttrans->merchanttxnid=$transactionId;
        // $paymenttrans->trans_amt=$amount;
        // $paymenttrans->tdate=$trn_date;
        // $paymenttrans->client_code=$clentcode;
        // $paymenttrans->res_udf9_clientcode=$pgapp_sl;
        // $paymenttrans->ucity_service='PG-ADMISSION-FEE-'.date('Y');
        // $paymenttrans->trans_timestamp=Carbon::now();
        // $paymenttrans->account_code=$account_code;
        // $paymenttranssave = $paymenttrans->save();

        // $transactionRequest = new TransactionRequest();

    //                                    //Setting all values here
    //                                     $transactionRequest->setMode("test");
    //                                     $transactionRequest->setLogin(197);
    //                                     $transactionRequest->setPassword("Test@123");
    //                                     $transactionRequest->setProductId("NSE");
    //                                     $transactionRequest->setAmount($amount);
    //                                     $transactionRequest->setTransactionCurrency("INR");
    //                                     $transactionRequest->setTransactionAmount($amount);
    //                                     $transactionRequest->setReturnUrl("http://14.139.185.106:97/home/postpgfeeresponse");
    //                                     $transactionRequest->setClientCode($pgapp_sl);
    //                                     $transactionRequest->setTransactionId($transactionId);
    //                                     $transactionRequest->setTransactionDate($transactionDate);
    //                                     $transactionRequest->setCustomerName("Test Name");
    //                                     $transactionRequest->setCustomerEmailId('vishnupriya@ssus.ac.in');
    //                                     $transactionRequest->setCustomerMobile(9447534928);
    ////                                     $transactionRequest->setCustomerBillingAddress("Kerala");
    //                                     $transactionRequest->setAppId($pgapp_sl);
    //                                     $transactionRequest->setCustomerAccount("639827");
    //                                     $transactionRequest->setReqHashKey("KEY123657234");


//            $transactionRequest->setMode("live");
//            $transactionRequest->setLogin(71480);
//            $transactionRequest->setPassword("SREE@123");
// //           $transactionRequest->setProductId("UNIVERSITY");
//            $transactionRequest->setProductId($account_code);
//            $transactionRequest->setAmount($amount);//$total
//            $transactionRequest->setTransactionCurrency("INR");
//            $transactionRequest->setTransactionAmount($amount);//$total 
//            $transactionRequest->setReturnUrl("https://pgadmission.ssus.ac.in/home/pgadmfeeresponse");

//            $transactionRequest->setClientCode($clentcode);
//             $transactionRequest->setTransactionId($transactionId);
//             $transactionRequest->setTransactionDate($transactionDate);
//             $transactionRequest->setCustomerName($pgapp_name);//$name_stud
//             $transactionRequest->setCustomerEmailId($pgapp_email);//$email
//             $transactionRequest->setCustomerMobile($pgapp_mobile);//$mob_no
//             // $transactionRequest->setCustomerBillingAddress("Kerala");
//             $transactionRequest->setAppId($pgapp_sl);
//             $transactionRequest->setCustomerAccount("639827");
//             $transactionRequest->setReqHashKey("e0a176300774097599");


//             $url = $transactionRequest->getPGUrl();
          
// //              return Redirect::to($url);   
       
//         }
        
                               
                                
    }


    public function payResponse(Request $request)
    {
    $applicationNo = $request->input('merchant_param1');
    $order_id = $request->input('order_id');
    $clientcode = $request->input('merchant_param3');
    $student = auth()->user();
    // Query the database to get student application data
    // $applications = DB::table('cert.student_tc_cc')
    // ->leftJoin('cert.remark_clearance', 'cert.student_tc_cc.application_id', '=',
    // 'cert.remark_clearance.application_id')
    // ->select('cert.student_tc_cc.*', 'cert.remark_clearance.*') // Select all columns from both tables
    // ->where('cert.student_tc_cc.register_no', $student->stud_registerno)
    // ->get();
    $status = $request-> order_status;
    // dd($status);
    if (auth()->user()->pgapp_id == $clientcode) {
    // dd($status);
    // dd( $applications);
    // Check the order status and update payment status in the database accordingly
    if ($status == 'Success') {
    //dd( 'hh');
    // Update the payment_status to 1 (success)
    
    // dd( 'hggh');
    $updateadm=DB::update("update asw_pgadm set onlinepaystatus=1 where adm_appid=? ",[$clientcode]);
    return redirect()->route('pay_details');
    }
    if ($status == 'Failure' || $status == 'Awaited') {
    // Update the payment_status to 2 (failure)
    //dd( 'hh');
    
    // dd( 'hhrr');
    return redirect()->route('pay_details');
    }
    if ($status == 'Aborted' ){
    // dd('hiii');
    // Update the payment_status to 2 (failure)
    
    
    return redirect()->route('pay_details');
    }
    }
    }









    
    public function pgadmfeeresponse(Request $request){
        $appid=Auth::user()->pgapp_id;
        $transactionResponse = new TransactionResponse();
//       $transactionResponse->setRespHashKey("KEYRESP123657234");
        $transactionResponse->setRespHashKey("ef929d2be4c79a7b99");

       //dd($request->all());
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
//            $account_code = isset($_POST['account_code']) ? $_POST['account_code'] : 'NULL';
            $auth_code = isset($_POST['auth_code']) ? $_POST['auth_code'] : 'NULL';
            $ipg_txn_id = isset($_POST['ipg_txn_id']) ? $_POST['ipg_txn_id'] : 'NULL';
            $merchant_id = isset($_POST['merchant_id']) ? $_POST['merchant_id'] : 'NULL';
            $desc = isset($_POST['desc']) ? $_POST['desc'] : 'NULL';
            $udf9 = isset($_POST['udf9']) ? $_POST['udf9'] : 'NULL';
            $discriminator = isset($_POST['discriminator']) ? $_POST['discriminator'] : 'NULL';
            $surcharge = isset($_POST['surcharge']) ? $_POST['surcharge'] : 'NULL';
            $CardNumber = isset($_POST['CardNumber']) ? $_POST['CardNumber'] : 'NULL';
            $udf1 = isset($_POST['udf1']) ? $_POST['udf1'] : 'NULL';
       
       $feestucture = DB::table('asw_pgadm_feestucture')
    ->where('appid', $appid)
    ->get();
//       dd($feestucture);
            
           foreach ($feestucture as $key) {
    DB::connection('pgsql2')->table('fee.atom_txn_details')->insert([
        'det_mt_txn_id'   => $mer_txn,
        'det_fee_desc'    => $key->feecode,     
        'det_fee_amount'  => $key->amount,      
        'det_remarks'     => $key->fee_desc     
    ]);
}

            
        if ($f_code == 'Ok') {
            $updateadm=DB::update("update asw_pgadm set onlinepaystatus=1 where adm_appid=? ",[$appid]);
            $datapay=PaymentTrans::where('merchanttxnid',$mer_txn)
                      
                        ->update([
                       'res_bankname' => $bank_name,
                         'res_bid'=>$bank_txn,
                        'res_verified' =>'SUCCESS',
                         'res_discriminator'=>$discriminator,
                          'res_atomtxn_id'=>$mmp_txn,
                         'res_card_number'=>$CardNumber,
                          'res_surcharge'=>$surcharge,
                           'res_txn_date'=>$dateofpay,
                          'res_udf9_clientcode'=>$udf9,
//                          'account_code'=>$account_code
//                         'atom_txn_id'=>$ipg_txn_id,
                        ]);     
 
          
          
           Session::flash('message', "Successfully paid your admission fee !!!");
           Session::flash('alert-class', 'alert-success');   
           return redirect()->route('pay_details');
    
        }
        else if($f_code == 'C'){
                Session::flash('message', "Payment Cancelled!!!");
               Session::flash('alert-class', 'alert-danger');   
               return redirect()->route('pay_details');
        }
        else if($f_code == 'F'){

            $datapay=PaymentTrans::where('merchanttxnid',$mer_txn)
                      
                      ->update([
                       'res_bankname' => $bank_name,
                         'res_bid'=>$bank_txn,
                         'res_atomtxn_id'=>$mmp_txn,
                         'res_discriminator'=>$discriminator,
                        'merchanttxnid'=>$mer_txn,
                         'res_card_number'=>$CardNumber,
//                          'res_surcharge'=>$surcharge,
                           'res_txn_date'=>$dateofpay,
//                          'res_udf9_clientcode'=>$udf9,
                          
//                         'atom_txn_id'=>$ipg_txn_id,
                        ]); 

            Session::flash('message', "Payment Failed Try again!!!");
           Session::flash('alert-class', 'alert-danger');   
           return redirect()->route('pay_details');
        }
    } 
    else {
        return "Invalid Signature";

    }
        
      
    }  

    public function admfeereceipt2022()
    {
        $id=Auth::user()->pgapp_id;
        
        $details =DB::SELECT("SELECT getcentrename(asw_pgadm.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,getcentrecode(transferred_centre) as transferred_centre,
        getcentrecode(asw_pgadm.adm_centid) as centcode,tb_pgapp.* FROM  public.asw_pgadm
    inner join tb_pgapp on tb_pgapp.pgapp_id = asw_pgadm.adm_appid where adm_appid=?",[$id]);

if(empty($details)){
    $details =DB::SELECT("SELECT getcentrename(asw_pgadm_admitted_cancel.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,
     getcentrecode(asw_pgadm_admitted_cancel.adm_centid) as centcode,tb_pgapp.* FROM  public.asw_pgadm_admitted_cancel
 inner join tb_pgapp on tb_pgapp.pgapp_id = asw_pgadm_admitted_cancel.adm_appid where adm_appid=?",[$id]); 
 }
        


 $feestructure = DB::select('SELECT * from asw_pgadm_feestucture where appid=?',[$id]);
// Atom payments
$atomfee = DB::connection('pgsql2')->select("
    SELECT DISTINCT * 
    FROM tbz_atom_transactions 
    WHERE client_code = ? 
      AND ucity_service = ? 
      AND res_verified = ?", 
    [$id, 'PG-ADMISSION-FEE-2026', 'SUCCESS']
);

// CCAvenue payments
$ccavenuefee = DB::connection('pgsql2')
    ->table('tbz_ccavenue_txns')
    ->where('client_code', $id)
    ->where('ucity_service', 'LIKE', 'PG-ADMISSION-FEE-2026')
    ->whereIn('order_status', ['Success', 'Shipped', 'Successfully'])
    ->get();
// Merge both payments into one array
$admfee =  $ccavenuefee;

//dd($admfee);
      
        
        $flag=0;
        if(count($admfee)>1){
            $flag=1;
        }
        $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Kolkata");
            $timenow= date("H:i:s");

            $pdf = PDF::loadView('2022.pgfeerecipt2022',compact('details','curnt_date','timenow','feestructure','admfee','flag'));

            return $pdf->download('PGAdmissionFeeReceipt.pdf');
     
    }
    
//     public function admfeereceipt2022()
//     {
//         $id=Auth::user()->pgapp_id;
        
//         $details =DB::SELECT("SELECT getcentrename(asw_pgadm.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,getcentrecode(transferred_centre) as transferred_centre,
//             getcentrecode(asw_pgadm.adm_centid) as centcode,tb_pgapp.* FROM  public.asw_pgadm
//         inner join tb_pgapp on tb_pgapp.pgapp_id = asw_pgadm.adm_appid where adm_appid=?",[$id]);
        
// //        $details =DB::SELECT( "SELECT getcentrename(asw_pgadm.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,tb_pgapp.* FROM  public.asw_pgadm
// //        inner join tb_pgapp on tb_pgapp.pgapp_id = asw_pgadm.adm_appid where adm_appid=?",[$id]);

//         if(empty($details)){
//            $details =DB::SELECT("SELECT getcentrename(asw_pgadm_admitted_cancel.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,
//             getcentrecode(asw_pgadm_admitted_cancel.adm_centid) as centcode,tb_pgapp.* FROM  public.asw_pgadm_admitted_cancel
//         inner join tb_pgapp on tb_pgapp.pgapp_id = asw_pgadm_admitted_cancel.adm_appid where adm_appid=?",[$id]); 
//         }
        
//         $feestructure = DB::select('SELECT * from asw_pgadm_feestucture where appid=?',[$id]);
//         $admfee = DB::connection('pgsql2')->select('SELECT distinct * from tbz_atom_transactions where client_code=? and ucity_service=?'
//                  . 'and res_verified=?',[$id,'PG-ADMISSION-FEE-2025','SUCCESS']);
//         $flag=0;
//         if(count($admfee)>1){
//             $flag=1;
//         }
//         $dt_now = Carbon::now();
//             $curnt_dat= $dt_now->toDateString();
//             $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
//             date_default_timezone_set("Asia/Calcutta");
//             $timenow= date("H:i:s");

//         $pdf = PDF::loadView('2022.pgfeerecipt2022',compact('details','curnt_date','timenow','feestructure','admfee','flag'));

//         return $pdf->download('PGAdmissionFeeReceipt.pdf');
     
//     }
    
    public function admfeereceipt2022dept($id)
    {
//        dd($id);
        $details =DB::SELECT( "SELECT getcentrename(asw_pgadm.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,pg_allotment.* FROM  public.asw_pgadm
        inner join admn22.pg_allotment on pg_allotment.appid = asw_pgadm.adm_appid where adm_appid=?",[$id]);

        $feestructure = DB::select('SELECT * from asw_pgadm_feestucture where appid=?',[$id]);
        $admfee = DB::connection('pgsql2')->select('SELECT distinct * from tbz_atom_transactions where client_code=? and ucity_service=?'
                 . 'and res_verified=?',[$id,'PG-ADMISSION-FEE-2023','SUCCESS']);
        $flag=0;
        if(count($admfee)>1){
            $flag=1;
        }
        $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $timenow= date("H:i:s");

        $pdf = PDF::loadView('2022.pgfeerecipt2022',compact('details','curnt_date','timenow','feestructure','admfee','flag'));

        return $pdf->download('PGAdmissionFeeReceipt.pdf');
     
    }

  
}   
    

