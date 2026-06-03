<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Centre;
use App\Department;
use Session;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Dompdf\Dompdf as Dompdf;
use Illuminate\Support\Facades\Auth;
class DownloadmemoController extends Controller {
   //old 
           public function pgadmissionmemocopy(Request $request)
  {
 //return "application";
        $ids =Session::get('pgapp_id');
          //return $ids;     
        $category=DB::connection('pgsql2')->select('select * from tb_pgapp tb1 left join tbz_pgranklist tb2 on tb1.pgapp_id=tb2.rank_appid  left join tb_admnscheme tb3 on tb2.rank_adscsl=tb3.adsc_sl left join tb_program tb4 on tb3.adsc_pgm_sl=tb4.pgm_sl     where tb1.pgapp_id=?', [$ids]);
        //return $chkdcD;
    foreach ($category as $key) {

# code...

$allot_category = $key->allot_category;
//return $allot_category;
//$allot_cent = $key->allot_cent;
//return $allot_cent;

}
        
        
      // return  $allot_category;
      if($allot_category=='NOT ALLOT')
{
      //return "yes";   
          
         echo'<script>alert(" You are not in allotment list")</script>';  
                  //   return "no";
                      return view('pgadmissionusraccount'); 
}
 else {
    

       return view('pgadmissionmemo') ;
       
    }   
         
    } 
        public function pgadmissionmemo(Request $request)
  {
         $ids =Session::get('pgapp_id');
         // return $ids;  
            $allot =DB::connection('pgsql2')->select('select rank_adscsl from tbz_pgranklist where rank_appid=?  ',[$ids]);
//return  $allot;
    
foreach ( $allot as $key2) {

$rank_adscsl = $key2->rank_adscsl;
//return $rank_adscsl;


}
         
         $category=DB::connection('pgsql2')->select('select *,getcentrename(centid)as allot_cent,UPPER (reserve) as allot_category FROM asw_allotment_first where appid=?',[$ids]);

        //return  $category;
         
             foreach ($category as $key) {

# code...

$allot_category = $key->allot_category;
$allot_cent = $key->allot_cent;

//$pgmid = $key->pgmid;
	


}
    
  $allot =DB::connection('pgsql2')->select('select rank_adscsl from tbz_pgranklist where rank_appid=? and rank_adscsl IN(763,761,751,760,748,746,745,742,743,744,762,759,765)',[$ids]);
 //return  $allot;
  if(count($allot)>0 ) 
        {
      //not
     // return "no";
          return view('pgnotallot') ;
      
        }



    else if(count($category)<1){  
        
     echo'<script>alert(" You are not in allotment list")</script>';  
                  //   return "no";
                      return view('pgadmissionusraccount'); 
}
 else {
    

       return view('pgadmissionmemo') ;
       
    }   
         
    }
    
    
    
    
    
    
    
            public function downloadmemo(Request $request)
  {
              //  return "yes";
                $appid=Auth::user()->pgapp_id;
                //dd($appid);
//    $ids =Session::get('pgapp_id');
//    return  $ids;
    
     $category=DB::select('select *,allotment,getcentrename(centid)as allot_cent,UPPER (reserve) as allot_category FROM asw_allotment_first where appid=?',[$appid]);

   //  $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
  
      //  return  $category;
         
             foreach ($category as $key) {

# code...

$allot_category = $key->allot_category;
//return $allot_category;
$allot_cent = $key->allot_cent;
//return $allot_cent;
$allotment= $key->allotment;

//return $allotment;

}
    
    
    
    

      $date = DB::select('select sh_date,sh_time,sh_date1,sh_time1,sh_date2,sh_time2,sh_date3,sh_time3,sh_date4,sh_time4 FROM 
          ((tb_firstallotsh INNER JOIN asw_allotment_first ON tb_firstallotsh.sh_adscsl = asw_allotment_first.pgmid))
 where asw_allotment_first.appid=?',[$appid]);
   // return   $date ;
      foreach ($date as $key1) {
$daten=$key1->sh_date;
$time=$key1->sh_time;

$daten1=$key1->sh_date1;
$time1=$key1->sh_time1;

$daten2=$key1->sh_date2;
$time2=$key1->sh_time2;
$daten3=$key1->sh_date3;
$time3=$key1->sh_time3;
$daten4=$key1->sh_date4;
$time4=$key1->sh_time4;
//dd($daten);
//$daten2=$key1->sh_date2;
//$time2=$key1->sh_time2;
//$daten3=$key1->sh_date3;
//$time3=$key1->sh_time3;
//$daten4=$key1->sh_date4;
//$time4=$key1->sh_time4;
//$daten5=$key1->sh_date5;
//$time5=$key1->sh_time5;
//$datensp=$key1->sh_datesp;
//$timesp=$key1->sh_timesp;
//$timect=$key1->sh_timect;
//$datect=$key1->sh_datect;


         }

    //  return $datect;
  //return $timesp;    
      
 
   $chkdcD=DB::select('select * from tb_pgapp tb1 left join tbz_pgranklist tb2 on tb1.pgapp_id=tb2.rank_appid  left join tb_admnscheme tb3 on tb2.rank_adscsl=tb3.adsc_sl left join tb_program tb4 on tb3.adsc_pgm_sl=tb4.pgm_sl     where tb1.pgapp_id=?', [$appid]);
//return $chkdcD;
if(count($chkdcD)<1)
{


Session::flash('message', "Currently not in the allottment list");

return redirect('/') ;
   
  // return view('auth.login')
}

  

    



 foreach ($chkdcD as $key330) {

$ugapp_commaddr=$key330->pgapp_commaddress;

$app_status=$key330->onlinepay_status;

$pgapp_community=$key330->pgapp_community;


$ugapp_community=$key330->rank_community;
//$allot_category=$key330->allot_category;

$ugapp_stream_id=$key330->pgapp_stream_id;
// $centname=$key330->centre_sl;


}

//return $app_status;


if($app_status=0)
{


Session::flash('message', "Wrong Application ID/password");

return redirect('/') ;
   
  // return view('auth.login');







}











$centre_name="To be dedicided";






$sp="   ";
$datenw=" - 10 AM";

//select * from tb_firstallotsh where 



  $dompdf = new Dompdf();
  $html='  <html>
<title>INTERVIEW MEMO </title>
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
        margin-top:20px;

    }
       h4.abc{
page-break-before: always;
    }
  
    #adf{
position: absolute;
top: 150px;

}
   .tit{
     margin-top: -190px;
   
}
#abc{
margin-left:600px;
margin-top: -500px; 
}
td,th{
text-align: center; 
}
.neww{
margin-top: 1px; 
}

.square {
  height: 150px;
  width: 125px;
  background-color: #fff;
}
.ex1 {
  border: 1px solid black;
  outline-style: solid;
  outline-color: black;
  outline-width: thin;
}

table.staff{
font-family: TimesNewRoman, "Times New Roman";

}

pre{
font-family: TimesNewRoman, "Times New Roman";
}
tr:nth-child(even) {background-color: #f2f2f2;}

#footer {
   position:absolute;
   bottom:-15;
   width:100%;
   height:60px;
   font-size: 14px;
}
table.print-friendly tr td,table.print-friendly tr th{
 font-size: 14px;
 page-break-inside: avoid;
}
p.double {border-style: double; width: 90%;}

';

 $html.='     

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
              <div class=\"tit\">  <p class=\"box-title\" align=\'center\' style="display: flex; justify-content: center;"><b>SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</b></p>
          </div> 
          <div class=\"tit\">  <p class=\"box-title\" align=\'center\' style="display: flex; justify-content: center;"><b>INTERVIEW MEMO FOR ADMISSION</b></p>
          </div>

       
           


          

            
               </div>

      </div>





      ';






                        $html.=' <table class="staff" >';


            foreach ($chkdcD as $key) {
          
           $candregno=$key->pgapp_id;
          // $allot_cent=$key->allot_cent;
           $imgsrc="upload/".$candregno.".jpg";

     $html.='
     <tr>







    <td style="text-align:left">To,<br> <input type="hidden" name="q" >'.$key->pgapp_name.'<br>'.$key->pgapp_commaddress.' </td>
<td>Application ID:<br><br>'.$appid.'</td><td>Community:<br><br>'.$pgapp_community.'</td>
  
   
     </tr>';

     
   

}

   


$html.='
  </table><br><br>


                  <div class="headDetails" align=\'center\'>
                  <b>Interview Venue : '.$allot_cent.'</b><br>
       <b> Alloted Centre : '.$allot_cent.'</b><br>
              <b> Alloted Category : '.$allot_category.'</b><br>
                  <b> Allotment: '.$allotment.'</b><br>
                  
       
             </div><br><br>

            

           ';






















                        $html.=' <table class="staff" >

<tr>





<th>Name of the Program</th>
<th>Rank</th>

<th>Date&Time</th>
</tr>';
                        

//return $daten;

                       // return $allotment;
if($allotment=='FIRST ALLOTMENT')
{
    
    //return "gfgg";
            foreach ($chkdcD as $key)
             {
          
          

     $html.='




$daten1="10";

<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten.''.$sp.''.$sp.''.$sp.''.$time.''.$sp.'</td>
    

    
     </tr>';

     
    



}

      
}  
else if($allotment=='SECOND ALLOTMENT')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten1.''.$sp.''.$sp.''.$sp.''.$time1.''.$sp.'</td>
    

    
     </tr>';

     
    



}
       
}
else if($allotment=='THIRD ALLOTMENT')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten2.''.$sp.''.$sp.''.$sp.''.$time2.''.$sp.'</td>
    

    
     </tr>';

     
    



}
       
}
else if($allotment =='SPOT ADDMISION FROM RANKLIST')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='


<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten3.''.$sp.''.$sp.''.$sp.''.$time3.''.$sp.'</td>
    

    
     </tr>';



}
       
}
//else if($allotment =='SPECIAL ALLOTMENT')
//{
//    foreach ($chkdcD as $key)
//             {
//          
//          
//
//     $html.='
//
//
//
//
//
//
//<tr>
//<td style="text-align:left">'.$key->pgm_name.' </td>
//<td >'.$key->rank.'</td>
// 
//
//<td>'.$daten4.''.$sp.''.$sp.''.$sp.''.$time4.''.$sp.'</td>
//    
//
//    
//     </tr>';
//
//
//
//}
//       
//}
else if($allotment =='SPOT ADMISSION')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten4.''.$sp.''.$sp.''.$sp.''.$time4.''.$sp.'</td>
    

    
     </tr>';



}
       
}
//else if($allotment =='FOURTH-SEBC')
//{
//    foreach ($chkdcD as $key)
//             {
//          
//          
//
//     $html.='
//
//
//
//
//
//
//<tr>
//<td style="text-align:left">'.$key->pgm_name.' </td>
//<td >'.$key->rank.'</td>
// 
//
//<td>'.$daten3.''.$sp.''.$sp.''.$sp.''.$time3.''.$sp.'</td>
//    
//
//    
//     </tr>';
//
//
//
//}
//       
//}
else if($allotment =='SPECIAL RESERVATION')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten4.''.$sp.''.$sp.''.$sp.''.$time4.''.$sp.'</td>
    

    
     </tr>';



}
       
}
//else if($allotment =='SPECIAL-RESERVATION-ST/SC-OEC')
//{
//    foreach ($chkdcD as $key)
//             {
//          
//          
//
//     $html.='
//
//
//
//
//
//
//<tr>
//<td style="text-align:left">'.$key->pgm_name.' </td>
//<td >'.$key->rank.'</td>
// 
//
//<td>'.$daten5.''.$sp.''.$sp.''.$sp.''.$time5.''.$sp.'</td>
//    
//
//    
//     </tr>';
//
//
//
//}
//       
//}
//else if($allotment =='SPOT-ADMISSION')
//{
//    foreach ($chkdcD as $key)
//             {
//          
//          
//
//     $html.='
//
//
//
//
//
//
//<tr>
//<td style="text-align:left">'.$key->pgm_name.' </td>
//<td >'.$key->rank.'</td>
// 
//
//<td>'.$datensp.''.$sp.''.$sp.''.$sp.''.$timesp.''.$sp.'</td>
//    
//
//    
//     </tr>';
//
//
//
//}
//       
//}
//else if($allotment =='SPECIAL RESERVATION')
//{
//    foreach ($chkdcD as $key)
//             {
//          
//          
//
//     $html.='
//
//
//
//
//
//
//<tr>
//<td style="text-align:left">'.$key->pgm_name.' </td>
//<td >'.$key->rank.'</td>
// 
//
//<td>'.$datensp.''.$sp.''.$sp.''.$sp.''.$timesp.''.$sp.'</td>
//    
//
//    
//     </tr>';
//
//
//
//}
//       
//}
//else if($allotment =='SPECIAL-RESERVATION-ST/SC-OEC')
//{
//    foreach ($chkdcD as $key)
//             {
//          
//          
//
//     $html.='
//
//
//
//
//
//
//<tr>
//<td style="text-align:left">'.$key->pgm_name.' </td>
//<td >'.$key->rank.'</td>
// 
//
//<td>'.$daten5.''.$sp.''.$sp.''.$sp.''.$time5.''.$sp.'</td>
//    
//
//    
//     </tr>';
//
//
//
//}
//       
//}
else if($allotment =='CT-REQUEST')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$datect.''.$sp.''.$sp.''.$sp.''.$timect.''.$sp.'</td>
    

    
     </tr>';



}
       
}
else if($allotment =='CT')
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$datect.''.$sp.''.$sp.''.$sp.''.$timect.''.$sp.'</td>
    

    
     </tr>';



}
       
}
else 
{
    foreach ($chkdcD as $key)
             {
          
          

     $html.='






<tr>
<td style="text-align:left">'.$key->pgm_name.' </td>
<td >'.$key->rank.'</td>
 

<td>'.$daten.''.$sp.''.$sp.''.$sp.''.$time.''.$sp.'</td>
    

    
     </tr>';

     
    



}
       
}


$html.='
  </table><br><br>





<div class="headDetails" align=\'center\'>
       
            <b><u> </u></b><br>
            
             </div>


<div>

<p>   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;               The provisional rank list for the selection of candidates to various P.G Programme in Sree Sankaracharya
University of Sanskrit during this year has already been published. Now the University has decided to conduct
admission for P.G courses offered at Main Centre and Regional Centres.</p>
<p>You are hereby directed to report at the above centre at the prescribed date and time, for completing the admission
process.</p>
<u><b>The following  orginal documents are to be produced at the time of Interview</b></u><br>
  1. Interview Memo<br>
  2. SSLC Book<br>
  3. Provisional/Original degree certificate.<br>
  4. Mark List of qualifying degree examination.<br>
  5. Transfer Certificate<br>
  6. Conduct Certificate<br>
  7. Disability Certificate in the case of PhysicallyHandicapped Candidates<br>
  8. Income Certificate (In the case of OBC/OEC Candidates)<br>
  9. Caste/Community Certificate (In the case of SC/ST/OBC/OEC candidates)<br>
  10. Migration Certificates for those who studied in other Universities.<br>
  11. Eligibility certificate (applicable to those who have not undergone 10+2+3 pattern)/and those who have
   passed the Degree course from Universities outside Kerala).
 12. Candidates eligible for reservation of EWS among forward caste should produce EWS certificate
   issued by Competent Authority

   <p>*Those who have appeared for the Final year/Semester Degree Examination and not received
the Marklist/Provisional certificate must submit a declaration that they will produce the same before 31.10.2021</p>


<p>The fees to be remitted at the time of admission are mentioned below.</p>


</div>


            
            <div >
          
         
             </div>';

 $html.=' <table class="staff" border=1 >


<tr>





<th>Discription fee</th>
<th>MA</th>
<th>MA-Dance-/Theatre-/Music</th>
<th>M.Sc</th>
<th>MPES</th>
<th>MSW</th>
<th>Muse-ology</th>
<th>MFA</th>
<th>Diploma-Hindi</th>
<th>Diploma-Wellness</th>
<th>Re-marks</th>
__________
</tr>
<tr>
<td style="text-align: left">1.Admission fee</td>
<td>100</td>
<td>100</td>
<td>110</td>
<td>100</td>
<td>100</td>
<td>100</td>
<td>100</td>
<td>50</td>
<td>50</td>
<td></td>

</tr>
<tr>
<td style="text-align:left">2.Tution fee(per annum)</td>
<td>1000</td>
<td>1000</td>
<td>1100</td>
<td>20000</td>
<td>6500</td>
<td>6500</td>
<td>15000</td>
<td>1000</td>
<td>30000</td>
<td>SC/ST/OEC exempted</td>
</tr>
<tr>
<td style="text-align:left">3.Special fee(per annum)</td>
<td>800</td>
<td>1000</td>
<td>880</td>
<td>2000</td>
<td>1500</td>
<td>1500</td>
<td>2000</td>
<td>500</td>
<td>10000</td>
<td>SC/ST/OEC exempted</td>
</tr>
<tr>
<td style="text-align:left">4.Caution deposit</td>
<td>500</td>
<td>500</td>
<td>550</td>
<td>500</td>
<td>500</td>
<td>500</td>
<td>500</td>
<td>300</td>
<td>500</td>
<td></td>
</tr>
<tr>
<td style="text-align:left">5. Matriculation fee*</td>
<td>75</td>
<td>75</td>
<td>85</td>
<td>75</td>
<td>75</td>
<td>75</td>
<td>75</td>
<td>50</td>
<td>50</td>
<td></td>
</tr>
<tr>
<td style="text-align:left">6. Recognition fee**</td>
<td>100</td>
<td>100</td>
<td>110</td>
<td>100</td>
<td>100</td>
<td>100</td>
<td>100</td>
<td>100</td>
<td>100</td>
<td></td>
</tr>

<tr>
<td style="text-align:left">7. Dept. Development Fee</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td>250</td>
<td></td>
</tr>
<tr>
<td style="text-align:left">8. Exam Fee For First Semester</td>
<td>285</td>
<td>285</td>
<td>308</td>
<td>610</td>
<td>335</td>
<td>285</td>
<td>285</td>
<td>285</td>
<td>4000</td>
<td>SC/ST/OEC exempted</td>
</tr>
<tr>
<td style="text-align:left">9. Uniform Fee</td>
<td>--</td>
<td>--</td>
<td>-- </td>
<td>2500</td>
<td>--</td>
<td>--</td>
<td>--</td>
<td>--</td>
<td>--</td>
<td></td>
</tr>
<tr>
<td style="text-align:left">10. PTA</td>
<td>750</td>
<td>750</td>
<td> 750</td>
<td>750</td>
<td>750</td>
<td>750</td>
<td>750</td>
<td>750</td>
<td>750</td>
<td></td>
</tr>
<tr>
<td style="text-align:left">11. Silver Jubilee welfare fund for students</td>
<td>200</td>
<td>200</td>
<td> 200</td>
<td>200</td>
<td>200</td>
<td>200</td>
<td>200</td>
<td>200</td>
<td>200</td>
<td></td>
</tr>
';


$html.='
  </table>
 <br>
  <p>*Not applicable for candidates graduated from this University. </p>
  <p>**For candidates of other Universities outside
Kerala </p>
<br>
1 .This Memo does not ensure a seat for you in the PG Course, but provides a chance based on merit at the time of interview<br>

2. Candidates obtaining admission should also remit such amount prescribed, to the P.T.A.Fund<br>
3. Candidates who fail to bring fee or any of the original certificates mentioned above will have no claim for
admission<br>
4. Candidates who abstain from the admission in the prescribed time will have no claim for admission in future.<br>
5. Admission will be given for those who satisfy the eligibility criteria regarding the qualifying exam passed,
remittance of fee and eligibility for weightage of marks, on verification of certificates/marklists.<br>


6. For details of courses offered at the Headquarters, Kalady and Regional Centres see the prospectus.<br>
7. For more information about the University visit www.ssus.ac.in<br>
8. The Candidates shall wear a mask throughout and shall strictly adhere to COVID 19 protocol issued by
the Government of Kerala. 



  ';









 $pvc_sign="upload/digital_signature.jpg";
 $currtime=time();
 $currdate=date("d-m-Y",$currtime);

                    
            foreach ($chkdcD as $key) {
          
           $candregno=$key->pgapp_id;
           $imgsrc="upload/".$candregno.".png";
           
      $html.='
 <br>____________________________________________________________________________________<p style="text-align: left;">KALADY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sd/-</p><br>&nbsp;'.$currdate.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRO VICE CHANCELLOR ';
}





$html.='



  






 <div class="form-group" align="right">
                
            </div>
             </section>
             </body>
             <html>
             ';
       
        
 
    $dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream($candregno.".pdf");



  }

    
    
}

