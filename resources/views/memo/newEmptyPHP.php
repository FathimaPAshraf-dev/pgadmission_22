<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\DB;
use App\PostPgOtherInfo;
use App\PostpgQuali;
use Validator;
use Carbon\Carbon;
use App\PaymentTrans;
use PaymentGateway\Atom\Facades\Atompay;
use App\Gateway\TransactionRequest;
use App\Gateway\TransactionResponse;
use Redirect;
use Session;
use Dompdf\Dompdf as Dompdf;
use PDF;


class PaymentController extends Controller
{
public function payment()
     {
     $ids =Session::get('pgapp_id');
    // dd($ids);
if(empty($ids))
{
//   return redirect('/pgadmission') ;
    return redirect()->route('pgadmission');  
}


    $paystat =DB::connection('pgsql2')->select('SELECT
  asw_allotment_first.appid,
  asw_pgadm.adm_appid,
  tbz_pgranklist.rank_stud_name,
  tbz_pgranklist.rank_appid,
  tbz_pgranklist.rank,
  tbz_pgranklist.rank_adscsl,
  tbz_pgranklist.centre_sl,
  tbz_pgranklist.allot_category,
  asw_pgadm.adm_fees,
  asw_pgadm.adm_pgmid,
  asw_pgadm.adm_category,
  asw_pgadm.onlinepay_status,
  asw_pgadm.onlinepay_merchanttxnid,
  asw_pgadm.onlinepay_amount,
  asw_pgadm.onlinepay_tdate,
  tb_pgapp.pgapp_email,
  tb_pgapp.pgapp_mobile
FROM
  public.asw_allotment_first,
  public.asw_pgadm,
  public.tbz_pgranklist,
  public.tb_pgapp
WHERE
  asw_allotment_first.appid = asw_pgadm.adm_appid AND
  tbz_pgranklist.rank_appid = asw_allotment_first.appid AND
  tbz_pgranklist.rank_appid = tb_pgapp.pgapp_id AND
     tbz_pgranklist.rank_adscsl = asw_allotment_first.pgmid and tbz_pgranklist.rank_appid=?',[$ids]);
    //return $paystat;
     
   $response =DB::select('SELECT * from tbz_atom_transactions where res_udf9_clientcode=? and res_verified=? ',[$ids,'SUCCESS']);
   
  $cnt=count($response);
 
         return view('paymentview',compact('paystat','response','cnt'));        
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
      public function pgfeeresponse(Request $request){

        $transactionResponse = new TransactionResponse();
    //   $transactionResponse->setRespHashKey("KEYRESP123657234");
$transactionResponse->setRespHashKey("ef929d2be4c79a7b99");

     //  dd($_POST);
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

       
       
    $datastudexam = DB::connection('pgsql2')->update('update asw_pgadm set onlinepay_status=1  where adm_appid= ? ', [$udf9]);    
       
       
       
       
//$datastudexam=User::where('rank_sl',$udf9)
//                      
//                      ->update([
//                        
//                         'onlinepay_status'=>1,
//                        
//                        ]);
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
            return redirect()->route('payment');
           //return redirect()->route('pay_details');
   
    }
    else if($f_code == 'C'){

        Session::flash('message', "Payment Cancelled!!!");
           Session::flash('alert-class', 'alert-warning');  
           return redirect()->route('payment');
    }
      else if($f_code == 'F'){
         
         
   $datastudexam = DB::connection('pgsql2')->update('update asw_pgadm set onlinepay_status=0  where adm_appid= ? ', [$udf9]);        

//       $datastudexam=User::where('postpgapp_serial',$udf9)
//                      
//                      ->update([
//                        
//                         'onlinepay_status'=>0,
//                        
//                        ]);
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
           return redirect()->route('payment');
    }
}
else {
    return "Invalid Signature";
   
}
             
}
public function downnload(Request $request)
    {
   
      $ids =Session::get('pgapp_id');
      //return $ids;
  $load =DB::connection('pgsql2')->select('SELECT
  asw_allotment_first.appid,
    asw_pgadm.adm_centid ,
  asw_pgadm.adm_appid,
  tbz_pgranklist.rank_stud_name,
  tbz_pgranklist.rank_appid,
  tbz_pgranklist.rank,
  tbz_pgranklist.rank_adscsl,
  tbz_pgranklist.centre_sl,
  tbz_pgranklist.allot_category,
  asw_pgadm.adm_fees,
  asw_pgadm.adm_pgmid,
  asw_pgadm.adm_category,
  asw_pgadm.onlinepay_status,
  asw_pgadm.onlinepay_merchanttxnid,
  asw_pgadm.onlinepay_amount,
  asw_pgadm.onlinepay_tdate,
  tb_pgapp.pgapp_email,
  tb_pgapp.pgapp_mobile
FROM
  public.asw_allotment_first,
  public.asw_pgadm,
  public.tbz_pgranklist,
  public.tb_pgapp
WHERE
  asw_allotment_first.appid = asw_pgadm.adm_appid AND
  tbz_pgranklist.rank_appid = asw_allotment_first.appid AND
  tbz_pgranklist.rank_appid = tb_pgapp.pgapp_id AND
     tbz_pgranklist.rank_adscsl = asw_allotment_first.pgmid and tbz_pgranklist.rank_appid=?',[$ids]);  
   //  return $load;
 
 foreach ($load as $key) {

    $appid=$key->appid;
   // return $appid;
    $adm_fees=$key->adm_fees;

  }
//return $ids;
//  $tab1 = DB::connection('pgsql2')->select('SELECT adm_appid,getcentrename(adm_centid)as allot_cent,adm_pgmid,adm_category,adm_appname,adm_allotment,adm_fees,adm_receiptno,adm_date,adm_number,onlinepay_merchanttxnid,onlinepay_amount,onlinepay_tdate,onlinepay_status  from asw_pgadm where adm_appid=?',[$ids]);
     
    $tab1 = DB::connection('pgsql2')->select('SELECT
  asw_allotment_first.appid,
  asw_pgadm.adm_appid,
  asw_pgadm.adm_appname,
  asw_pgadm.adm_allotment,
  asw_pgadm.adm_receiptno,
  asw_pgadm.adm_date,
  asw_pgadm.adm_number,getcentrename(asw_pgadm.adm_centid)as allot_cent,
  tbz_pgranklist.rank_stud_name,
  tbz_pgranklist.rank_appid,
  tbz_pgranklist.rank,
  tbz_pgranklist.rank_adscsl,
  tbz_pgranklist.centre_sl,
  tbz_pgranklist.allot_category,
  asw_pgadm.adm_fees,
  asw_pgadm.adm_pgmid,
  asw_pgadm.adm_category,
  asw_pgadm.onlinepay_status,
  asw_pgadm.onlinepay_merchanttxnid,
  asw_pgadm.onlinepay_amount,
  asw_pgadm.onlinepay_tdate,
  tb_pgapp.pgapp_email,
  tb_pgapp.pgapp_mobile
 

FROM
  public.asw_allotment_first,
  public.asw_pgadm,
  public.tbz_pgranklist,
  public.tb_pgapp
 
WHERE
  asw_allotment_first.appid = asw_pgadm.adm_appid AND
  tbz_pgranklist.rank_appid = asw_allotment_first.appid AND
  tbz_pgranklist.rank_appid = tb_pgapp.pgapp_id AND
 
  tbz_pgranklist.rank_adscsl = asw_allotment_first.pgmid and tbz_pgranklist.rank_appid=?',[$ids]);

 
//dd($tab1);
     // return $tab1;
//    $a='SUCCESS';
//    $tab2 = DB::connection('pgsql')->select('SELECT  res_bankname from tbz_atom_transactions where client_code=? AND res_verified=? ',[$ids,$a]);

    // dd ($tab2);


    foreach ($tab1 as $keynh) {
              # code...
           $adm_appid=$keynh->adm_appid;
           //return $adm_appid;
            $adm_pgmid=$keynh->adm_pgmid;
             $adm_category=$keynh->adm_category;
              $adm_appname=$keynh->adm_appname;

              $adm_allotment=$keynh->adm_allotment;

              $adm_fees=$keynh->adm_fees;
             // return $adm_fees;
              $adm_receiptno=$keynh->adm_receiptno;
              $adm_date=$keynh->adm_date;
               $adm_number=$keynh->adm_number;
               $onlinepay_merchanttxnid=$keynh->onlinepay_merchanttxnid;
               $onlinepay_amount=$keynh->onlinepay_amount;
               $onlinepay_tdate=$keynh->onlinepay_tdate;
               $onlinepay_status=$keynh->onlinepay_status;
               $allot_cent=$keynh->allot_cent;
               $rank_stud_name=$keynh->rank_stud_name;
               //return $rank_stud_name;
               //return $ids;
               
                  $a='SUCCESS';
    $tab2 = DB::connection('pgsql')->select('SELECT  res_bankname,res_card_number,ucity_service,res_bid from tbz_atom_transactions where client_code=? AND res_verified=? ',[$ids,$a]);
 //$tab2 = DB::connection('pgsql')->select('SELECT  * from tbz_atom_transactions where client_code=? AND res_verified=? ',[$ids,$a]);
   
   // dd($tab2);

    foreach ($tab2  as $key1) {
$res_bankname = $key1->res_bankname;
//return $res_bankname;
$res_card_number= $key1->res_card_number;
$ucity_service= $key1->ucity_service;
$res_bid= $key1->res_bid;


//return $res_bankname;
    }
   
   
   
       
         }

 


 


     $dompdf = new Dompdf();
  $html='  <html>
<title>W3.CSS Template</title>
<head>
<style type=\"text/css\">
         table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

       .headDetails {
   
    text-align: center;
      font-size: 16px;
}  
   

.tit{
     text-align: center;
   
}
.form-group{
         text-align: right;

}
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 20%;
    height:20%;
}

 .between {
        border: 1px dashed black;
        margin-left:10px;
        margin-right:10px;

    }
       h4.abc{
page-break-before: always;
    }
 
   
   

          </style>


</head>
<body>
<section class=\"content\">
       
      <!-- Default box -->
      <div class=\"box\" >
         
        <div class=\"box-header\">
             <div style=\"display: flex; justify-content: center;\">
<p align=\'center\'> <img src="images/redemb.jpg"  width="110" height="90"></p>

           
            </div>
            <div class=\"tit\">  <h3 class=\"box-title\" align=\'center\' style="display: flex; justify-content: center;"><b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT,KALADY</b></h3></div>
            <div class="form-group" align="right"  style="margin-top:-35px;">
                <div><center>Kalady Post,Ernakulam(Dist),Kerala-683574</center></div>
               
               
                <div><center>Tel:0484-2463380 , email:reg@ssus.ac.in</center></div>
            </div>
            <hr class="between" />
           
            <div class="headDetails" align=\'center\'>
            <u><b> PG ADMISSION-2020<br> Online Fee Receipt</b></u>
            <br><br>
             </div>
       
        </div>
      </div>

       <table border=2 >';

     
            foreach ($tab1 as $key) {
              # code...
           $candregno=$key->adm_appid;
  $html.='
      <tr>
    <td>Mode Of Payment  </td>
    <td>Online</td>
  </tr>
  <tr>
    <td>Application Id </td>
    <th>'.$key->adm_appid.'</th>
 </tr>


  <tr>
    <td>Student Name </td>
    <th>'.$key->rank_stud_name.'</th>

  </tr>
  <tr>
    <td>Admitted Program </td>
    <th>'.$key->adm_appname.'</th>

  </tr>
<tr>
    <td> Admitted Centre</td>
    <td>'.$key->allot_cent.'</td>
   
   
  </tr>
 
  <tr>
    <td>University Service name  </td>
    <td>'.$key1->ucity_service.'</td>
   
   
  </tr>
  <tr>
    <td>Bank Name </td>
    <td>'.$key1->res_bankname.'</td>
   
   
  </tr>
 


 <tr>
    <td>Transaction ID  </td>
    <td>'.$key->onlinepay_merchanttxnid.'</td>
   
   
  </tr>
 
    <tr>
    <td>Date Of Payment  </td>
    <td>'.$key->onlinepay_tdate.'</td>
   
   
  </tr>
    <tr>
    <td>Bank Ref. No:  </td>
    <td>'.$key1->res_bid.'</td>
   
   
  </tr>
   <tr>
    <td>Admission fee </td>
    <td>'.$key->onlinepay_amount.'</td>

  </tr>

 
 
<tr>
    <td>Transaction Status  </td>
   
   
    <td>SUCCESS</td>
   
   
  </tr>
 


  </table><br>';
 
 
 
 
 
}










             '</section>
             </body>
             <html>
             ';
       
       
 
    $dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream($candregno.".pdf");
//$dompdf->stream();





  }
   

   
   
//return "yes";

   

   public function pgadmpayment(Request $request)
    {
         $ids =Session::get('pgapp_id');
         //return  $ids ;
            $dt_now = Carbon::now();
            $trn_date= $dt_now->toDateString();
            date_default_timezone_set('Asia/Calcutta');
            $datenow = date("d/m/Y h:m:s");
            $transactionDate = str_replace(" ", "%20", $datenow);
            $datereg=Carbon::now();;
            $data = $request->all();
             //dd( $data);
           
            $adm_appid= $request->input('rank_appid');  
             //return $adm_appid;
            $rank_stud_name=$request->input('rank_stud_name');
            //return $rank_stud_name;
            $pgapp_email=$request->input('pgapp_email');
            $pgapp_mobile=$request->input('pgapp_mobile');
            //return $pgapp_mobile;
            $adm_fees=$request->input('adm_fees');  
             //return  $adm_fees;
            $transactionId = rand(100000,100000000);  
           //return   $transactionId;
            $clentcode= $request->input('rank_appid');  
           
               //return $clentcode;
            $paymenttrans=new PaymentTrans;
                                     $paymenttrans->merchanttxnid=$transactionId;
                                     $paymenttrans->trans_amt=$adm_fees;
//                                    $paymenttrans->merchantid=71480;
                                    $paymenttrans->tdate=$trn_date;
                                    $paymenttrans->client_code=$clentcode;
                                    $paymenttrans->res_udf9_clientcode=$adm_appid;
                                   
                                    $paymenttrans->ucity_service='PG ADMISSION FEE-'.date('Y');
                                    $paymenttrans->trans_timestamp=Carbon::now();
                                    $paymenttranssave = $paymenttrans->save();
                                   
//                                      $datapg=asw_pgadm::where('rank_appid',$adm_appid)                    
//                                        ->update([
//                                           'onlinepay_merchanttxnid'=>$transactionId,
//                                            'onlinepay_amount'=>$adm_fees,
//                                            'onlinepay_tdate'=>$datereg
//                                          ]);
                                   
                                      $datapg = DB::connection('pgsql2')->update('update asw_pgadm set onlinepay_merchanttxnid=?,onlinepay_amount=?,onlinepay_tdate=? where adm_appid= ? ', [$transactionId,$adm_fees,$datereg,$adm_appid]);
                                     
                                     
                                     
                                     
                                   
                                    $transactionRequest = new TransactionRequest();


                         
                                   //Setting all values here
//                                     $transactionRequest->setMode("test");
//                                     $transactionRequest->setLogin(197);
//                                    $transactionRequest->setPassword("Test@123");
//                                    $transactionRequest->setProductId("NSE");
//                                    $transactionRequest->setAmount($adm_fees);
//                                    $transactionRequest->setTransactionCurrency("INR");
//                                    $transactionRequest->setTransactionAmount($adm_fees);
//                                    $transactionRequest->setReturnUrl("http://14.139.185.106:98/pgfeeresponse");
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
                                    $transactionRequest->setReturnUrl("http://14.139.185.106:98/pgfeeresponse");
                                    $transactionRequest->setClientCode($clentcode);
                                    $transactionRequest->setTransactionId($transactionId);
                                    $transactionRequest->setTransactionDate($transactionDate);
                                    $transactionRequest->setCustomerName($rank_stud_name);//$name_stud
                                    $transactionRequest->setCustomerEmailId($pgapp_email);//$email
                                    $transactionRequest->setCustomerMobile($pgapp_mobile);//$mob_no
                                    // $transactionRequest->setCustomerBillingAddress("Kerala");
                                    $transactionRequest->setAppId($adm_appid);
                                    $transactionRequest->setCustomerAccount("639827");
                                    $transactionRequest->setReqHashKey("e0a176300774097599");


                                    $url = $transactionRequest->getPGUrl();
                                     return Redirect::to($url);  
         
      //return "yes";
     
    }  
   
   
  public function pgadmpaymentold()
    {
         
      //return "yes";
     
     
     
     
                                if(Auth::user()->onlinepay_status==0){    
                                $dt_now = Carbon::now();
                                $trn_date= $dt_now->toDateString();
       
                                date_default_timezone_set('Asia/Calcutta');
                                $datenow = date("d/m/Y h:m:s");
                               
                                $transactionDate = str_replace(" ", "%20", $datenow);
//dd($transactionDate);
                                $datereg=Carbon::now();;
                                $postpgapp_serial= Auth::user()->postpgapp_serial;
                                $postpgapp_mobile= Auth::user()->postpgapp_mobile;
                                $postpgapp_email= Auth::user()->postpgapp_email;
                                $postpgapp_studname= Auth::user()->postpgapp_studname;
                                $transactionId = rand(100000,100000000).$postpgapp_serial;
                                   
//                                    dd($transactionId);
                                    $clentcode= Auth::user()->postpgapp_appid;
                                   
//                                    require_once 'TransactionRequest.php';

                                      $paymenttrans=new PaymentTrans;
                                     $paymenttrans->merchanttxnid=$transactionId;
                                     $paymenttrans->trans_amt=150;
                                    $paymenttrans->tdate=$trn_date;
                                    $paymenttrans->client_code=$clentcode;
                                    $paymenttrans->res_udf9_clientcode=$postpgapp_serial;
                                    $paymenttrans->ucity_service='POST-PG-ENTRANCE-FEE-'.date('Y');
                                    $paymenttrans->trans_timestamp=Carbon::now();
                                    $paymenttranssave = $paymenttrans->save();
                                   
                                      $datapostpg=User::where('postpgapp_serial',$postpgapp_serial)                    
                                        ->update([
                                           'onlinepay_merchanttxnid'=>$transactionId,
                                            'onlinepay_amount'=>150,
                                            'onlinepay_tdate'=>$datereg
                                          ]);
                                   
                                   
                                    $transactionRequest = new TransactionRequest();




                                     $transactionRequest->setMode("live");
                                    $transactionRequest->setLogin(71480);
                                    $transactionRequest->setPassword("SREE@123");
                                    $transactionRequest->setProductId("UNIVERSITY");
                                    $transactionRequest->setAmount(150);//$total
                                    $transactionRequest->setTransactionCurrency("INR");
                                    $transactionRequest->setTransactionAmount(150);//$total
                                    $transactionRequest->setReturnUrl("http://14.139.185.106:92/home/postpgfeeresponse");
                                    $transactionRequest->setClientCode($clentcode);
                                    $transactionRequest->setTransactionId($transactionId);
                                    $transactionRequest->setTransactionDate($transactionDate);
                                    $transactionRequest->setCustomerName($postpgapp_studname);//$name_stud
                                    $transactionRequest->setCustomerEmailId($postpgapp_email);//$email
                                    $transactionRequest->setCustomerMobile($postpgapp_mobile);//$mob_no
                                    // $transactionRequest->setCustomerBillingAddress("Kerala");
                                    $transactionRequest->setAppId($postpgapp_serial);
                                    $transactionRequest->setCustomerAccount("639827");
                                    $transactionRequest->setReqHashKey("e0a176300774097599");


                                    $url = $transactionRequest->getPGUrl();
                                     return Redirect::to($url);  
                                }
                                elseif(Auth::user()->onlinepay_status==1){
                                   
                                    $appid=Auth::user()->postpgapp_appid;
                                    $data=User::where('postpgapp_appid',$appid)

                                                 ->update([

                                                    'postpg_edit_appl'=>0,

                                       ]);
                                    Session::flash('message', "Successfully edited!!!");
                                    Session::flash('alert-class', 'alert-warning');  
                                    return redirect()->route('pay_details');
                                }
                                else{
                                    return "Something went wrong";
                                }
       
    }
       
   
   
   
   
   
   
}

