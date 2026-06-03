Gmail	Reshma Ravi <reshmars12@gmail.com>
pgappcontroller
Reshma Ravi <reshmars12@gmail.com>	Thu, Oct 1, 2020 at 4:56 PM
To: Reshma Ravi <reshmars12@gmail.com>
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Validator;
use App\User;
use App\Studadmin;

use Session;
use DB;





class PgappController extends Controller
{

public function logout(Request $request)
    {
    $request->session()->forget('idApp');
    return  view('auth.home');
    }


public function sslcregr(Request $request)
    {
       


$ids=Session::get('appidnew');

$result_1 = DB::select("select * from tb_pgapp where pgapp_id=?",[$ids]);


 foreach ($result_1 as $cntr)
                    {


$sslcreg=$cntr->pgapp_register;

                    }

          return $sslcreg;

           



 }
     
public function community(Request $request)
    {
             $community = $request->input('cmty');
             $religion = $request->input('relgn');


        //relgn sl
        //comm sl
             // $result_1 = DB::select("select * from tb_caste where caste_relgn_sl=? and caste_comm_sl=?",[$religion,$community]);



$result_1=DB::select("select subcaste,id from tbz_reservation_list where community=? AND religion=? ORDER BY subcaste",[$community,$religion]);


            $htmlcent = "<class=\"col-sm-4\" id=\"castediv\" name=\"castediv\">
            <select  id= \"pgapp_caste_sl\" name=\"pgapp_caste_sl\" >
            <option value=\"\" >
                      --Select--
            </option>";
                foreach ($result_1 as $cntr)
                    {
                        $htmlcent .= "<option value=\"" . $cntr->id . "\" class=\"col-md-12\">" . $cntr->subcaste . "</option>";
                    }
                        $htmlcent .= "</select></div>";
//      dd($html);
                        return $htmlcent;
         
    }


//subcaste



public function subcaste(Request $request)
    {
             $caste = $request->input('caste');


             $religion = $request->input('relgn');
//$caste='21';

//$religion='1';


        //relgn sl
        //comm sl
             $result_1 = DB::select("select * from tb_subcaste where subc_caste_sl=? and subc_relgn_sl=?",[$caste,$religion]);


            $htmlcent = "<class=\"col-sm-4\" id=\"subcastediv\" name=\"subcastediv\">
 <select  id= \"pgapp_subcaste_sl\" name=\"pgapp_subcaste_sl \">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($result_1 as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->subc_sl . "\" class=\"col-md-12\">" . $cntr->subc_name . "</option>";
        }
       $htmlcent .= "</select></div>";
       
//         dd($html);
         return $htmlcent;
         
    }
















//view academic
     public function personal(Request $request)
     {


$ids=Session::get('appidnew');
  $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }

       $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);

        $result_count_course = DB::select("select *  from tb_pgapp where pgapp_id=? ",[$ids]);

  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);

      $entireTableMainsub=DB::select('select * from tb_degqualisub');
     $entireTableQualcourse=DB::select('select * from tb_degquali');
      return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
         // return "Personal Page";
     }

     //view upload
      public function academic(Request $request)
     {

return view('auth.upload');
       
        // return view('auth.academic');
     }

      public function newupload(Request $request)
     {

return view('auth.upload');
       
        // return view('auth.academic');
     }

     
     //save and display options
//            public function savephoto_old(Request $request)
//      {
         
//                $flag=0;
//        $ids=Session::get('appidnew');  


//      $forsubject = DB::select("select *  from tb_pgapp where  pgapp_id=?",[$ids]);


//                foreach($forsubject as $key)

//            {
// $subsl=$key->pgapp_pgmsl;

//            }



// $pgmname = DB::select("select *  from tb_program where  pgm_sl=?",[$subsl]);



//                foreach($pgmname as $key)

//            {
// $progm_name=$key->pgm_name;

//            }



//      $entireTable = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);

//                foreach($entireTable as $key)

//            {
// $pgstream_name=$key->pgstream_name;

//            }
         
//            if($pgstream_name=="M.PEd")
               
               
//            {
               
//                 $flag=1;
//                $idsd='154';
//                $result = DB::select("select *  from tb_program where pgm_sl=?",[$idsd]);
               
// //               $cent=DB::select("select * from tb_centre  where centre_sl='23'");
               
//            }

           
//              if($pgstream_name=="M.A")
               
               
//            {
                 
//                   $flag=3;
// //               $idsd='85';
//                $result = DB::select("select *  from tb_program where pgm_sl IN(109,110,113,111,133,106,114,115,118,120,180,123)");
               
// //               $cent=DB::select("select * from tb_centre  where centre_sl IN(23,15,21,22)");
               
//            }
     
//       if($pgstream_name=="M.S.W")
               
               
//            {
//            $flag=3;
//                $idsd='85';
//               $result = DB::select("select *  from tb_program where pgm_sl=?",[$idsd]);
               
// //               $cent=DB::select("select * from tb_centre  where centre_sl IN(23,15,21,22)");
               
//            }

//              if($pgstream_name=="M.Sc")
               
               
//            {
//                   $flag=2;
//                $idsd='201';
//                $result = DB::select("select *  from tb_program where pgm_sl IN(201,200)");
               
// //               $cent=DB::select("select * from tb_centre  where centre_sl IN(23)");
               
//            }
           
//              if($pgstream_name=="MFA")
               
               
//            {
                 
//                   $flag=1;
//                $idsd='202';
//                $result = DB::select("select *  from tb_program where pgm_sl IN(202)");
               
// //               $cent=DB::select("select * from tb_centre  where centre_sl IN(23)");
               
//            }
 
//       $result_photo = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);  
     
//                      foreach($result_photo as $keyph)

//            {
// $resultnew_photo=$keyph->pgapp_photo;

//            }
     

//        if($resultnew_photo=="")  
           
//        {
           
//          echo '<script> alert("please upload your photo")</script>';
//              // return view('auth.option',compact('entireTable','result','flag'));


     
//            return view('auth.upload') ;
//        }
       
//  else {
     
//       Session::put('flagsession',$flag);
//          return view('auth.option',compact('entireTable','result','flag','progm_name'));  
//        }
 
 
//      }



//by step by step to option
      public function savephoto(Request $request)
     {
         

               $flag=0;
       $ids=Session::get('appidnew');  

       
$entarnce_center=DB::select("select * from tb_centre");

     $forsubject = DB::select("select *  from tb_pgapp where  pgapp_id=?",[$ids]);


               foreach($forsubject as $key)

           {
$subsl=$key->pgapp_pgmsl;

           }





$pgmname = DB::select("select *  from tb_program where  pgm_sl=?",[$subsl]);



               foreach($pgmname as $key)

           {
$progm_name=$key->pgm_name;


           }



     $entireTable = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);

               foreach($entireTable as $key)

           {
$pgstream_name=$key->pgstream_name;

           }







//new   APRIL


 if($subsl=='123')
 {

  $center_sl1=20;
  $opt1=1;
  $center_entrance=20;
      $option11= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$subsl,$center_sl1,$opt1,$center_entrance]);

      $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);






     $paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {

$suslnew=$key->pgapp_pgmsl;
$pgapp_stream_id=$key->pgapp_stream_id;
$pgapp_community=$key->pgapp_community;



//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }

             if($pgapp_stream_id==2 OR $pgapp_stream_id==6)

            {

$normalfee=500;

$scstfee=200;


if($pgapp_community=="SC")

{

$fee=500;
}

else if($pgapp_community=="ST")

{

$fee=200;
}


else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}



else
{
$fee=500;
}



            }
           

//bbbbbbbbbbbbbbbbbbbbb


else if ($suslnew=='280')


{


$normalfee=500;

$scstfee=200;


if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}


else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}



else
{
$fee=500;
}








}




//bbbbbbbbbbbbbbbbbbbbbbb









            else


            {

$normalfee=500;

$scstfee=200;






if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}

else if($pgapp_community=="ST-MUSLIM")

{

$fee=20;
}





else
{
$fee=500;
}








            }
           $resultnnnn = DB::select("select *  from tb_program where pgm_sl=?",[$suslnew]);

                   //dd($entireTable);
         foreach ($resultnnnn as $keyh)
             {

$pgmnmew=$keyh->pgm_name;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }  




         
   
       
       
       
        //newwww start
       
$paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {

            //  $suslnew=$key->pgapp_pgmsl;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }
           
             
         
   
              $resultfee = DB::select('select * from tbz_candidate_fee  where cndfee_cndappln_no=? ',[$ids]);
       
       
        //newwwww end
       
       
       
       
       
       
       
       
       
       
// $paymentview=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);
 $paymentview = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);

                               


   return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','normalfee','scstfee','fee'));







}


 if($subsl=='123')  //124
 {

  $center_sl1=20; //21
  $opt1=1;
  $center_entrance=20; //21
      $option11= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$subsl,$center_sl1,$opt1,$center_entrance]);

      $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);






     $paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {

$suslnew=$key->pgapp_pgmsl;
$pgapp_stream_id=$key->pgapp_stream_id;
$pgapp_community=$key->pgapp_community;



//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }

             if($pgapp_stream_id==2 OR $pgapp_stream_id==6)

            {

$normalfee=300;

$scstfee=100;


if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}


else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}



else
{
$fee=300;
}



            }
           

//bbbbbbbbbbbbbbbbbbbbb


else if ($suslnew=='280')


{


$normalfee=500;

$scstfee=200;


if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}


else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}



else
{
$fee=500;
}








}




//bbbbbbbbbbbbbbbbbbbbbbb









            else


            {

$normalfee=500;

$scstfee=200;






if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}

else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}





else
{
$fee=500;
}








            }
           $resultnnnn = DB::select("select *  from tb_program where pgm_sl=?",[$suslnew]);

                   //dd($entireTable);
         foreach ($resultnnnn as $keyh)
             {

$pgmnmew=$keyh->pgm_name;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }  




         
   
       
       
       
        //newwww start
       
$paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {

            //  $suslnew=$key->pgapp_pgmsl;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }
           
             
         
   
              $resultfee = DB::select('select * from tbz_candidate_fee  where cndfee_cndappln_no=? ',[$ids]);
       
       
        //newwwww end
       
       
       
       
       
       
       
       
       
       
// $paymentview=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);
 $paymentview = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);

                               


   return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','normalfee','scstfee','fee'));







}

//new APRIL  ENDDDDDDDDD





           
 $result = DB::select("select *  from tb_program ");

 if($pgstream_name=="P.G.Diploma")
               
               
           {
               
                $flag=1;
               $idsd='154';
               $result = DB::select("select *  from tb_program where pgm_sl IN(280,86)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23,16)");


$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}












               
           }

           if($pgstream_name=="M.PEd")
               
               
           {
               
                $flag=1;
               $idsd='154';
               $result = DB::select("select *  from tb_program where pgm_sl=?",[$idsd]);
               
              $cent=DB::select("select * from tb_centre  where centre_sl='23'");


$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}












               
           }

         
             if($pgstream_name=="M.A.")
               
               
           {


$flag=3;


$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}













                 
                 
//               $idsd='85';
               $result = DB::select("select *  from tb_program where pgm_sl IN(109,110,113,111,133,106,114,115,118,120,180,123)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23,15,21,22)");
               
           }
   
      if($pgstream_name=="M.S.W")
               
               
           {
           $flag=3;
               $idsd='85';
              $result = DB::select("select *  from tb_program where pgm_sl=?",[$idsd]);
             
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23,15,21,22)");




$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}












               
           }

             if($pgstream_name=="M.Sc")
               
               
           {
                  $flag=1; //aadyam 2 aarnnu
               $idsd='201';
               $result = DB::select("select *  from tb_program where pgm_sl IN(201,200)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23)");




$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}















               
           }
           
             if($pgstream_name=="MFA")
               
               
           {
                 
                  $flag=1;
               $idsd='202';
               $result = DB::select("select *  from tb_program where pgm_sl IN(202)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23)");




$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}
       
           }

$yr=2020;
$result_cent =DB::SELECT(
  "SELECT tb_centre.centre_sl,tb_centre.centre_name
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?  AND tb_admnscheme.adsc_admnyear=?",[$subsl,$yr]);















$count_centr=count($result_cent);

if(($count_centr)>2)

{

$flags=3;

}

else if(($count_centr)==2)

{
$flags=2;
}

else

{
$flags=1;

}















 
      $result_photo = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);  
     
                     foreach($result_photo as $keyph)

           {
$resultnew_photo=$keyph->pgapp_photo;

           }
     
       if($resultnew_photo=="")  
           
       {
           
         echo '<script> alert("please upload your photo")</script>';
             
           return view('auth.upload') ;
       }
       
 else {
     
      Session::put('flagsession',$flag);
         return view('auth.option',compact('entireTable','result','flag','progm_name','entarnce_center','cent','entireTable_centre','result_cent','flags'));  
       }
 
 
     }
     
     
        //option1
        public function sub1cent(Request $request)
     {
         $yr='2020'   ;
//    return"hhjjh"    ;
             $data = $request->input('formData');
//  
         //end old
//          return  $data;
// //start old SELECT DISTINCT(tb_centre.centre_sl,tb_centre.centre_name)
      $result_1 =DB::SELECT(
  "SELECT tb_centre.centre_sl,tb_centre.centre_name
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?  AND tb_admnscheme.adsc_admnyear=?",[$data,$yr]);
 
            $htmlcent = "<class=\"col-sm-4\" id=\"cdiv1\" name=\"cdiv1\">
 <select  id= \"center_sl1\" name=\"center_sl1 \">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
           
       foreach ($result_1 as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent .= "</select></div>";
       
     
         return $htmlcent;
       


     }
     //option2
          public function sub2cent(Request $request)
     {
         $yr='2020'   ;
//    return"hhjjh"    ;
             $data = $request->input('formData');
//  
         //end old
//          return  $data;
// //start old SELECT DISTINCT(tb_centre.centre_sl,tb_centre.centre_name)
      $result_1 =DB::SELECT(
  "SELECT tb_centre.centre_sl,tb_centre.centre_name
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?  AND tb_admnscheme.adsc_admnyear=?",[$data,$yr]);
 
            $htmlcent = "<class=\"col-sm-4\" id=\"cdiv2\" name=\"cdiv2\">
 <select  id= \"center_sl2\" name=\"center_sl2 \">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
           
       foreach ($result_1 as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent .= "</select></div>";
       
     
         return $htmlcent;



     }
     
     // option 3
          public function sub3cent(Request $request)
     {
         $yr='2020'   ;
//    return"hhjjh"    ;
             $data = $request->input('formData');
//  
         //end old
//          return  $data;
// //start old SELECT DISTINCT(tb_centre.centre_sl,tb_centre.centre_name)
      $result_1 =DB::SELECT(
  "SELECT tb_centre.centre_sl,tb_centre.centre_name
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?  AND tb_admnscheme.adsc_admnyear=?",[$data,$yr]);
 
            $htmlcent = "<class=\"col-sm-4\" id=\"cdiv3\" name=\"cdiv3\">
 <select  id= \"center_sl3\" name=\"center_sl3 \">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
           
       foreach ($result_1 as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent .= "</select></div>";
       
     
         return $htmlcent;
         //end old


     }
     
     //call option
   
        public function upload(Request $request)
     {




                       $flag=0;
       $ids=Session::get('appidnew');  
$entarnce_center=DB::select("select * from tb_centre");
     $entireTable = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);





     $forsubject = DB::select("select *  from tb_pgapp where  pgapp_id=?",[$ids]);


               foreach($forsubject as $key)

           {
$subsl=$key->pgapp_pgmsl;

           }



$pgmname = DB::select("select *  from tb_program where  pgm_sl=?",[$subsl]);



               foreach($pgmname as $key)

           {
$progm_name=$key->pgm_name;

           }







               foreach($entireTable as $key)

           {
$pgstream_name=$key->pgstream_name;

           }



$result = DB::select("select *  from tb_program ");


if($pgstream_name=="P.G.Diploma")
               
               
           {
               
                $flag=1;
               $idsd='154';
               $result = DB::select("select *  from tb_program where pgm_sl IN(280,86)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23,16)");


$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}





               
           }





           
           if($pgstream_name=="M.PEd")
               
               
           {
               
                $flag=1;
               $idsd='154';
               $result = DB::select("select *  from tb_program where pgm_sl=?",[$idsd]);
               
              $cent=DB::select("select * from tb_centre  where centre_sl='23'");



$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}



















               
           }

           
             if($pgstream_name=="M.A.")
               
               
           {
                 
                 









$flag=3;


$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}
























//               $idsd='85';
               $result = DB::select("select *  from tb_program where pgm_sl IN(109,110,113,111,133,106,114,115,118,120,180,123)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23,15,21,22)");
               
           }
     
      if($pgstream_name=="M.S.W")
               
               
           {
           $flag=3;
               $idsd='85';
              $result = DB::select("select *  from tb_program where pgm_sl=?",[$idsd]);
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23,15,21,22)");




$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}











               
           }

             if($pgstream_name=="M.Sc")
               
               
           {
                  $flag=2;
               $idsd='201';
               $result = DB::select("select *  from tb_program where pgm_sl IN(201,200)");
               
               $cent=DB::select("select * from tb_centre  where centre_sl IN(23)");





$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}














               
           }
           
             if($pgstream_name=="MFA")
               
               
           {
                 
                  $flag=1;
               $idsd='202';
               $result = DB::select("select *  from tb_program where pgm_sl IN(202)");
               
              $cent=DB::select("select * from tb_centre  where centre_sl IN(23)");



$entireTable_centre = DB::select("SELECT
  DISTINCT(tb_centre.centre_name)
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?",[$subsl]);

$count_cent=count($entireTable_centre);

if(($count_cent)>2)

{

$flag=3;

}

else if(($count_cent)==2)

{
$flag=3;
}

else

{
$flag=1;

}














               
           }







// $yr=2019;
// $result_cent =DB::SELECT(
//   "SELECT tb_centre.centre_sl,tb_centre.centre_name
// FROM
//   public.tb_admncentre,
//   public.tb_admnscheme,
//   public.tb_centre,
//   public.tb_program
// WHERE
//   tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
//   tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
//   tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?  AND tb_admnscheme.adsc_admnyear=?",[$subsl,$yr]);




$yr=2020;
$result_cent =DB::SELECT(
  "SELECT tb_centre.centre_sl,tb_centre.centre_name
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl=?  AND tb_admnscheme.adsc_admnyear=? AND tb_centre.centre_sl NOT IN(17)",[$subsl,$yr]);




$count_centr=count($result_cent);

if(($count_centr)>2)

{

$flags=3;

}

else if(($count_centr)==2)

{
$flags=3;
}

else

{
$flags=1;

}








     Session::put('flagsession',$flag);
 return view('auth.option',compact('entireTable','result','flag','progm_name','entarnce_center','cent','entireTable_centre','result_cent','flags'));
       
//return view('auth.option');

     }
//relign dropdown
public function religion(Request $request)
    {
   
 $data = $request->input('formData');


 //  if($data==1)
 // {
 //          $result_1 = DB::select("select comm_sl,comm_name from tb_community where comm_sl in (10,11,17,9,25,26,27,28,22,12)");
 //      }
 //       if($data==4)
 // {
 //          $result_1 = DB::select("select comm_sl,comm_name from tb_community where comm_sl in (18,30)");
 //      }
 //      if($data==5)
 // {
 //          $result_1 = DB::select("select comm_sl,comm_name from tb_community where comm_sl in (21,29,19)");
 //      }
 //           if($data==23)
 // {
 //          $result_1 = DB::select("select comm_sl,comm_name from tb_community where comm_sl in (0)");
 //      }
 //                   if($data==24)
 // {
 //          $result_1 = DB::select("select comm_sl,comm_name from tb_community where comm_sl in (0)");
 //      }


$result_1=DB::select("select DISTINCT(community) from tbz_reservation_list where religion=?",[$data]);

            $htmlcent = "<class=\"col-sm-4\" id=\"commdiv\" name=\"commdiv\">
 <select  id= \"pgapp_comm_sl\" name=\"pgapp_comm_sl\"onchange=\"commchange()\">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($result_1 as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->community . "\" class=\"col-md-12\">" . $cntr->community . "</option>";
        }
       $htmlcent .= "</select></div>";
       
//         dd($html);
         return $htmlcent;
}
//personal save
  public function tab1_save(Request $request)
    {

//pgapp_adhar hidden

       $data=$request->all();


$ids=$request->input('pgapp_appidhidden');



 



$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }


         $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


//newwwww
     
         $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);



           foreach($result_count as $key)

           {
$varsl=$key->pgapp_sl;

           }


           $entireTableMainsub=DB::select('select * from tb_degqualisub');
 
   $entireTableQualcourse=DB::select('select * from tb_degquali');
 
 





 
    $pgapp_wh_special_reserv=$request->input('pgapp_wh_special_reserv');
   

    $pgapp_bplval=$request->input('pgapp_bplval');

    $pgapp_artsval=$request->input('pgapp_artsval');


    $pgapp_sportsval=$request->input('pgapp_sportsval');

   $pgapp_nssval=$request->input('pgapp_nssval');  

$pgapp_nccval=$request->input('pgapp_nccval');  

$pgapp_blindval=$request->input('pgapp_blindval');

$pgapp_differentialval=$request->input('pgapp_differentialval');

$pgapp_whether_reserv=$request->input('pgapp_whether_reserv');

$pgapp_wh_special_reserv_val=$request->input('pgapp_wh_special_reserv');


        $pgapp_gender_sl=$request->input('pgapp_gender_sl');



        $pgapp_nationality=$request->input('pgapp_nationality');

        $pgapp_relgn_sl=$request->input('pgapp_relgn_sl');

        $pgapp_caste_sl=$request->input('pgapp_caste_sl');

        $pgapp_comm_sl=$request->input('pgapp_comm_sl');

       $pgapp_commaddress=$request->input('pgapp_commaddress');

        $pgapp_permaddress=$request->input('pgapp_permaddress');

        $pgapp_father=$request->input('pgapp_father');

        $pgapp_occp=$request->input('pgapp_occp');

        $pgapp_inc_sl=$request->input('pgapp_inc_sl');


      $pgapp_subcaste_sl=$request->input('pgapp_subcaste_sl');


//pgapp_gender_sl=2&pgapp_nationality=Australian&pgapp_relgn_sl=BHUDDHA&pgapp_comm_sl%20=BHUDDHA&pgapp_caste_sl%20=544&pgapp_subcaste_sl=&pgapp_whether_reserv=no&pgapp_wh_special_reserv=yes&pgapp_differential=2&pgapp_differentialval=1&pgapp_blind=2&pgapp_blindval=1&pgapp_nccval=2&pgapp_nssval=2&pgapp_sportsval=2&pgapp_artsval=2&pgapp_bplval=2&pgapp_commaddress=q&pgapp_permaddress=q&pgapp_father=q&pgapp_occp=q&pgapp_inc_sl=48"




     $st=1;
   
     $upd = DB::update('update tb_pgapp set pgapp_bpl=?,pgapp_arts=?,pgapp_sports=?, pgapp_nss=?,pgapp_ncc=?, pgapp_blind=?, pgapp_differential=?,pgapp_whether_reserv=?,pgapp_gender_sl=?,pgapp_nationality=?,pgapp_religion=?,pgapp_caste=?,pgapp_community=?,pgapp_commaddress=?,pgapp_permaddress=?,pgapp_father=?,pgapp_occp=?,pgapp_inc_sl=? , pgapp_wh_special_reserv=? where pgapp_sl=?',[$pgapp_bplval,$pgapp_artsval,$pgapp_sportsval,$pgapp_nssval,$pgapp_nccval,$pgapp_blindval,$pgapp_differentialval,$pgapp_whether_reserv,$pgapp_gender_sl,$pgapp_nationality,$pgapp_relgn_sl,$pgapp_caste_sl,$pgapp_comm_sl,$pgapp_commaddress,$pgapp_permaddress,$pgapp_father,$pgapp_occp,$pgapp_inc_sl,$pgapp_wh_special_reserv_val,$varsl]);





    $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);

     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);
 
   //$entireTableQualcourse=DB::select('select * from tb_degquali');
 
 
 


     if($upd==1)

     {


    $result = DB::update('update tb_pgapp set app_status=? where pgapp_sl=?',[$st,$varsl]);
echo '<script> alert("Your personal details saved succesfully")</script>';
    return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));

}



   }




public function tab1_save_oldn(Request $request)
    {



       $data=$request->all();





 

 $idsold=Session::get('idApp');
 
$ids=Session::get('appidnew');


$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }


         $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


//newwwww
     
         $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);



           foreach($result_count as $key)

           {
$varsl=$key->pgapp_sl;

           }


           $entireTableMainsub=DB::select('select * from tb_degqualisub');
 
   $entireTableQualcourse=DB::select('select * from tb_degquali');
 
 



 
    $pgapp_wh_special_reserv=$request->input('pgapp_wh_special_reserv');
   

    $pgapp_bplval=$request->input('pgapp_bplval');

    $pgapp_artsval=$request->input('pgapp_artsval');


    $pgapp_sportsval=$request->input('pgapp_sportsval');

   $pgapp_nssval=$request->input('pgapp_nssval');  

$pgapp_nccval=$request->input('pgapp_nccval');  

$pgapp_blindval=$request->input('pgapp_blindval');

$pgapp_differentialval=$request->input('pgapp_differentialval');

$pgapp_whether_reserv=$request->input('pgapp_whether_reserv');

$pgapp_wh_special_reserv_val=$request->input('pgapp_wh_special_reserv');


        $pgapp_gender_sl=$request->input('pgapp_gender_sl');



        $pgapp_nationality=$request->input('pgapp_nationality');

        $pgapp_relgn_sl=$request->input('pgapp_relgn_sl');

        $pgapp_caste_sl=$request->input('pgapp_caste_sl');

        $pgapp_comm_sl=$request->input('pgapp_comm_sl');

       $pgapp_commaddress=$request->input('pgapp_commaddress');

        $pgapp_permaddress=$request->input('pgapp_permaddress');

        $pgapp_father=$request->input('pgapp_father');

        $pgapp_occp=$request->input('pgapp_occp');

        $pgapp_inc_sl=$request->input('pgapp_inc_sl');


      $pgapp_subcaste_sl=$request->input('pgapp_subcaste_sl');


//pgapp_gender_sl=2&pgapp_nationality=Australian&pgapp_relgn_sl=BHUDDHA&pgapp_comm_sl%20=BHUDDHA&pgapp_caste_sl%20=544&pgapp_subcaste_sl=&pgapp_whether_reserv=no&pgapp_wh_special_reserv=yes&pgapp_differential=2&pgapp_differentialval=1&pgapp_blind=2&pgapp_blindval=1&pgapp_nccval=2&pgapp_nssval=2&pgapp_sportsval=2&pgapp_artsval=2&pgapp_bplval=2&pgapp_commaddress=q&pgapp_permaddress=q&pgapp_father=q&pgapp_occp=q&pgapp_inc_sl=48"




     $st=1;
   
     $upd = DB::update('update tb_pgapp set pgapp_bpl=?,pgapp_arts=?,pgapp_sports=?, pgapp_nss=?,pgapp_ncc=?, pgapp_blind=?, pgapp_differential=?,pgapp_whether_reserv=?,pgapp_gender_sl=?,pgapp_nationality=?,pgapp_religion=?,pgapp_caste=?,pgapp_community=?,pgapp_commaddress=?,pgapp_permaddress=?,pgapp_father=?,pgapp_occp=?,pgapp_inc_sl=? , pgapp_wh_special_reserv=? where pgapp_sl=?',[$pgapp_bplval,$pgapp_artsval,$pgapp_sportsval,$pgapp_nssval,$pgapp_nccval,$pgapp_blindval,$pgapp_differentialval,$pgapp_whether_reserv,$pgapp_gender_sl,$pgapp_nationality,$pgapp_relgn_sl,$pgapp_caste_sl,$pgapp_comm_sl,$pgapp_commaddress,$pgapp_permaddress,$pgapp_father,$pgapp_occp,$pgapp_inc_sl,$pgapp_wh_special_reserv_val,$varsl]);


   echo "update tb_pgapp set pgapp_bpl=?,pgapp_arts=?,pgapp_sports=?, pgapp_nss=?,pgapp_ncc=?, pgapp_blind=?, pgapp_differential=?,pgapp_whether_reserv=?,pgapp_gender_sl=?,pgapp_nationality=?,pgapp_religion=?,pgapp_caste=?,pgapp_community=?,pgapp_commaddress=?,pgapp_permaddress=?,pgapp_father=?,pgapp_occp=?,pgapp_inc_sl=? , pgapp_wh_special_reserv=? where pgapp_sl=?',[$pgapp_bplval,$pgapp_artsval,$pgapp_sportsval,$pgapp_nssval,$pgapp_nccval,$pgapp_blindval,$pgapp_differentialval,$pgapp_whether_reserv,$pgapp_gender_sl,$pgapp_nationality,$pgapp_relgn_sl,$pgapp_caste_sl,$pgapp_comm_sl,$pgapp_commaddress,$pgapp_permaddress,$pgapp_father,$pgapp_occp,$pgapp_inc_sl,$pgapp_wh_special_reserv_val,$varsl]";


 return ;





    $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);

     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);
 
   //$entireTableQualcourse=DB::select('select * from tb_degquali');
 
 
 


     if($upd==1)

     {


    $result = DB::update('update tb_pgapp set app_status=? where pgapp_sl=?',[$st,$varsl]);
echo '<script> alert("Your personal details saved succesfully")</script>';
    return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));

}



   }












// academic exam details
public function tab2_save_new(Request $request)
    {



                    $idsold=Session::get('idApp');
                    $ids=Session::get('appidnew');

$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }

                    $entireTableMainsub=DB::select('select * from tb_degqualisub');
                    $entireTableQualcourse=DB::select('select * from tb_degquali');
                    $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


                      $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);


   // dd($result_count);
                    foreach($result_count as $key)
                            {
                               $varsl=$key->pgapp_sl;
                            }

//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

        $pgquali_exam1=$request->input('pgquali_exam');
//        return $pgquali_exam1;
        $pgquali_subject1=$request->input('pgquali_subject');
        $pgquali_university1=$request->input('pgquali_university');
        $pgquali_register1=$request->input('pgquali_register');

        $pgquali_year1=$request->input('pgquali_year');
        $pgquali_grade1=$request->input('pgquali_grade');
        $pgquali_mark1=$request->input('pgquali_mark');
       
        $result_countadd = DB::select("select *  from tb_pg_pgquali where pgquali_exam=? AND pgquali_pgapp_id=?",[$pgquali_exam1,$ids]);

$result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);



       $result_countnew = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



                    foreach($result_countnew_course as $key)
                             {
                             $pgapp_degq_sl=$key->pgapp_degq_sl;
                             $pgapp_college=$key->pgapp_college;
                             $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
                             }

         
                          if(count($result_countadd) >0)
                         {
                             
//              
             
               // echo'<script>alert("Already add the same ")</script>';
return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
             return "Already entered details of ".$pgquali_exam1;
          }
       
 else {
     
 
     
     
     
     $zer=0;
     
     $sqlpgquali1 = DB::insert('insert into tb_pg_pgquali(pgquali_pgapp_id,pgquali_exam,pgquali_subject,pgquali_university,pgquali_register,pgquali_year,pgquali_grade,pgquali_mark,pgquali_status) VALUES (?,?,?,?,?,?,?,?,?)',[$ids,$pgquali_exam1,$pgquali_subject1,$pgquali_university1,$pgquali_register1,$pgquali_year1,$pgquali_grade1,$pgquali_mark1,$zer]);
            $result_countt = DB::select("select *  from tb_pg_pgquali where  pgquali_pgapp_id=?",[$ids]);
  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);

         if(count($result_countt) >2 AND  ($pgapp_degq_sl!=""))
      {
             
              $st=2;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_sl=?',[$st,$varsl]);
       
          echo'<script>alert("Succesfully Added ")</script>';
          // return view('auth.upload');

           return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
      }
     
 else {
         // echo'<script>alert("Please fill up the remaining ")</script>';

      echo'<script>location.reload();</script>';
return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
 
      }

 }
   
 



    }

public function nextpge_upload(Request $request)



    {


 $ids=Session::get('appidnew');

               $load_upload = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);

 $load_uploadnew = DB::select("select *  from tb_pgapp where pgapp_id=? ",[$ids]);

 foreach($load_uploadnew as $key)
                             {
                             $pgapp_degq_sl=$key->pgapp_degq_sl;
                             $pgapp_college=$key->pgapp_college;
                             $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
                             }









               if(count($load_upload)>2 )

               {


if($pgapp_degq_sl!="")
{
               
return "100";

}

}


else


{
return "1000";

}

    }


public function tab2_save_new_sslc(Request $request)
    {



                    $ids=Session::get('appidnew');


//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

        $pgquali_exam1=$request->input('pgquali_exam_1');
//        return $pgquali_exam1;
        $pgquali_subject1=$request->input('pgquali_subject_1');
        $pgquali_university1=$request->input('pgquali_university_1');
        $pgquali_register1=$request->input('pgquali_register_1');

        $pgquali_year1=$request->input('pgquali_year_1');
        $pgquali_grade1=$request->input('pgquali_grade_1');
        $pgquali_mark1=$request->input('pgquali_mark_1');
       
       





        //pgquali_pgapp_id,pgquali_exam,  $ids,$pgquali_exam1,

     
     $sqlpgquali1 = DB::update('update  tb_pg_pgquali set pgquali_subject=?,pgquali_university=?,pgquali_register=?,pgquali_year=?,pgquali_grade=?,pgquali_mark=? where pgquali_pgapp_id=? AND pgquali_exam=?',[$pgquali_subject1,$pgquali_university1,$pgquali_register1,$pgquali_year1,$pgquali_grade1,$pgquali_mark1,$ids,$pgquali_exam1]);






$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }

                    $entireTableMainsub=DB::select('select * from tb_degqualisub');
                    $entireTableQualcourse=DB::select('select * from tb_degquali');
                    $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


                      $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);


   // dd($result_count);
                    foreach($result_count as $key)
                            {
                               $varsl=$key->pgapp_sl;
                            }

//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

 
       
        $result_countadd = DB::select("select *  from tb_pg_pgquali where pgquali_exam=? AND pgquali_pgapp_id=?",[$pgquali_exam1,$ids]);

$result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);



       $result_countnew = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



                    foreach($result_countnew_course as $key)
                             {
                             $pgapp_degq_sl=$key->pgapp_degq_sl;
                             $pgapp_college=$key->pgapp_college;
                             $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
                             }

     
 
     
     
 
     

            $result_countt = DB::select("select *  from tb_pg_pgquali where  pgquali_pgapp_id=?",[$ids]);
  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


         // echo'<script>alert("Please fill up the remaining ")</script>';

return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
 
     






    }





// plustwo edit

public function tab2_save_new_hse(Request $request)
    {



                    $ids=Session::get('appidnew');


//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

        $pgquali_exam1=$request->input('pgquali_exam_2');
//        return $pgquali_exam1;
        $pgquali_subject1=$request->input('pgquali_subject_2');
        $pgquali_university1=$request->input('pgquali_university_2');
        $pgquali_register1=$request->input('pgquali_register_2');

        $pgquali_year1=$request->input('pgquali_year_2');
        $pgquali_grade1=$request->input('pgquali_grade_2');
        $pgquali_mark1=$request->input('pgquali_mark_2');
       
       





        //pgquali_pgapp_id,pgquali_exam,  $ids,$pgquali_exam1,

     
     $sqlpgquali1 = DB::update('update  tb_pg_pgquali set pgquali_subject=?,pgquali_university=?,pgquali_register=?,pgquali_year=?,pgquali_grade=?,pgquali_mark=? where pgquali_pgapp_id=? AND pgquali_exam=?',[$pgquali_subject1,$pgquali_university1,$pgquali_register1,$pgquali_year1,$pgquali_grade1,$pgquali_mark1,$ids,$pgquali_exam1]);






$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }

                    $entireTableMainsub=DB::select('select * from tb_degqualisub');
                    $entireTableQualcourse=DB::select('select * from tb_degquali');
                    $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


                      $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);


   // dd($result_count);
                    foreach($result_count as $key)
                            {
                               $varsl=$key->pgapp_sl;
                            }

//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

 
       
        $result_countadd = DB::select("select *  from tb_pg_pgquali where pgquali_exam=? AND pgquali_pgapp_id=?",[$pgquali_exam1,$ids]);

$result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);



       $result_countnew = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



                    foreach($result_countnew_course as $key)
                             {
                             $pgapp_degq_sl=$key->pgapp_degq_sl;
                             $pgapp_college=$key->pgapp_college;
                             $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
                             }

     
 
     
     
 
     

            $result_countt = DB::select("select *  from tb_pg_pgquali where  pgquali_pgapp_id=?",[$ids]);
  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


         // echo'<script>alert("Please fill up the remaining ")</script>';

return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
 
     






    }




    //plustwo edit   end




//degree edit



public function tab2_save_new_degree(Request $request)
    {



                    $ids=Session::get('appidnew');


//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

        $pgquali_exam1=$request->input('pgquali_exam_3');
//        return $pgquali_exam1;
        $pgquali_subject1=$request->input('pgquali_subject_3');
        $pgquali_university1=$request->input('pgquali_university_3');
        $pgquali_register1=$request->input('pgquali_register_3');

        $pgquali_year1=$request->input('pgquali_year_3');
        $pgquali_grade1=$request->input('pgquali_grade_3');
        $pgquali_mark1=$request->input('pgquali_mark_3');
       
       





        //pgquali_pgapp_id,pgquali_exam,  $ids,$pgquali_exam1,

     
     $sqlpgquali1 = DB::update('update  tb_pg_pgquali set pgquali_subject=?,pgquali_university=?,pgquali_register=?,pgquali_year=?,pgquali_grade=?,pgquali_mark=? where pgquali_pgapp_id=? AND pgquali_exam=?',[$pgquali_subject1,$pgquali_university1,$pgquali_register1,$pgquali_year1,$pgquali_grade1,$pgquali_mark1,$ids,$pgquali_exam1]);






$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }

                    $entireTableMainsub=DB::select('select * from tb_degqualisub');
                    $entireTableQualcourse=DB::select('select * from tb_degquali');
                    $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


                      $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);


   // dd($result_count);
                    foreach($result_count as $key)
                            {
                               $varsl=$key->pgapp_sl;
                            }

//sslc
                    $data=$request->all();
       
//      dd($data)   ;
     
     

 
       
        $result_countadd = DB::select("select *  from tb_pg_pgquali where pgquali_exam=? AND pgquali_pgapp_id=?",[$pgquali_exam1,$ids]);

$result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);



       $result_countnew = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
       $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



                    foreach($result_countnew_course as $key)
                             {
                             $pgapp_degq_sl=$key->pgapp_degq_sl;
                             $pgapp_college=$key->pgapp_college;
                             $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
                             }

     
 
     
     
 
     

            $result_countt = DB::select("select *  from tb_pg_pgquali where  pgquali_pgapp_id=?",[$ids]);
  $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
     $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


         // echo'<script>alert("Please fill up the remaining ")</script>';

return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));
 
     






    }













    //degree edit end





    //crse edit


public function tab2_save_course_edit(Request $request)



    {



          $idsold=Session::get('idApp');
          $ids=Session::get('appidnew');

               $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);

          $entireTableMainsub=DB::select('select * from tb_degqualisub');
          $entireTableQualcourse=DB::select('select * from tb_degquali');
          $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }





 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


// dd($result_count);
         foreach($result_count as $key)
          {
$varsl=$key->pgapp_sl;
           }

//sslc
       $data=$request->all();
       
//      dd($data)   ;
       
  $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
  $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }




                  $pgapp_degq_sl=$request->input('pgapp_degq_sl_1');
        $pgapp_dqsub_sl=$request->input('pgapp_dqsub_sl_1');
        $pgapp_college=$request->input('pgapp_college_1');

 $pgapp_addl=$request->input('pgapp_addl_1');


 $upd = DB::update('update tb_pgapp set pgapp_addl=?,pgapp_degq_sl=?,pgapp_college=?,pgapp_dqsub_sl=? where pgapp_sl=?',[$pgapp_addl,$pgapp_degq_sl,$pgapp_college,$pgapp_dqsub_sl,$varsl]);






 $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);

          $entireTableMainsub=DB::select('select * from tb_degqualisub');
          $entireTableQualcourse=DB::select('select * from tb_degquali');
          $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }





 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


// dd($result_count);
         foreach($result_count as $key)
          {
$varsl=$key->pgapp_sl;
           }

//sslc
       $data=$request->all();
       
//      dd($data)   ;
       
  $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
  $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }






















 
 // echo'<script>location.reload();</script>';

 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);




   
            return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));





     
     
 

    }



    //crse edit  end
















//academic course details
public function tab2_save_course(Request $request)



    {



          $idsold=Session::get('idApp');
          $ids=Session::get('appidnew');

               $result_count_pgquali = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=? ",[$ids]);

          $entireTableMainsub=DB::select('select * from tb_degqualisub');
          $entireTableQualcourse=DB::select('select * from tb_degquali');
          $result_count = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);

$result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);
  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }





 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


// dd($result_count);
         foreach($result_count as $key)
          {
$varsl=$key->pgapp_sl;
           }

//sslc
       $data=$request->all();
       
//      dd($data)   ;
       
  $result_countnew_exam = DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);
  $result_countnew_course = DB::select("select *  from tb_pgapp where pgapp_id=?",[$ids]);


 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);



  foreach($result_countnew_course as $key)
          {
         $pgapp_degq_sl=$key->pgapp_degq_sl;
         $pgapp_college=$key->pgapp_college;
         $pgapp_dqsub_sl=$key->pgapp_dqsub_sl;
         $pgapp_pgmsl=$key->pgapp_pgmsl;
           }




        if(count($result_countnew_exam)>2 AND ($pgapp_degq_sl!=""))
              {
         $st=2;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_sl=?',[$st,$varsl]);
          // return view('auth.upload');

return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));



//                  return "all entries over11111";
              }
                  $pgapp_degq_sl=$request->input('pgapp_degq_sl');
        $pgapp_dqsub_sl=$request->input('pgapp_dqsub_sl');
        $pgapp_college=$request->input('pgapp_college');

 $pgapp_addl=$request->input('pgapp_addl');


 $upd = DB::update('update tb_pgapp set pgapp_addl=?,pgapp_degq_sl=?,pgapp_college=?,pgapp_dqsub_sl=? where pgapp_sl=?',[$pgapp_addl,$pgapp_degq_sl,$pgapp_college,$pgapp_dqsub_sl,$varsl]);
 echo'<script>location.reload();</script>';

 $degqualisub=DB::select('select * from tb_degqualisub where dqsub_sl=?',[$pgapp_dqsub_sl]);
    $degcourse=DB::select('select * from tb_degquali where degq_sl=?',[$pgapp_degq_sl]);


     if($upd==1)    
         
         
     {
         
         
         if(count($result_countnew_exam)>2)
         
         {
        $st=2;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_sl=?',[$st,$varsl]);

         echo'<script>alert("Succesfully Added ")</script>';
          // return view('auth.upload');

         echo'<script>location.reload();</script>';
            return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count_pgquali','result_count','degqualisub','degcourse','pgapp_pgmsl'));




       
         }
         
            else
         
         
     {
               
                   $entireTableMainsub=DB::select('select * from tb_degqualisub');
                    $entireTableQualcourse=DB::select('select * from tb_degquali');
                   
                    echo '<script> alert("Please fill up the Exam details")</script>';
    return view('auth.academic',compact('entireTableMainsub','entireTableQualcourse','result_count','result_count_pgquali','degqualisub','degcourse','pgapp_pgmsl'));

           
     }
         
     }
     
     
 

    }



     // login credentials
         public function studlogin(Request $request)
    {



        ////    
         
////user login
        $pgapp_adhar=$request->input('pgapp_adhar');

        $newp=Session::put('appidnew',$pgapp_adhar);


        $pgapp_dob=$request->input('pgapp_dob');
        $pgapp_id=$request->input('pgapp_id');
        $pgapp_password=$request->input('pgapp_password');



        //new cmnt

          // $entireTable =DB::select('select * from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where (  pgapp_id=?)   AND  (pgapp_dob=?  OR pgapp_password=?)   ',[$pgapp_adhar,$pgapp_dob,$pgapp_dob]);

 $entireTable =DB::select('select * from tb_pgapp inner join tb_pg_stream on pgstream_id = pgapp_stream_id where  pgapp_id=?',[$pgapp_adhar]);


//new cmnt


  // $entireTablenew=DB::select('select * from tb_pgapp where  (  pgapp_id=?)   AND  (pgapp_dob=?  OR pgapp_password=?)   ',[$pgapp_adhar,$pgapp_dob,$pgapp_dob]);




$entireTablenew=DB::select('select * from tb_pgapp where  (pgapp_id=? AND pgapp_dob=?) OR (pgapp_id=? AND pgapp_password=?)',[$pgapp_adhar,$pgapp_dob,$pgapp_adhar,$pgapp_dob]);

if(count($entireTablenew)<1)

{

  echo'<script>alert(" Invalid user name or password !!!!!!")</script>';
   $request->session()->forget('idApp');
    return  view('auth.home');




}
     
             
                $appstatus=0;
                $data=$request->all();
                $user=$request->input('pgapp_adhar');
                $entireTablenewn =DB::select('select * from tb_pgapp  where pgapp_adhar=? OR pgapp_id=?', [$user,$user]);
                      foreach($entireTablenewn  as $keyg)
                           {
                              $pgapp_id=$keyg->pgapp_id;
                           }
                $newp=Session::put('appidnew',$pgapp_id);

//// $pgappid_Session=Session::get('idApp');
//// return $pgappid_Session;
               $entireTable =DB::select('select * from tb_pgapp  where pgapp_id=?', [$pgapp_id]);
                      foreach($entireTable  as $key)
                          {
                              $appstatus=$key->app_status;
                              $appsl=$key->pgapp_sl;
                          }

                          Switch($appstatus)
                                 {  
                                      case 0 :

                                      return PgappController::basic($request);
                                      break;
                                      case 1 :
                                       return PgappController::personal($request);
                                      return PgappController::reprint($request);
                                      break;
                                      case 2 :
                                       return PgappController::academic($request);
                                      return PgappController::reprint($request);
                                      break;
                                      case 3:
                                       return PgappController::upload($request);
                                     
                                      break;
                                      case 4:
                                       return PgappController::payment($request);

                                          return PgappController::payment($request);
                                     
                                      break;
                                       case 5:
                                      // return PgappController::printfull($request);

                                        return PgappController::reprint($request);
                                      break;
                                      default : '100';
                                   
                                  }



                          // Switch($appstatus)
                          //        {  
                          //             case 0 :

                          //             return PgappController::basic($request);
                          //             break;
                          //             case 1 :
                          //             // return PgappController::personal($request);
                          //             return PgappController::reprint($request);
                          //             break;
                          //             case 2 :
                          //             // return PgappController::academic($request);
                          //             return PgappController::reprint($request);
                          //             break;
                          //             case 3:
                          //             // return PgappController::upload($request);
                          //             return PgappController::reprint($request);
                          //             break;
                          //             case 4:
                          //             // return PgappController::payment($request);

                          //                    return PgappController::reprint($request);
                                     
                          //             break;
                          //              case 5:
                          //             // return PgappController::printfull($request);

                          //               return PgappController::reprint($request);
                          //             break;
                          //             default : '100';
                                   
                          //         }















// Switch($appstatus)
//                                  {  
//                                       case 0 :
                                     
//                                       return "Application closed";
//                                       break;
//                                       case 1 :
//                                       return "Application closed";
//                                       break;
//                                       case 2 :
//                                       return "Application closed";
//                                       break;
//                                       case 3:
//                                       return "Application closed";
//                                       break;
//                                       case 4:
//                                       return PgappController::payment($request);
//                                       break;
//                                        case 5:
//                                       // return PgappController::printfull($request);

//                                         return PgappController::reprint($request);
//                                       break;
//                                       default : '100';
                                   
//                                   }









     }

  public function printfull(Request $request)
     {
     
return redirect('/printapplication');


     }





  public function reprint(Request $request)
     {
     
$ids =$request->input('pgapp_adhar');
    $paymentview_saveg=DB::select('select * from tb_pgapp tb1 left join tbz_candidate_fee tb2 on tb1.pgapp_id=tb2.cndfee_cndappln_no where pgapp_id=? ', [$ids]);  

 

         foreach ($paymentview_saveg as $key)
             {


$stat_online=$key->cndfee_bankbranch;
$stat_online_ref=$key->cndfee_dd_refno;



$stat_challan=$key->cndfee_paymode;


            }



     $candidid =$request->input('pgapp_adhar');




$ids=$candidid ;



        $paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {


$stat=$key->app_status;



            }



     $paymentview_check=DB::select('select * from tbz_candidate_fee  where cndfee_cndappln_no=? ', [$ids]);  



         foreach ($paymentview_check as $keyf)
             {

$bnkbrnch=$keyf->cndfee_bankbranch;

$paymod=$keyf->cndfee_paymode;

}


if($stat=='5' )


{


if($paymod=='2')


{



if($bnkbrnch==" ")



{

  $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);

        echo'<script>alert(" Please do Re-login !!!!!!")</script>';
   
    return  view('auth.home');






}



}


}





if($stat_online=="Success" )
{

if($stat_online_ref!="")
{
 return view('auth.reprint',compact('candidid'));
}

}





if($stat_challan=="1")
{


 return view('auth.reprint',compact('candidid'));

}

else

{
return "Application has not completed";

}


     // return redirect('/printapplication');


     }





//call function from cases and first page after login
    public function basic(Request $request)
     {



// $entireTableRel=DB::select('select * from tb_religion');

$entireTableRel=DB::select('select DISTINCT(religion) from tbz_reservation_list');
 $entireTablecas=DB::select('select * from tb_caste');
 $entireTablecomm=DB::select('select * from tb_community');
 $entireTableinc=DB::select('select * from tb_income');
 

////user login
        $pgapp_adhar=$request->input('pgapp_adhar');

     
////        dd($pgapp_adhar);
        $pgapp_dob=$request->input('pgapp_dob');
        $pgapp_id=$request->input('pgapp_id');
        $pgapp_password=$request->input('pgapp_password');
//        $entireTable =DB::select('select * from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_adhar=?  and pgapp_dob=? ', [$pgapp_adhar,$pgapp_dob]);
////    dd($entireTable);
        $entireTable =DB::select('select * from tb_pgapp inner join tb_pg_stream on pgstream_id = pgapp_stream_id where  pgapp_id=?',[$pgapp_adhar]);


 // $entireTablenew=DB::select('select * from tb_pgapp where  pgapp_id=? AND (pgapp_dob=? OR pgapp_password=?)',[$pgapp_adhar,$pgapp_dob,$pgapp_dob]);
 $entireTablenew=DB::select('select * from tb_pgapp where  (pgapp_id=? AND pgapp_dob=?) OR ( pgapp_id=? AND pgapp_password=?)',[$pgapp_adhar,$pgapp_dob,$pgapp_adhar,$pgapp_dob]);



         
 if(count($entireTablenew)>0 )
        {
           
            return view('auth.candidatelogin', compact('entireTable','entireTableRel','entireTablecas','entireTablecomm','entireTableinc','entireTablenew','pgapp_adhar'));
                         
        }
   else {

 
            echo'<script>alert(" Invalid user name or password !!!!!!")</script>';  
            return view('auth.home');
        }



         return view('auth.candidatelogin', compact('pgapp_adhar'));
         
     }


















// goto payment
     
       public function payment(Request $request)
     {

$ids=Session::get('appidnew');  


 
              //dd($entireTable);

       
        $paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {

$suslnew=$key->pgapp_pgmsl;
$pgapp_stream_id=$key->pgapp_stream_id;
$pgapp_community=$key->pgapp_community;


$stat=$key->app_status;




//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }




 





             if($pgapp_stream_id==2 OR $pgapp_stream_id==6)

            {

$normalfee=300;

$scstfee=100;


if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}


else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}



else
{
$fee=500;
}



            }
           

//bbbbbbbbbbbbbbbbbbbbb


else if ($suslnew=='280')


{


$normalfee=500;

$scstfee=200;


if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}


else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}



else
{
$fee=500;
}








}




//bbbbbbbbbbbbbbbbbbbbbbb









            else


            {

$normalfee=150;

$scstfee=50;






if($pgapp_community=="SC")

{

$fee=200;
}

else if($pgapp_community=="ST")

{

$fee=200;
}

else if($pgapp_community=="ST-MUSLIM")

{

$fee=200;
}





else
{
$fee=500;
}








            }
           $resultnnnn = DB::select("select *  from tb_program where pgm_sl=?",[$suslnew]);

                   //dd($entireTable);
         foreach ($resultnnnn as $keyh)
             {

$pgmnmew=$keyh->pgm_name;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }  




         
   
       
       
       
        //newwww start
       
$paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);         //dd($entireTable);
         foreach ($paymentview_save as $key)
             {

            //  $suslnew=$key->pgapp_pgmsl;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }
           
             
         
   
              $resultfee = DB::select('select * from tbz_candidate_fee  where cndfee_cndappln_no=? ',[$ids]);
       
       
        //newwwww end
       
       
       
       
       
       
       
       
       
       
// $paymentview=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);
 $paymentview = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);

                               


   return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','normalfee','scstfee','fee'));
     }
  public function option_save(Request $request)
     {
     
     
   
   
   $flagn=Session::get('flagsession');
   
 
        $ids=Session::get('appidnew');  
       
       
       
       
       
        //newwww start
       
$paymentview_save=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);        


         foreach ($paymentview_save as $key)
             {

$suslnew=$key->pgapp_pgmsl;
$pgapp_stream_id=$key->pgapp_stream_id;
$pgapp_community=$key->pgapp_community;



//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }


 if($pgapp_stream_id==2 OR $pgapp_stream_id==6)

            {

$normalfee=300;

$scstfee=100;


if($pgapp_community=="SC")

{

$fee=200;
}


else if($pgapp_community=="ST")


{
$fee=200;

}



else if($pgapp_community=="ST-MUSLIM")


{
$fee=200;

}
else
{
$fee=500;
}



            }
           
            else


            {

$normalfee=300;

$scstfee=200;






if($pgapp_community=="SC" )

{

$fee=200;
}


else if($pgapp_community=="ST")


{
$fee=200;

}

else if($pgapp_community=="ST-MUSLIM")


{

$fee=200;

}



else
{
$fee=500;
}


}



           
           $resultnnnn = DB::select("select *  from tb_program where pgm_sl=?",[$suslnew]);

                   //dd($entireTable);
         foreach ($resultnnnn as $keyh)
             {

$pgmnmew=$keyh->pgm_name;
//                    $email=$key->ugapp_email;
//                    $regid=$key->ugapp_sl;
//                    $status=$key->ugapp_status;
//                    $ugidm=$key->ugapp_id;
//                    $profile_st=$key->profile_status;
            }  




         
   
              $resultfee = DB::select('select * from tbz_candidate_fee  where cndfee_cndappln_no=? ',[$ids]);
       
       
        //newwwww end
       
       
       
       
       
       
       
       
       
       
// $paymentview=DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);
 $paymentview = DB::select("select *  from tb_pgapp inner join tb_pg_stream on pgstream_id =pgapp_stream_id where pgapp_id=?",[$ids]);

                       
                               
                               

       
       
         $data=$request->all();

   

        $center_entrance=$request->input('center_entarnce');
     
                       $entireTablepgm =DB::select('select * from tb_pg_pgpgm  where pgpgm_pgapp_id=? ', [$ids]);
                    // $paymentview_save =DB::select('select * from tb_pgapp  where pgapp_id=? ', [$ids]);

     
       $opt1=1;
$opt2=2;
$opt3=3;
      if($flagn==1)
         
      {


               // $option1=$request->input('option1');
          $center_sl1=$request->input('center_sl1');
         
           
        if(count($entireTablepgm)>0)
           
        {

         
           
             echo'<script>alert("Already Added ")</script>';
            return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','normalfee','scstfee','fee'));
   
   
        }
 else {
     
   
      $option11= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$suslnew,$center_sl1,$opt1,$center_entrance]);

      $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);


 }
if($option11==1 )
   
{
 
   
        $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);
       
          echo'<script>alert("Succesfully Added ")</script>';
          return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','scstfee','normalfee','fee'));
//            return view('auth.payment');
   
   
   
   
   
   
   
}
     
     
      }
     
         if($flagn==2)
         
      {
           // $option1=$request->input('option1');
          $center_sl1=$request->input('center_sl1');
         
               // $option2=$request->input('option2');
          $center_sl2=$request->input('center_sl2_');
         
               if(count($entireTablepgm)>1)
           
        {
           
             echo'<script>alert("Already Added ")</script>';
//            return view('auth.payment');
            return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','scstfee','normalfee','fee'));
   
   
        }
 else {
      $option11= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$suslnew,$center_sl1,$opt1,$center_entrance]);
      $option22= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$suslnew,$center_sl2,$opt2,$center_entrance]);



      $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);
 }
if($option11==1 AND $option22==1  )
   
{
 
   
        $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);
       
          echo'<script>alert("Succesfully Added ")</script>';
//            return view('auth.payment');
            return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','scstfee','normalfee','fee'));
   
   
   
   
   
   
   
}
      }
     
     
     
         if($flagn==3)
         
      {
             
               // $option1=$request->input('option1');
          $center_sl1=$request->input('center_sl1');
         
               // $option2=$request->input('option2');
          $center_sl2=$request->input('center_sl2_');
         
               // $option3=$request->input('option3');
          $center_sl3=$request->input('center_sl3_');
       
               if(count($entireTablepgm)>2)
           
        {
           
             echo'<script>alert("Already Added ")</script>';
//            return view('auth.payment');
            return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','scstfee','normalfee','fee'));
   
   
        }
 else {  
      $option11= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$suslnew,$center_sl1,$opt1,$center_entrance]);
      $option22= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$suslnew,$center_sl2,$opt2,$center_entrance]);
      $option33= DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',[$ids,$suslnew,$center_sl3,$opt3,$center_entrance]);

$st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);

     
 }
if($option11==1 AND $option22==1  AND $option33==1)
   
{
 
   
        $st=4;
        $upd = DB::update('update tb_pgapp set app_status=? where pgapp_id=?',[$st,$ids]);
       
          echo'<script>alert("Succesfully Added ")</script>';
//            return view('auth.payment');
            return view('auth.payment',compact('paymentview','paymentview_save','resultfee','pgmnmew','scstfee','normalfee','fee'));
   
   
   
   
   
   
   
}
      }




}




//centr option one on change ajax

        public function centopt1(Request $request)
     {

$year=2020;
$ids=Session::get('appidnew');

  $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$ids]);

         foreach ($pgappall as $key)
            {
                    $pgmsl=$key->pgapp_pgmsl;

     }


$cent_opt = $request->input('cent1');





//newwwwwwwwwwwwwwwwwww   starttt


$centrop=DB::select("SELECT
  tb_centre.centre_name,tb_centre.centre_sl
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl =? AND  tb_admnscheme.adsc_admnyear=? AND (tb_centre.centre_sl NOT IN($cent_opt))",[$pgmsl,$year ]);

// SELECT
//   DISTINCT(tb_centre.centre_name)
// FROM
//   public.tb_admncentre,
//   public.tb_admnscheme,
//   public.tb_centre,
//   public.tb_program
// WHERE
//   tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
//   tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
//   tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl ='109' AND (tb_centre.centre_sl NOT IN(23))










// newwwwwwwwwwwwww   end



// if($cent_opt=='23')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(23)");


//            }



// if($cent_opt=='15')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(15)");


//            }


//            if($cent_opt=='20')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(20)");


//            }


//            if($cent_opt=='17')//tsr
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(17)");


//            }


//            if($cent_opt=='16')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(16)");


//            }


//            if($cent_opt=='22')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(22)");


//            }


//            if($cent_opt=='18')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(18)");


//            }


//            if($cent_opt=='19')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(19)");


//            }


//            if($cent_opt=='21')
// {
       
//              $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(21)");


//            }






       
//         dd($html);

if(count($centrop)>0)

{

            $htmlcent = "<class=\"col-sm-4\" id=\"cdiv2\" name=\"cdiv2\">
 <select  id= \"center_sl2\" name=\"center_sl2 \" onchange=\"centropt2()\">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($centrop as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent .= "</select></div>";


 return $htmlcent;


}

  else

  {



  }      


     





     }
     



public function centopt1_old(Request $request)
     {




$cent_opt = $request->input('cent1');

if($cent_opt=='23')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(23)");


           }



if($cent_opt=='15')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(15)");


           }


           if($cent_opt=='20')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(20)");


           }


           if($cent_opt=='17')//tsr
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(17)");


           }


           if($cent_opt=='16')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(16)");


           }


           if($cent_opt=='22')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(22)");


           }


           if($cent_opt=='18')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(18)");


           }


           if($cent_opt=='19')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(19)");


           }


           if($cent_opt=='21')
{
       
             $centrop=DB::select("select * from tb_centre  where centre_sl NOT IN(21)");


           }






       
//         dd($html);

if(count($centrop)>0)

{

            $htmlcent = "<class=\"col-sm-4\" id=\"cdiv2\" name=\"cdiv2\">
 <select  id= \"center_sl2\" name=\"center_sl2 \" onchange=\"centropt2()\">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($centrop as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent .= "</select></div>";


 return $htmlcent;


}

  else

  {



  }      


     





     }
     


 public function centopt2(Request $request)
     {




$year=2020;



 $cent_opt = $request->input('cent1');
$cent_opt2 = $request->input('cent2');




$ids=Session::get('appidnew');

  $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$ids]);

         foreach ($pgappall as $key)
            {
                    $pgmsl=$key->pgapp_pgmsl;

     }








//newwwwwwwwwwwwwwwwwww   starttt


$centrop2=DB::select("SELECT
  tb_centre.centre_name,tb_centre.centre_sl
FROM
  public.tb_admncentre,
  public.tb_admnscheme,
  public.tb_centre,
  public.tb_program
WHERE
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_pgm_sl =? AND  tb_admnscheme.adsc_admnyear=? AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);



//newssssssssssssssssss end












//old query
   
//               $centrop2=DB::select("select * from tb_centre  where centre_sl NOT IN($cent_opt2,$cent_opt)");


         






       
//         dd($html);

if(count($centrop2)>0)

{

            $htmlcent2 = "<class=\"col-sm-4\" id=\"cdiv3\" name=\"cdiv3\">
 <select  id= \"center_sl3\" name=\"center_sl3 \" >
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($centrop2 as $cntr) {
            $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent2 .= "</select></div>";
  return  $htmlcent2;





}

  else

  {



  }      


     





     }








//  public function showexamdet(Request $request)
//      {



   
//           $ids=Session::get('appidnew');
     
//           $result_show= DB::select("select *  from tb_pg_pgquali where pgquali_pgapp_id=?",[$ids]);



// $html='<div id=\"show\" name=\"show\" >
// <table border=2>
// <tr>
// <th>Name of Exam</th>
// <th>Main Subject</th>
// <th>University/Board</th>
// <th>Register number</th>
// <th>Grade</th>
// <th>Mark</th>

// <th>Edit</th>

// </tr>';
//  foreach ($result_show as $key2) {

// $html.='
// <tr>
// <td>'.$key2->pgquali_exam.'</td>
// <td>'.$key2->pgquali_subject.'</td>
// <td>'.$key2->pgquali_university.'</td>
// <td>'.$key2->pgquali_register.'</td>
// <td>'.$key2->pgquali_grade.'</td>
// <td>'.$key2->pgquali_mark.'</td>



// <td><a href="examdetshow"'.{{$key2->pgquali_mark}}.'"</a>Edit</td>';
// }



// $html.='</table></div>';















     
//   return  $html;










// }





 public function examedit(Request $request)
     {




return "ghmjghjhgj";











}

     
         
       
//     return view('auth.payment',compact('entireTable'));
//  
     
     public function centopt2_old(Request $request)
     {



$cent_opt = $request->input('cent1');
$cent_opt2 = $request->input('cent2');

   
              $centrop2=DB::select("select * from tb_centre  where centre_sl NOT IN($cent_opt2,$cent_opt)");


         






       
//         dd($html);

if(count($centrop2)>0)

{

            $htmlcent2 = "<class=\"col-sm-4\" id=\"cdiv3\" name=\"cdiv3\">
 <select  id= \"center_sl3\" name=\"center_sl3 \" >
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($centrop2 as $cntr) {
            $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
       $htmlcent2 .= "</select></div>";
  return  $htmlcent2;





}

  else

  {



  }      


     





     }



     
         
       
//     return view('auth.payment',compact('entireTable'));
//  
     


           public function finalsubmit(Request $request)
     {
     return view('auth.printapplication');
     }
     
     
     
}

