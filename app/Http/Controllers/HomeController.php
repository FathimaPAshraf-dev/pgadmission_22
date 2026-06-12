<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\PostPgOtherInfo;
use App\PostpgQuali;
use Validator;
use Carbon\Carbon;
use App\PaymentTrans;
use App\CcTrans;
use App\TbzCcavenueTxn;
use PaymentGateway\Atom\Facades\Atompay;
use App\Gateway\TransactionRequest;
use App\Gateway\TransactionResponse;
use Redirect;
use Session;
use PDF;

class HomeController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }


      protected function guard()
    {
        return Auth::guard();
    }

   
    
        
//      
    
  public function index1()
    {
//      return view('unavailable');  
//        dd($this->payment_success_status());
        
        
       if( ( $this->payment_status() > 0 ) && ( Auth::user()->pg_edit_appl == 0) ) {
           return redirect('pay_details');

       }
       else {
        $appid=Auth::user()->pgapp_id;
        $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
//                return $query1;

        $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
//                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
       //dd($pgapp);
        
        foreach($pgapp as $key){
            $adscsl=$key->pgapp_adsc_sl;
            $examcent=$key->pgapp_exam_centre;
        }
       // return $adscsl;
        $centre_options =DB::connection('pgsql2')->select("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              public.tb_admncentre, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear='2022'",[$adscsl]);

             $count_centr=count($centre_options);

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

      if($adscsl==995||$adscsl==992||$adscsl==980||$adscsl==981||$adscsl==982||$adscsl==983||$adscsl==997||$adscsl==998)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[23]);  //except REGIONAL CAMPUS, THRISSUR 
      }
      else if($adscsl==994 || $adscsl==996)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[16]);  //except REGIONAL CAMPUS, THRISSUR 
      }
      else{
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?)",[17]);  //except REGIONAL CAMPUS, THRISSUR  
       }  
        
         $entireTableinc=DB::select('select * from tb_income');

//        $religion=DB::select("select relgn_sl,relgn_name from tb_religion  ");
        $state=DB::select("select state_sl,state_name from tb_state ");
       
        $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?)",['NO RELIGION','OTHERS','ISLAM']);
    
//        $adscsl = Input::get('adscsl');
        //
//        dd($adscsl);
        
        $pmodeoption= DB::table('tb_pg_projectmode')
                ->select('*')
                ->where('pgapp_id','=',$appid)
                ->get();
         $pflag=0;
         if(!$pmodeoption->isEmpty()){
             $pflag=1;
         }
        
        else{
             $pflag=0;
        }
//        dd($pstream);
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
        $pgqualicount= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get()->count();
//       return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
      //  return $pgotherinfo;
//        $pgoptions= DB::table('tb_pg_pgpgm')
//                ->select('*')
//                ->where('pgpgm_pgapp_id','=',$appid)
//                ->get();
        
        $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,'
            . 'tb1.pg_entrance_centre,tb1.pgpgm_centre_sl from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

        $pgmselct=DB::select("select * from tb_pg_pgquali where  pgquali_pgapp_id=?",[$appid]);
        $pgquali_exam="";
        $pgquali_subject="";

        if(count($pgmselct)>0)
         
     {
       foreach($pgmselct as $key){
            $pgquali_exam=$key->pgquali_exam;
            $pgquali_subject=$key->pgquali_subject;
           
        }
     }
     //return $pgquali_subject;
//dd($pgoptions);
        $pgopt1="";
        $pgopt2="";
        $pgopt3="";
     $pgpgm1=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=1",[$appid]);
     if(count($pgpgm1)>0)
         
     {
       foreach($pgpgm1 as $key){
            $pgopt1=$key->pgpgm_centre_sl;
        }
     }
     $pgpgm2=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=2",[$appid]);
     
        if(count($pgpgm2)>0)
         
     {
       foreach($pgpgm2 as $key){
             $pgopt2=$key->pgpgm_centre_sl;
        }
     }
     
     $pgpgm3=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and  pg_option=3",[$appid]);
  // return count($pgpgm3);
        if(count($pgpgm3)>0)
         
     {
       foreach($pgpgm3 as $key){
            $pgopt3=$key->pgpgm_centre_sl;
        }
     }
     
     if(Auth::user()->pgapp_adsc_sl==996){
       $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(42,43)"); 
       $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl  IN(104,105)');   
     }
     else{
      $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(11,14,15,18,22,23,24,25,26,27,28,33,34,38,39,40,42)"); 
      $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl NOT IN(104,105)');    
     }
     
     
        
        
  $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
  
  
  if(count($pgpgm_count)>0)
  {
      $pgpgm_flag=1;
  }
  
  else
      
  {
       $pgpgm_flag=0;
  }
   $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
      date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");
//        dd($datenow);
//       if($datenow>'27/04/2022'){
// return view('auth.registerclose'); 
//       }
//       else{
//        dd($pstream);
           return view('homepmode',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
                'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
             'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent','pmodeoption','pflag'));
      
//       }
  
  //dd($amnt);
//     return view('home1',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
//                'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
//             'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent'));
      
 
        
       }
        
    }
    public function index10000000()
    {
        if( ( $this->payment_status() > 0 ) && ( Auth::user()->pg_edit_appl == 0) ) {
            return redirect('pay_details');
 
        }
        else
        {

            return view('auth.register'); 
            // return view('auth.registerclose'); 


        }
       



    }

    public function index()
    {


        if( ( $this->payment_status() > 0 ) && ( Auth::user()->pg_edit_appl == 0) ) {
            //return '1111111111111111hello';
               return redirect('pay_details');
    
           }
         
        $appid=Auth::user()->pgapp_id;
        $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
       // return $appid;

       $community = [];
       $caste=[];
       $subcaste=[]; $pgphoto=[];
       $pgsign=[];
       $flags=[]; 
       $examcent=[];



       $pgapp = DB::table('tb_pgapp')
       ->select('tb_pgapp.*', 'tb_admnscheme.adsc_name', 'tb_gender.gender_name')
       ->leftJoin('tb_admnscheme', 'tb_admnscheme.adsc_sl', '=', 'tb_pgapp.pgapp_adsc_sl')
       ->leftJoin('tb_gender', 'tb_gender.gender_sl', '=', 'tb_pgapp.pgapp_gender_sl')
       ->leftJoin('tbz_reservation_list', 'tbz_reservation_list.id', '=', 'tb_pgapp.pgapp_caste_sl')
       ->where('tb_pgapp.pgapp_id', '=', $appid) // Ensure table prefix in WHERE clause
       ->get();
   
                
              // return $pgapp;

                $adscsl='0';

        foreach($pgapp as $key){
            $adscsl=$key->pgapp_adsc_sl;
            $examcent=$key->pgapp_exam_centre;
        }
         // dd($adscsl);
        $centre_options =DB::connection('pgsql2')->select("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              public.tb_admncentre, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear='2026'",[$adscsl]);

//       dd($centre_options);
             $count_centr=count($centre_options);
//            if(($count_centr)==1)
//            {
//            $flags=1;
//            } 
//            else if(($count_centr)==2)
//            {
//            $flags=2;
//            }
//            else if(($count_centr)==3)
//            {
//
//            $flags=3;
//
//            }
//            else if(($count_centr)==4)
//            {
//            $flags=4;
//            }
//            else if(($count_centr)==5)
//            {
//            $flags=5;
//            }
                       
             
             
      

      if($adscsl==1037||$adscsl==1036 || $adscsl==1055 || $adscsl==1044||$adscsl==1052||$adscsl==1059)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[23]);  //except REGIONAL CAMPUS, THRISSUR 
      }
      else if($adscsl==1065)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[16]);  //except REGIONAL CAMPUS, THRISSUR 
      }
     
     
      else{
//      $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) ",[$adscsl]);  //except REGIONAL CAMPUS, THRISSUR     

// $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) and scst_renot_flag=?",[$adscsl,1]);

      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?,?)",[17,22]);  //except REGIONAL CAMPUS, THRISSUR  
//        dd($examcentre);
      
      }  
       
//               $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) ",[$adscsl]);  //except REGIONAL CAMPUS, THRISSUR    
//        if($adscsl==993)  {
           //     $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?)",[17]);  //except REGIONAL CAMPUS, THRISSUR  
               
        //       dd($examcentre);

       $pmodeoption= DB::table('tb_pg_projectmode')
                ->select('*')
                ->where('pgapp_id','=',$appid)
                ->get();
         $pflag=0;
         if(!$pmodeoption->isEmpty()){
             $pflag=1;
         }
        
        else{
             $pflag=0;
        }
       
       $entireTableinc=DB::select('select * from tb_income');
       if(true){
        $religion=DB::select("select relgn_sl,relgn_name from tb_religion  "); //original
       }
       else{
           
         $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?,?)",
                ['NO RELIGION','OTHERS','ISLAM','CHRISTIAN']); // for renotification  
       }

        $state=DB::select("select state_sl,state_name from tb_state ");
//        $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?)",
//                ['NO RELIGION','OTHERS','ISLAM']); // for renotification

       
//        $adscsl = Input::get('adscsl');
        //
//        dd($adscsl);

$category=DB::select("select category_sl,category_name from tb_category  ");
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
        $pgqualicount= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get()->count();
//       return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
      //  return $pgotherinfo;
//        $pgoptions= DB::table('tb_pg_pgpgm')
//                ->select('*')
//                ->where('pgpgm_pgapp_id','=',$appid)
//                ->get();
        
        $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,'
            . 'tb1.pg_entrance_centre,tb1.pgpgm_centre_sl from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

        $pgmselct=DB::select("select * from tb_pg_pgquali where  pgquali_pgapp_id=?",[$appid]);
        $pgquali_exam="";
        $pgquali_subject="";

        if(count($pgmselct)>0)
         
        {
            foreach($pgmselct as $key){
                $pgquali_exam=$key->pgquali_exam;
                $pgquali_subject=$key->pgquali_subject;

            }
        }
     //return $pgquali_subject;
//dd($pgoptions);
        $pgopt1="";
        $pgopt2="";
        $pgopt3="";
     $pgpgm1=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=1",[$appid]);
     if(count($pgpgm1)>0)
         
     {
       foreach($pgpgm1 as $key){
            $pgopt1=$key->pgpgm_centre_sl;
        }
     }
     $pgpgm2=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=2",[$appid]);
     
        if(count($pgpgm2)>0)
         
     {
       foreach($pgpgm2 as $key){
             $pgopt2=$key->pgpgm_centre_sl;
        }
     }
     
     $pgpgm3=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and  pg_option=3",[$appid]);
  // return count($pgpgm3);
        if(count($pgpgm3)>0)
         
     {
       foreach($pgpgm3 as $key){
            $pgopt3=$key->pgpgm_centre_sl;
        }
     }
     
     if(Auth::user()->pgapp_adsc_sl==996){
       $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(42,43)"); 
       $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl  IN(104,105)');   
     }
     else{
      $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(11,14,15,18,22,23,24,25,26,27,28,33,34,36,38,39,40,42,44)"); 
      $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl NOT IN(104,105)');    
     }     
        
  $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
  
  
  if(count($pgpgm_count)>0)
  {
      $pgpgm_flag=1;
  }
  
  else
      
  {
       $pgpgm_flag=0;
  }
  
        
  
        $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
        date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");


        $record = DB::table('tb_pg_pgquali')->where('pgquali_pgapp_id', $appid)->first();

        // Generate the file URL
        if ($record && $record->file_sslc_path) {
         
         $fileUrl = asset('storage/' . $record->file_sslc_path);
        } else {
            $fileUrl = null;
        }

        if ($record && $record->file_degree_path) {
         
            $fileUrlhse = asset('storage/' . $record->file_degree_path);
           } else {
               $fileUrlhse = null;
           }

           if ($record && $record->file_aadhar_path) {
         
            $fileUrlaadhar = asset('storage/' . $record->file_aadhar_path);
           } else {
               $fileUrlaadhar = null;
           }

           $special_file_record=DB::table('tbz_pgotherinfo')->where('pgotherinfo_appid', $appid)->first();

               if ($special_file_record && $special_file_record->file_special_path) {
         
                $fileUrlSpecial = asset('storage/' . $special_file_record->file_special_path);
               } else {
                   $fileUrlSpecial = null;
               }

               if ($special_file_record && $special_file_record->pgapp_wh_special_reserv==1) {
         
                $pgapp_wh_special_reserv = 1;
               } else {
                   $pgapp_wh_special_reserv = 0;
               }


            //  dd($centre_options);
        
             // dd( Auth::user()->reservation_claim_status);
        
        
    
//    if($adscsl==997||$adscsl==985||$adscsl==984||$adscsl==977||$adscsl==976||$adscsl==975||$adscsl==988||$adscsl==980||$adscsl==979||$adscsl==973||
//            $adscsl==972||$adscsl==969||$adscsl==970||$adscsl==971||$adscsl==986||$adscsl==984||$adscsl==985||$adscsl==986
//            ||$adscsl==995||$adscsl==989||$adscsl==993){
        
    if(true){    
     
        // return view('home',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
        //      'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
        //      'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent','pmodeoption','pflag'));

 // OPTION BLOCK
 //dd($centre_options);
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        $option_stat=Auth::user()->option_stat;
        $year=date('Y');
            // $centre_options =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            // FROM 
            //   admn22.asw_seatmatrix, 
            //   public.tb_admnscheme, 
            //   public.tb_centre, 
            //   public.tb_program
            // WHERE 
            //   asw_seatmatrix.pgm = tb_admnscheme.adsc_sl AND
            //   tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
            //   tb_centre.centre_sl = asw_seatmatrix.centre  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear=? ",[$adscsl,2025]);
            //    $count_centr=count($centre_options);
             //  dd($centre_options);
               if(($count_centr)==8)
               {
                   $flags=8;
               }
               elseif(($count_centr)==7)
               {
                   $flags=7;
               }
               elseif(($count_centr)==6)
               {
                   $flags=6;
               }
               elseif(($count_centr)==5)
               {
                   $flags=5;
               }
               elseif(($count_centr)==4)
               {
                   $flags=4;
               }
               elseif(($count_centr)==3)
               {
                   $flags=3;
               }
              
               elseif(($count_centr)==2)
               {
                   $flags=2;
               }
               elseif(($count_centr)==1)
               {
                   $flags=1;
               }
               $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
   
               if(count($pgpgm_count)>0)
               {
                   $pgpgm_flag=1;
               }
               else
               {
                    $pgpgm_flag=0;
               }   
                   
               
                
                $pgpgm_count1=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=1",[$appid]);
                $pgpgm_flag1=0;
                  if(count($pgpgm_count1)>0)
                  {
                      $pgpgm_flag1=1;
                  }
       
                 $pgpgm_count2=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=2",[$appid]);
                $pgpgm_flag2=0;
                  if(count($pgpgm_count2)>0)
                  {
                      $pgpgm_flag2=1;
                  }
                 $pgpgm_count3=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=3",[$appid]);
                 $pgpgm_flag3=0;
                  if(count($pgpgm_count3)>0)
                  {
                      $pgpgm_flag3=1;
                  }
                  
                 $pgpgm_count4=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=4",[$appid]);
                 $pgpgm_flag4=0;
                  if(count($pgpgm_count4)>0)
                  {
                      $pgpgm_flag4=1;
                  }
                  
                 $pgpgm_count5=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=5",[$appid]);
                 $pgpgm_flag5=0;
                  if(count($pgpgm_count5)>0)
                  {
                      $pgpgm_flag5=1;
                  }
                  
                 $pgpgm_count6=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=6",[$appid]);
                 $pgpgm_flag6=0;
                  if(count($pgpgm_count6)>0)
                  {
                      $pgpgm_flag6=1;
                  }

                  // OPTION BLOCK ENDS

                //   return view('home', compact('pgapp', 'religion', 'community', 'caste', 'subcaste', 'pgquali', 
                //   'pgotherinfo', 'pgphoto', 'pgsign', 'pgqualicount', 'entireTableinc', 'centre_options', 
                //   'state', 'pgoptions', 'pgpgm_flag', 'flags', 'pgpgm1', 'pgpgm2', 'pgpgm3', 
                //   'pgopt1', 'pgopt2', 'pgopt3', 'ugquali', 'ugqualisubject', 'pgquali_exam', 
                //   'pgquali_subject', 'examcentre', 'examcent', 'pmodeoption', 'pflag'));



                // return view('2025.optionpage',compact('centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                //  ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6'));
             //   dd($flags);
                  
                  $amnt = 200;
        $combined = collect([
    'Application Fee_' . $amnt
])->implode('+');
        
        $data = [];

$data['Application Fee'] = (float) $amnt;

//dd($flags);
        
    return view('home', compact('pgapp', 'religion', 'community', 'caste', 'subcaste', 'pgquali', 
    'pgotherinfo', 'pgphoto', 'pgsign', 'pgqualicount', 'entireTableinc', 'centre_options', 
    'state', 'pgoptions', 'pgpgm_flag', 'flags', 'pgpgm1', 'pgpgm2', 'pgpgm3', 
    'pgopt1', 'pgopt2', 'pgopt3', 'ugquali', 'ugqualisubject', 'pgquali_exam', 
    'pgquali_subject', 'examcentre', 'examcent', 'pmodeoption', 'pflag','centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                 ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6',
                 'fileUrl','fileUrlhse','fileUrlSpecial','category','special_file_record','pgapp_wh_special_reserv','fileUrlaadhar','amnt'


))->with('feeDetails', $data);
  
    }
    else{
     return view('auth.register'); 
    }

       }


// newly added for re-option
   public function reoptionindex()
    {


         
        $appid=Auth::user()->pgapp_id;
        $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
       // return $appid;

       $community = [];
       $caste=[];
       $subcaste=[]; $pgphoto=[];
       $pgsign=[];
       $flags=[]; 
       $examcent=[];



       $pgapp = DB::table('tb_pgapp')
       ->select('tb_pgapp.*', 'tb_admnscheme.adsc_name', 'tb_gender.gender_name')
       ->leftJoin('tb_admnscheme', 'tb_admnscheme.adsc_sl', '=', 'tb_pgapp.pgapp_adsc_sl')
       ->leftJoin('tb_gender', 'tb_gender.gender_sl', '=', 'tb_pgapp.pgapp_gender_sl')
       ->leftJoin('tbz_reservation_list', 'tbz_reservation_list.id', '=', 'tb_pgapp.pgapp_caste_sl')
       ->where('tb_pgapp.pgapp_id', '=', $appid) // Ensure table prefix in WHERE clause
       ->get();
   
                
              // return $pgapp;

                $adscsl='0';

        foreach($pgapp as $key){
            $adscsl=$key->pgapp_adsc_sl;
            $examcent=$key->pgapp_exam_centre;
        }
         // dd($adscsl);
        $centre_options =DB::connection('pgsql2')->select("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              public.tb_admncentre, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear='2026'",[$adscsl]);

      /// dd($centre_options);
             $count_centr=count($centre_options);
            if(($count_centr)==1)
            {
            $flags=1;
            } 
            else if(($count_centr)==2)
            {
            $flags=2;
            }
            if(($count_centr)==3)
            {

            $flags=3;

            }
            else if(($count_centr)==4)
            {
            $flags=4;
            }
            else if(($count_centr)==5)
            {
            $flags=5;
            }
                        
      

      if($adscsl==1037||$adscsl==1036 || $adscsl==1055 || $adscsl==1044||$adscsl==1052||$adscsl==1059)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[23]);  //except REGIONAL CAMPUS, THRISSUR 
      }
      else if($adscsl==1065)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[16]);  //except REGIONAL CAMPUS, THRISSUR 
      }
     
     
      else{
//      $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) ",[$adscsl]);  //except REGIONAL CAMPUS, THRISSUR     

// $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) and scst_renot_flag=?",[$adscsl,1]);

      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?,?)",[17,22]);  //except REGIONAL CAMPUS, THRISSUR  
//        dd($examcentre);
      
      }  
       
//               $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) ",[$adscsl]);  //except REGIONAL CAMPUS, THRISSUR    
//        if($adscsl==993)  {
           //     $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?)",[17]);  //except REGIONAL CAMPUS, THRISSUR  
               
        //       dd($examcentre);

       $pmodeoption= DB::table('tb_pg_projectmode')
                ->select('*')
                ->where('pgapp_id','=',$appid)
                ->get();
         $pflag=0;
         if(!$pmodeoption->isEmpty()){
             $pflag=1;
         }
        
        else{
             $pflag=0;
        }
       
       $entireTableinc=DB::select('select * from tb_income');
       if(true){
        $religion=DB::select("select relgn_sl,relgn_name from tb_religion  "); //original
       }
       else{
           
         $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?,?)",
                ['NO RELIGION','OTHERS','ISLAM','CHRISTIAN']); // for renotification  
       }

        $state=DB::select("select state_sl,state_name from tb_state ");
//        $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?)",
//                ['NO RELIGION','OTHERS','ISLAM']); // for renotification

       
//        $adscsl = Input::get('adscsl');
        //
//        dd($adscsl);

$category=DB::select("select category_sl,category_name from tb_category  ");
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
        $pgqualicount= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get()->count();
//       return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
      //  return $pgotherinfo;
//        $pgoptions= DB::table('tb_pg_pgpgm')
//                ->select('*')
//                ->where('pgpgm_pgapp_id','=',$appid)
//                ->get();
        
        $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,'
            . 'tb1.pg_entrance_centre,tb1.pgpgm_centre_sl from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

        $pgmselct=DB::select("select * from tb_pg_pgquali where  pgquali_pgapp_id=?",[$appid]);
        $pgquali_exam="";
        $pgquali_subject="";

        if(count($pgmselct)>0)
         
        {
            foreach($pgmselct as $key){
                $pgquali_exam=$key->pgquali_exam;
                $pgquali_subject=$key->pgquali_subject;

            }
        }
     //return $pgquali_subject;
//dd($pgoptions);
        $pgopt1="";
        $pgopt2="";
        $pgopt3="";
     $pgpgm1=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=1",[$appid]);
     if(count($pgpgm1)>0)
         
     {
       foreach($pgpgm1 as $key){
            $pgopt1=$key->pgpgm_centre_sl;
        }
     }
     $pgpgm2=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=2",[$appid]);
     
        if(count($pgpgm2)>0)
         
     {
       foreach($pgpgm2 as $key){
             $pgopt2=$key->pgpgm_centre_sl;
        }
     }
     
     $pgpgm3=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and  pg_option=3",[$appid]);
  // return count($pgpgm3);
        if(count($pgpgm3)>0)
         
     {
       foreach($pgpgm3 as $key){
            $pgopt3=$key->pgpgm_centre_sl;
        }
     }
     
     if(Auth::user()->pgapp_adsc_sl==996){
       $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(42,43)"); 
       $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl  IN(104,105)');   
     }
     else{
      $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(11,14,15,18,22,23,24,25,26,27,28,33,34,36,38,39,40,42,44)"); 
      $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl NOT IN(104,105)');    
     }     
        
  $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
  
  
  if(count($pgpgm_count)>0)
  {
      $pgpgm_flag=1;
  }
  
  else
      
  {
       $pgpgm_flag=0;
  }
  
        
  
        $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
      date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");


        $record = DB::table('tb_pg_pgquali')->where('pgquali_pgapp_id', $appid)->first();

        // Generate the file URL
        if ($record && $record->file_sslc_path) {
         
         $fileUrl = asset('storage/' . $record->file_sslc_path);
        } else {
            $fileUrl = null;
        }

        if ($record && $record->file_degree_path) {
         
            $fileUrlhse = asset('storage/' . $record->file_degree_path);
           } else {
               $fileUrlhse = null;
           }

           if ($record && $record->file_aadhar_path) {
         
            $fileUrlaadhar = asset('storage/' . $record->file_aadhar_path);
           } else {
               $fileUrlaadhar = null;
           }

           $special_file_record=DB::table('tbz_pgotherinfo')->where('pgotherinfo_appid', $appid)->first();

               if ($special_file_record && $special_file_record->file_special_path) {
         
                $fileUrlSpecial = asset('storage/' . $special_file_record->file_special_path);
               } else {
                   $fileUrlSpecial = null;
               }

               if ($special_file_record && $special_file_record->pgapp_wh_special_reserv==1) {
         
                $pgapp_wh_special_reserv = 1;
               } else {
                   $pgapp_wh_special_reserv = 0;
               }


            //  dd($centre_options);
        
             // dd( Auth::user()->reservation_claim_status);
        
        
    
//    if($adscsl==997||$adscsl==985||$adscsl==984||$adscsl==977||$adscsl==976||$adscsl==975||$adscsl==988||$adscsl==980||$adscsl==979||$adscsl==973||
//            $adscsl==972||$adscsl==969||$adscsl==970||$adscsl==971||$adscsl==986||$adscsl==984||$adscsl==985||$adscsl==986
//            ||$adscsl==995||$adscsl==989||$adscsl==993){
        
    if(true){    
     
        // return view('home',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
        //      'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
        //      'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent','pmodeoption','pflag'));

 // OPTION BLOCK
 //dd($centre_options);
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        $option_stat=Auth::user()->option_stat;
        $year=date('Y');
            // $centre_options =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            // FROM 
            //   admn22.asw_seatmatrix, 
            //   public.tb_admnscheme, 
            //   public.tb_centre, 
            //   public.tb_program
            // WHERE 
            //   asw_seatmatrix.pgm = tb_admnscheme.adsc_sl AND
            //   tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
            //   tb_centre.centre_sl = asw_seatmatrix.centre  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear=? ",[$adscsl,2025]);
            //    $count_centr=count($centre_options);
             //  dd($centre_options);
               if(($count_centr)==8)
               {
                   $flags=8;
               }
               elseif(($count_centr)==7)
               {
                   $flags=7;
               }
               elseif(($count_centr)==6)
               {
                   $flags=6;
               }
               elseif(($count_centr)==5)
               {
                   $flags=5;
               }
               elseif(($count_centr)==4)
               {
                   $flags=4;
               }
               elseif(($count_centr)==3)
               {
                   $flags=3;
               }
              
               elseif(($count_centr)==2)
               {
                   $flags=2;
               }
               elseif(($count_centr)==1)
               {
                   $flags=1;
               }
               $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
   
               if(count($pgpgm_count)>0)
               {
                   $pgpgm_flag=1;
               }
               else
               {
                    $pgpgm_flag=0;
               }   
                   
               
                
                $pgpgm_count1=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=1",[$appid]);
                $pgpgm_flag1=0;
                  if(count($pgpgm_count1)>0)
                  {
                      $pgpgm_flag1=1;
                  }
       
                 $pgpgm_count2=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=2",[$appid]);
                $pgpgm_flag2=0;
                  if(count($pgpgm_count2)>0)
                  {
                      $pgpgm_flag2=1;
                  }
                 $pgpgm_count3=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=3",[$appid]);
                 $pgpgm_flag3=0;
                  if(count($pgpgm_count3)>0)
                  {
                      $pgpgm_flag3=1;
                  }
                  
                 $pgpgm_count4=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=4",[$appid]);
                 $pgpgm_flag4=0;
                  if(count($pgpgm_count4)>0)
                  {
                      $pgpgm_flag4=1;
                  }
                  
                 $pgpgm_count5=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=5",[$appid]);
                 $pgpgm_flag5=0;
                  if(count($pgpgm_count5)>0)
                  {
                      $pgpgm_flag5=1;
                  }
                  
                 $pgpgm_count6=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=6",[$appid]);
                 $pgpgm_flag6=0;
                  if(count($pgpgm_count6)>0)
                  {
                      $pgpgm_flag6=1;
                  }

                  // OPTION BLOCK ENDS

                //   return view('home', compact('pgapp', 'religion', 'community', 'caste', 'subcaste', 'pgquali', 
                //   'pgotherinfo', 'pgphoto', 'pgsign', 'pgqualicount', 'entireTableinc', 'centre_options', 
                //   'state', 'pgoptions', 'pgpgm_flag', 'flags', 'pgpgm1', 'pgpgm2', 'pgpgm3', 
                //   'pgopt1', 'pgopt2', 'pgopt3', 'ugquali', 'ugqualisubject', 'pgquali_exam', 
                //   'pgquali_subject', 'examcentre', 'examcent', 'pmodeoption', 'pflag'));



                // return view('2025.optionpage',compact('centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                //  ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6'));
             //   dd($flags);
        
    return view('home-reoption', compact('pgapp', 'religion', 'community', 'caste', 'subcaste', 'pgquali', 
    'pgotherinfo', 'pgphoto', 'pgsign', 'pgqualicount', 'entireTableinc', 'centre_options', 
    'state', 'pgoptions', 'pgpgm_flag', 'flags', 'pgpgm1', 'pgpgm2', 'pgpgm3', 
    'pgopt1', 'pgopt2', 'pgopt3', 'ugquali', 'ugqualisubject', 'pgquali_exam', 
    'pgquali_subject', 'examcentre', 'examcent', 'pmodeoption', 'pflag','centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                 ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6',
                 'fileUrl','fileUrlhse','fileUrlSpecial','category','special_file_record','pgapp_wh_special_reserv','fileUrlaadhar'


));
  
    }
    else{
     return view('auth.register'); 
    }

       }




    
// newly added for re-option close



    public function index_bkup()
    {
    
//        dd('sssss');
     
//      return view('unavailable');  
//        dd($this->payment_success_status());
        
     // return 'hello';
       if( ( $this->payment_status() > 0 ) && ( Auth::user()->pg_edit_appl == 0) ) {
        //return '1111111111111111hello';
           return redirect('pay_details');

       }
       else {
            
        $appid=Auth::user()->pgapp_id;
        $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
       // return $appid;

        $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
               return $pgapp;

                $adscsl='0';

        foreach($pgapp as $key){
            $adscsl=$key->pgapp_adsc_sl;
            $examcent=$key->pgapp_exam_centre;
        }
         // dd($adscsl);
        $centre_options =DB::connection('pgsql2')->select("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              public.tb_admncentre, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear='2024'",[$adscsl]);

      
             $count_centr=count($centre_options);
            if(($count_centr)==1)
            {
            $flags=1;
            } 
            else if(($count_centr)==2)
            {
            $flags=2;
            }
            if(($count_centr)==3)
            {

            $flags=3;

            }
            else if(($count_centr)==4)
            {
            $flags=4;
            }
            else if(($count_centr)==5)
            {
            $flags=5;
            }
                        
      

      if($adscsl==1037||$adscsl==1036 || $adscsl==1055 || $adscsl==1044||$adscsl==1052||$adscsl==1059)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[23]);  //except REGIONAL CAMPUS, THRISSUR 
      }
      else if($adscsl==1065)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[16]);  //except REGIONAL CAMPUS, THRISSUR 
      }
     
     
      else{
//      $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) ",[$adscsl]);  //except REGIONAL CAMPUS, THRISSUR     

// $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) and scst_renot_flag=?",[$adscsl,1]);

      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?,?)",[17,22]);  //except REGIONAL CAMPUS, THRISSUR  
//        dd($examcentre);
      
      }  
       
//               $examcentre=DB::select("select centre_sl,centre_name from tb_centre inner join admn22.asw_seatmatrix on centre_sl=centre"
//              . " where pgm in(?) ",[$adscsl]);  //except REGIONAL CAMPUS, THRISSUR    
//        if($adscsl==993)  {
           //     $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?)",[17]);  //except REGIONAL CAMPUS, THRISSUR  
               
        //       dd($examcentre);

       $pmodeoption= DB::table('tb_pg_projectmode')
                ->select('*')
                ->where('pgapp_id','=',$appid)
                ->get();
         $pflag=0;
         if(!$pmodeoption->isEmpty()){
             $pflag=1;
         }
        
        else{
             $pflag=0;
        }
       
       $entireTableinc=DB::select('select * from tb_income');
       if(true){
        $religion=DB::select("select relgn_sl,relgn_name from tb_religion  "); //original
       }
       else{
           
         $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?,?)",
                ['NO RELIGION','OTHERS','ISLAM','CHRISTIAN']); // for renotification  
       }

        $state=DB::select("select state_sl,state_name from tb_state ");
//        $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?)",
//                ['NO RELIGION','OTHERS','ISLAM']); // for renotification

       
//        $adscsl = Input::get('adscsl');
        //
//        dd($adscsl);
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
        $pgqualicount= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get()->count();
//       return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
      //  return $pgotherinfo;
//        $pgoptions= DB::table('tb_pg_pgpgm')
//                ->select('*')
//                ->where('pgpgm_pgapp_id','=',$appid)
//                ->get();
        
        $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,'
            . 'tb1.pg_entrance_centre,tb1.pgpgm_centre_sl from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

        $pgmselct=DB::select("select * from tb_pg_pgquali where  pgquali_pgapp_id=?",[$appid]);
        $pgquali_exam="";
        $pgquali_subject="";

        if(count($pgmselct)>0)
         
        {
            foreach($pgmselct as $key){
                $pgquali_exam=$key->pgquali_exam;
                $pgquali_subject=$key->pgquali_subject;

            }
        }
     //return $pgquali_subject;
//dd($pgoptions);
        $pgopt1="";
        $pgopt2="";
        $pgopt3="";
     $pgpgm1=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=1",[$appid]);
     if(count($pgpgm1)>0)
         
     {
       foreach($pgpgm1 as $key){
            $pgopt1=$key->pgpgm_centre_sl;
        }
     }
     $pgpgm2=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and pg_option=2",[$appid]);
     
        if(count($pgpgm2)>0)
         
     {
       foreach($pgpgm2 as $key){
             $pgopt2=$key->pgpgm_centre_sl;
        }
     }
     
     $pgpgm3=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=? and  pg_option=3",[$appid]);
  // return count($pgpgm3);
        if(count($pgpgm3)>0)
         
     {
       foreach($pgpgm3 as $key){
            $pgopt3=$key->pgpgm_centre_sl;
        }
     }
     
     if(Auth::user()->pgapp_adsc_sl==996){
       $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(42,43)"); 
       $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl  IN(104,105)');   
     }
     else{
      $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(11,14,15,18,22,23,24,25,26,27,28,33,34,38,39,40,42,44)"); 
      $ugqualisubject=DB::select('select * from tb_degqualisub where dqsub_sl NOT IN(104,105)');    
     }     
        
  $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
  
  
  if(count($pgpgm_count)>0)
  {
      $pgpgm_flag=1;
  }
  
  else
      
  {
       $pgpgm_flag=0;
  }
  
        
  
        $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
       date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");
        
        
        
    
//    if($adscsl==997||$adscsl==985||$adscsl==984||$adscsl==977||$adscsl==976||$adscsl==975||$adscsl==988||$adscsl==980||$adscsl==979||$adscsl==973||
//            $adscsl==972||$adscsl==969||$adscsl==970||$adscsl==971||$adscsl==986||$adscsl==984||$adscsl==985||$adscsl==986
//            ||$adscsl==995||$adscsl==989||$adscsl==993){
        
    if(true){    
     
        return view('home',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
             'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
             'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent','pmodeoption','pflag'));
  
    }
    else{
     return view('auth.register'); 
    }

       }
        
    }
 
    public function getoptioncopy()
    {
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        $option_stat=Auth::user()->option_stat;
      
            $centre_options =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              public.tb_admncentre, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear='2022'",[$adscsl]);
       
             $count_centr=count($centre_options);

            if(($count_centr)>2)
            {
                $flags=3;
            }
            elseif(($count_centr)==2)
            {
                $flags=2;
            }
            else
            {
                $flags=1;
            }


        $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
   
        if(count($pgpgm_count)>0)
        {
            $pgpgm_flag=1;
        }
        else
        {
             $pgpgm_flag=0;
        }   
            
        $rank = DB::select("select rank_appid,rank_rollno,rank_stud_name,rank_community,to_char(rank_dob,'DD-MM-YYYY') AS dob,adsc_name,
        t1.entrance_mark,t1.practical_mark,t1.indexmark,rank_adscsl,weight_mark,rank_phstatus,
        tb_pg_pgquali.ugcourse_status,tb_pg_pgquali.courseduration from tbz_pgranklist t1
        left join tb_admnscheme on rank_adscsl=adsc_sl left join tb_pgapp on rank_appid=pgapp_id 
         left join tb_pg_pgquali on tb_pgapp.pgapp_id =tb_pg_pgquali.pgquali_pgapp_id 
        where rank_appid=? order by rank",[$appid]);
                
        if(empty($rank)){
           return view('2022.404'); 
        }
        else{ 
         return view('2022.optionpage',compact('rank','centre_options','flags','pgpgm_flag','option_stat'));
        }
    }

    public function getoptionnew()
    {
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        $option_stat=Auth::user()->option_stat;
        $year=date('Y');
            $centre_options =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              admn22.asw_seatmatrix, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              asw_seatmatrix.pgm = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = asw_seatmatrix.centre  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear=? ",[$adscsl,2024]);
               $count_centr=count($centre_options);
            
               if(($count_centr)==8)
               {
                   $flags=8;
               }
               elseif(($count_centr)==7)
               {
                   $flags=7;
               }
               elseif(($count_centr)==6)
               {
                   $flags=6;
               }
               elseif(($count_centr)==5)
               {
                   $flags=5;
               }
               elseif(($count_centr)==4)
               {
                   $flags=4;
               }
               elseif(($count_centr)==3)
               {
                   $flags=3;
               }
              
               elseif(($count_centr)==2)
               {
                   $flags=2;
               }
               elseif(($count_centr)==1)
               {
                   $flags=1;
               }
               $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
   
               if(count($pgpgm_count)>0)
               {
                   $pgpgm_flag=1;
               }
               else
               {
                    $pgpgm_flag=0;
               }   
                   
               
                
                $pgpgm_count1=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=1",[$appid]);
                $pgpgm_flag1=0;
                  if(count($pgpgm_count1)>0)
                  {
                      $pgpgm_flag1=1;
                  }
       
                 $pgpgm_count2=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=2",[$appid]);
                $pgpgm_flag2=0;
                  if(count($pgpgm_count2)>0)
                  {
                      $pgpgm_flag2=1;
                  }
                 $pgpgm_count3=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=3",[$appid]);
                 $pgpgm_flag3=0;
                  if(count($pgpgm_count3)>0)
                  {
                      $pgpgm_flag3=1;
                  }
                  
                 $pgpgm_count4=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=4",[$appid]);
                 $pgpgm_flag4=0;
                  if(count($pgpgm_count4)>0)
                  {
                      $pgpgm_flag4=1;
                  }
                  
                 $pgpgm_count5=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=5",[$appid]);
                 $pgpgm_flag5=0;
                  if(count($pgpgm_count5)>0)
                  {
                      $pgpgm_flag5=1;
                  }
                  
                 $pgpgm_count6=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=6",[$appid]);
                 $pgpgm_flag6=0;
                  if(count($pgpgm_count6)>0)
                  {
                      $pgpgm_flag6=1;
                  }
                //dd($pgpgm_flag);

                return view('2025.optionpage',compact('centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                 ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6'));



    }


    public function getoptionnew24()
    {
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        $option_stat=Auth::user()->option_stat;
        $year=date('Y');
            $centre_options =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
            FROM 
              admn22.asw_seatmatrix, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              asw_seatmatrix.pgm = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = asw_seatmatrix.centre  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear=? ",[$adscsl,2024]);
//       $centre_options =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
//            FROM 
//              admn22.asw_seatmatrix, 
//              public.tb_admnscheme, 
//              public.tb_centre, 
//              public.tb_program
//            WHERE 
//              asw_seatmatrix.pgm = tb_admnscheme.adsc_sl AND
//              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
//              tb_centre.centre_sl = asw_seatmatrix.centre  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear=? and reopt_stat=?",[$adscsl,$year,1]);

            
//             dd($centre_options);
            
         //   dd($centre_options);
             $count_centr=count($centre_options);
            
            if(($count_centr)==8)
            {
                $flags=8;
            }
            elseif(($count_centr)==7)
            {
                $flags=7;
            }
            elseif(($count_centr)==6)
            {
                $flags=6;
            }
            elseif(($count_centr)==5)
            {
                $flags=5;
            }
            elseif(($count_centr)==4)
            {
                $flags=4;
            }
            elseif(($count_centr)==3)
            {
                $flags=3;
            }
           
            elseif(($count_centr)==2)
            {
                $flags=2;
            }
            elseif(($count_centr)==1)
            {
                $flags=1;
            }
            

//dd($flags);

        $pgpgm_count=DB::select("select * from tb_pg_pgpgm where  pgpgm_pgapp_id=?",[$appid]);
   
        if(count($pgpgm_count)>0)
        {
            $pgpgm_flag=1;
        }
        else
        {
             $pgpgm_flag=0;
        }   
            
        
         
         $pgpgm_count1=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=1",[$appid]);
         $pgpgm_flag1=0;
           if(count($pgpgm_count1)>0)
           {
               $pgpgm_flag1=1;
           }

          $pgpgm_count2=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=2",[$appid]);
         $pgpgm_flag2=0;
           if(count($pgpgm_count2)>0)
           {
               $pgpgm_flag2=1;
           }
          $pgpgm_count3=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=3",[$appid]);
          $pgpgm_flag3=0;
           if(count($pgpgm_count3)>0)
           {
               $pgpgm_flag3=1;
           }
           
          $pgpgm_count4=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=4",[$appid]);
          $pgpgm_flag4=0;
           if(count($pgpgm_count4)>0)
           {
               $pgpgm_flag4=1;
           }
           
          $pgpgm_count5=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=5",[$appid]);
          $pgpgm_flag5=0;
           if(count($pgpgm_count5)>0)
           {
               $pgpgm_flag5=1;
           }
           
          $pgpgm_count6=DB::select("select *,getcentrecode(pgpgm_centre_sl) as cent from tb_pg_pgpgm where pgpgm_pgapp_id=? and pg_option=6",[$appid]);
          $pgpgm_flag6=0;
           if(count($pgpgm_count6)>0)
           {
               $pgpgm_flag6=1;
           }
         //dd($pgpgm_flag);
        
        $rank = DB::select("select rank_appid,rank_rollno,rank_stud_name,rank_community,to_char(rank_dob,'DD-MM-YYYY') AS dob,adsc_name,
        t1.entrance_mark,t1.practical_mark,t1.indexmark,rank_adscsl,weight_mark,rank_phstatus,
        tb_pg_pgquali.ugcourse_status,tb_pg_pgquali.courseduration from tbz_pgranklist t1
        left join tb_admnscheme on rank_adscsl=adsc_sl left join tb_pgapp on rank_appid=pgapp_id 
         left join tb_pg_pgquali on tb_pgapp.pgapp_id =tb_pg_pgquali.pgquali_pgapp_id 
        where rank_appid=? order by rank",[$appid]);
        
        // $rank = DB::select("select *,pgapp_name as rank_stud_name, pgapp_id as rank_appid from tb_pgapp where pgapp_id =? ",[$appid]);
        
       // dd($rank);       
        if(empty($rank)){
          // return view('2022.404'); 
            return view('2022.optionpage',compact('rank','centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                 ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6'));
        }
        else{
//         return view('2022.optionclosed',compact('rank','centre_options','flags','pgpgm_flag','option_stat'));

         return view('2022.optionpage',compact('rank','centre_options','flags','pgpgm_flag','option_stat','pgpgm_flag1','pgpgm_flag2','pgpgm_flag3','pgpgm_flag4','pgpgm_flag5'
                 ,'pgpgm_flag6','pgpgm_count1','pgpgm_count2','pgpgm_count3','pgpgm_count4','pgpgm_count5','pgpgm_count6'));
        }
    }
    
    public function documentsupload()
    {
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        
        $rank = DB::select("select rank_appid,rank_rollno,rank_stud_name,rank_community,to_char(rank_dob,'DD-MM-YYYY') AS dob,adsc_name,
        t1.entrance_mark,t1.practical_mark,t1.indexmark,rank_adscsl,weight_mark,rank_phstatus,
        tb_pg_pgquali.ugcourse_status,tb_pg_pgquali.courseduration from tbz_pgranklist t1
        left join tb_admnscheme on rank_adscsl=adsc_sl left join tb_pgapp on rank_appid=pgapp_id 
         left join tb_pg_pgquali on tb_pgapp.pgapp_id =tb_pg_pgquali.pgquali_pgapp_id 
        where rank_appid=? order by rank",[$appid]);
//         dd($rank);       
        if(empty($rank)){
           return view('2022.404'); 
        }
        else{ 
         return view('2022.documentsupload',compact('rank'));
        }
    }
    
    public function store_documents(Request $request){
        $appid=Auth::user()->pgapp_id;
//        dd($appid);
       $validation =  request()->validate([
                           'doc' => 'required|mimes:pdf|max:2048'
                         ]); 
      
        if($request->hasFile('doc')){
//            dd($appid);     
            $file = $request->file('doc');
//            dd($file);
            $filename=Auth::user()->pgapp_id.'-' . str_replace(' ', '', $file->getClientOriginalName());
            $directory = 'Candidate-Certificates'.'/'.Auth::user()->pgapp_id;
            $thumbnail = null;

            // create directory if not exist
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Store to disk
                $storage= Storage::disk('public')->putFileAs($directory, $file , $filename, 'public');
                
                $file->move($directory,$filename);
                $user = User::where('pgapp_sl', Auth::id())->first();
                $data =  tap($user)->update([
                            'directory_docs' => $storage,

                ]);
                                       
        }
        else{
            $user = User::where('pgapp_sl', Auth::id())->first();
             $data =  tap($user)->update([
                            'directory_docs' => NULL,

                        ]);
        }
        return response()->json(['message' => "Successfully uploaded"]);
    }
 
    public function getoption()
    {
        $appid=Auth::user()->pgapp_id;
        $adscsl=Auth::user()->pgapp_adsc_sl;
        $option_stat=Auth::user()->option_stat;
      
        $pgadm=DB::select("select * from asw_pgadm inner join tb_pgapp on adm_appid=pgapp_id where pgapp_id=?",[$appid]);
        foreach($pgadm as $key){
            $cent=$key->adm_centid;
        }
        
            $centre_options =DB::SELECT("SELECT sh_reopt_cent as centre_sl,tb_centre.centre_name ,sh_reopt_cent,getcentrename(sh_reopt_cent) as centre_name
            FROM 
              admn22.asw_pgm_centre_shortfall, 
              public.tb_admnscheme, 
              public.tb_centre, 
              public.tb_program
            WHERE 
              asw_pgm_centre_shortfall.sh_pgm = tb_admnscheme.adsc_sl AND
              tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
              tb_centre.centre_sl = asw_pgm_centre_shortfall.sh_adm_cent  AND  tb_admnscheme.adsc_sl=? and sh_adm_cent=?
              AND tb_admnscheme.adsc_admnyear='2022'",[$adscsl,$cent]);
       
             $count_centr=count($centre_options);

            if(($count_centr)>2)
            {
                $flags=3;
            }
            elseif(($count_centr)==2)
            {
                $flags=2;
            }
            else
            {
                $flags=1;
            }

//dd($flags);
        $pgpgm_count=DB::select("select * from tb_shortfall_reoption where  pgpgm_pgapp_id=?",[$appid]);
   
        if(count($pgpgm_count)>0)
        {
            $pgpgm_flag=1;
        }
        else
        {
             $pgpgm_flag=0;
        }   
            
        $rank = DB::select("select rank_appid,rank_rollno,rank_stud_name,rank_community,to_char(rank_dob,'DD-MM-YYYY') AS dob,adsc_name,
        t1.entrance_mark,t1.practical_mark,t1.indexmark,rank_adscsl,weight_mark,rank_phstatus,
        tb_pg_pgquali.ugcourse_status,tb_pg_pgquali.courseduration from tbz_pgranklist t1
        left join tb_admnscheme on rank_adscsl=adsc_sl left join tb_pgapp on rank_appid=pgapp_id 
         left join tb_pg_pgquali on tb_pgapp.pgapp_id =tb_pg_pgquali.pgquali_pgapp_id 
        where rank_appid=? order by rank",[$appid]);
                
        if(empty($rank)){
           return view('2022.404'); 
        }
        else{ 
         return view('2022.optionpage',compact('rank','centre_options','flags','pgpgm_flag','option_stat'));
        }
    }
 
     public function editpg()
    {
         $appid=Auth::user()->pgapp_id;
         $data=User::where('pgapp_id',$appid)
                      
                      ->update([
                        
                         'pg_edit_appl'=>1,
                         
            ]);
         return redirect()->route('home');
        
    }

  
    
    public function religion(Request $request)
    { 
    
        $data = $request->input('formData');
        $adscsl=Auth::user()->pgapp_adsc_sl;
//dd($adscsl);
        if(true){
          $result=DB::select("select distinct(community) as community from tbz_reservation_list where religion=? order by community ",[$data]);  
        }
        else{
          $result=DB::select("select distinct(community) from tbz_reservation_list where religion=? and community in(?,?)",[$data,'SC','ST']);
  
        }
        
            
        
//    return $result;
            $htmlcent = "<class=\"col-sm-8\" id=\"commdiv\" name=\"commdiv\">
            <select class=\"form-control form-control-sm select2 col-md-8\" id= \"pgapp_community\" name=\"pgapp_community\"onchange=\"commchange()\">
                                          <option value=\"\" >
                                        --Select--
                                   </option>";
          foreach ($result as $cntr) {
         $community=$cntr->community;
        if($cntr->community=='EWS') $community='GENERAL-'.$cntr->community;
         if($cntr->community=='E/T/B') $community='EZHAVA/THIYYA/BILLAVA ('.$cntr->community.')';
        
               $htmlcent .= "<option value=\"" . $cntr->community . "\" class=\"col-md-12\">" . $community . "</option>";
           }
          $htmlcent .= "</select><span id=\"error_community\" class=\"text-danger\"></span></div>";
       
//         dd($htmlcent);
         return $htmlcent;
    }
    
     public function state(Request $request)
    { 
    
        $data = $request->input('formData');

        $result=DB::select("select distinct(district) from tb_districts where state=? ",[$data]);
//    return $result;
            $htmlcent = "<class=\"col-sm-8\" id=\"districtdiv\" name=\"districtdiv\">
            <select class=\"form-control select2 col-md-8\" id= \"pgapp_district\" name=\"pgapp_district\"onchange=\"dischangechange()\">
                                          <option value=\"\" >
                                        --Select--
                                   </option>";
          foreach ($result as $cntr) {
               $htmlcent .= "<option value=\"" . $cntr->district . "\" class=\"col-md-12\">" . $cntr->district . "</option>";
           }
          $htmlcent .= "</select></div>";
       
//         dd($htmlcent);
         return $htmlcent;
    }
    

    public function community(Request $request)
    { 
             $community = $request->input('cmty');
             $religion = $request->input('relgn');


            $result_1=DB::select("select subcaste,id from tbz_reservation_list where community=? AND religion=? ORDER BY subcaste",[$community,$religion]);

            //dd($result_1);
                        $htmlcent = "<class=\"col-sm-4\" id=\"castediv\" name=\"castediv\">
                        <select class=\"form-control form-control-sm select2 col-md-8\"  id= \"pgapp_caste_sl\" name=\"pgapp_caste_sl\" >
                        <option value=\"\" >
                                  --Select--
                        </option>";
                foreach ($result_1 as $cntr) 
                    {
                        $htmlcent .= "<option value=\"" . $cntr->id . "\" class=\"col-md-12\">" . $cntr->subcaste . "</option>";
                    }
                        $htmlcent .= "</select><span id=\"error_caste\" class=\"text-danger\"></span></div>";
//      dd($html);
                        return $htmlcent;
         
    }


//subcaste

public function subcaste(Request $request)
{ 
    $caste = $request->input('caste');
    $religion = $request->input('relgn');

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

    public function store(Request $request){
        $appid=Auth::user()->pgapp_id;
   
     //dd($request->all());
         $validatedData = $request->validate([
                'pgapp_nationality' => 'required',
                'pgapp_religion' => 'required',
                'pgapp_community' => 'required',
                'pgapp_caste_sl' => 'required',
                'pgapp_father' => 'required',
                'comm_addressline1' => 'required',
                'comm_addressline2' => 'required',
                'comm_addressline3' => 'required',
                'per_addressline1' => 'required',
                'per_addressline2' => 'required',
                'per_addressline3' => 'required',
                'pgapp_pincode' => 'required',
                'pgapp_district' => 'required',
                'pgapp_state' => 'required',
               // 'pgapp_category' => 'required',
            ], [
                'pgapp_nationality.required' => 'Nationality is required',
                
            ]);
        $pgapp_nationality= $request->pgapp_nationality;
        $pgapp_religion= $request->pgapp_religion;
        $pgapp_community= $request->pgapp_community;
        $pgapp_caste_sl= $request->pgapp_caste_sl;
//        $subcaste= $request->pgapp_subcaste_sl;
        $pgapp_father= $request->pgapp_father;
        $comm_addressline1=$request->comm_addressline1;
        $comm_addressline2=$request->comm_addressline2;
        $comm_addressline3=$request->comm_addressline3;
        $per_addressline1=$request->per_addressline1;
        $per_addressline2=$request->per_addressline2;
        $per_addressline3=$request->per_addressline3;
        $pgapp_pincode=$request->pgapp_pincode;
        $pgapp_landphone=$request->pgapp_landphone;
        $pgapp_district=$request->pgapp_district;
        $pgapp_state=$request->pgapp_state;
       //  $pgapp_category=$request->pgapp_category;
        $caste_reservation=$request->caste_reservation;

        
        DB::update('update tb_pgapp set pgapp_nationality=?,pgapp_religion=?,pgapp_community=?,
        pgapp_caste_sl=?,pgapp_father=?,pgapp_status=?,comm_addressline1=?,comm_addressline2=?,comm_addressline3=?,
        per_addressline1=?,per_addressline2=?,per_addressline3=?,pgapp_pincode=?,pgapp_landphone=?,pgapp_district=?,pgapp_state=?,pgapp_category=get_main_reserv_group(?),reservation_claim_status=? where pgapp_id=?',
        [$pgapp_nationality,$pgapp_religion,$pgapp_community,$pgapp_caste_sl,$pgapp_father,1,$comm_addressline1,$comm_addressline2,$comm_addressline3,$per_addressline1,
            $per_addressline2,$per_addressline3,$pgapp_pincode,$pgapp_landphone,$pgapp_district,$pgapp_state,$pgapp_caste_sl,$caste_reservation,$appid]);
        
        
        
        return response()->json(["status"=>"Personal Information saved successfully"]);
       
    }
   
    public function storepersonal_data(Request $request){
        $appid=Auth::user()->pgapp_id;
       
         $validatedData = $request->validate([
                'pgapp_nationality' => 'required',
                'pgapp_religion' => 'required',
                'pgapp_community' => 'required',
                'pgapp_caste_sl' => 'required',
                'pgapp_father' => 'required',
                'comm_addressline1' => 'required',
                'comm_addressline2' => 'required',
                'comm_addressline3' => 'required',
                'per_addressline1' => 'required',
                'per_addressline2' => 'required',
                'per_addressline3' => 'required',
                'pgapp_pincode' => 'required',
                'pgapp_district' => 'required',
                'pgapp_state' => 'required',
            ], [
                'pgapp_nationality.required' => 'Nationality is required',
                
            ]);
        $pgapp_nationality= $request->pgapp_nationality;
        $pgapp_religion= $request->pgapp_religion;
        $pgapp_community= $request->pgapp_community;
        $pgapp_caste_sl= $request->pgapp_caste_sl;
//        $subcaste= $request->pgapp_subcaste_sl;
        $pgapp_father= $request->pgapp_father;
        $comm_addressline1=$request->comm_addressline1;
        $comm_addressline2=$request->comm_addressline2;
        $comm_addressline3=$request->comm_addressline3;
        $per_addressline1=$request->per_addressline1;
        $per_addressline2=$request->per_addressline2;
        $per_addressline3=$request->per_addressline3;
        $pgapp_pincode=$request->pgapp_pincode;
        $pgapp_landphone=$request->pgapp_landphone;
        $pgapp_district=$request->pgapp_district;
        $pgapp_state=$request->pgapp_state;
        
        DB::update('update tb_pgapp set pgapp_nationality=?,pgapp_religion=?,pgapp_community=?,
        pgapp_caste_sl=?,pgapp_father=?,pgapp_status=?,comm_addressline1=?,comm_addressline2=?,comm_addressline3=?,
        per_addressline1=?,per_addressline2=?,per_addressline3=?,pgapp_pincode=?,pgapp_landphone=?,pgapp_district=?,pgapp_state=? where pgapp_id=?',
        [$pgapp_nationality,$pgapp_religion,$pgapp_community,$pgapp_caste_sl,$pgapp_father,1,$comm_addressline1,$comm_addressline2,$comm_addressline3,$per_addressline1,
            $per_addressline2,$per_addressline3,$pgapp_pincode,$pgapp_landphone,$pgapp_district,$pgapp_state,$appid]);
        
        
        
        return response()->json(["status"=>"Personal Information saved successfully"]);
       
    }
    public function store_quali(Request $request){
       // dd($request->all())
  
        $appid=Auth::user()->pgapp_id;
  
        $ugcourse_status= $request->ugcourse_status;
        $sslc_regno=$request->sslc_regno;
        $sslc_mark=$request->sslc_mark;
        $pgquali_institute= $request->pgquali_institute;
        $pgquali_university= $request->pgquali_university;
        $pgquali_subject= $request->pgquali_subject;
        $pgquali_year= $request->pgquali_year;
        $pgquali_grade=$request->pgquali_grade;
        $pgquali_exam=$request->pgquali_exam;
        $regnodegree=$request->regnodegree;
        $courseduration=$request->courseduration;
        $degree_aggregate=$request->degree_aggregate;
        $coursetype=$request->coursetype;
        $pgquali_endyear=$request->pgquali_endyear;
        $degree_other_sub=$request->other_degree;
       // dd($degree_other_sub);
        $query1=DB::table('tb_pg_pgquali')->select('pgquali_pgapp_id')->where('pgquali_pgapp_id','=',$appid)->get();
//      dd($query1)
        if(count($query1)>0)
        {
            DB::update('update tb_pg_pgquali set pgquali_pgapp_id=?,pgquali_institute=?,pgquali_university=?,pgquali_subject=?,
                  pgquali_year=?,pgquali_grade=?,pgquali_exam=?,sslc_regno=?,sslc_mark=?,courseduration=?,regnodegree=?,
                  degree_aggregate=?,ugcourse_status=?,coursetype=?,pgquali_endyear=?, degree_other_sub=? where pgquali_pgapp_id=?',
                  [$appid,$pgquali_institute,$pgquali_university,$pgquali_subject,$pgquali_year,$pgquali_grade,$pgquali_exam,
                   $sslc_regno,$sslc_mark,$courseduration,$regnodegree,$degree_aggregate,$ugcourse_status,$coursetype,$pgquali_endyear,$degree_other_sub,$appid]);  
        }
        else
        { 
            DB::insert('insert into tb_pg_pgquali (pgquali_pgapp_id,pgquali_institute,
            pgquali_university,pgquali_subject,pgquali_year,pgquali_grade,pgquali_exam,sslc_regno,sslc_mark,courseduration,
            regnodegree,degree_aggregate,ugcourse_status,coursetype,pgquali_endyear,degree_other_sub)
            values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [$appid,$pgquali_institute,$pgquali_university,$pgquali_subject,$pgquali_year,$pgquali_grade,$pgquali_exam
                     ,$sslc_regno,$sslc_mark,$courseduration,$regnodegree,$degree_aggregate,$ugcourse_status,$coursetype,
                     $pgquali_endyear,$degree_other_sub]);
        }
       
        DB::update('update tb_pgapp set ugcourse_status=? where pgapp_id=?',[$ugcourse_status,$appid]);
        if($coursetype=='SEMESTER WISE'){
          $items = $this->getMarkList($appid, $ugcourse_status, $courseduration);
         // dd($items);
          $v="Sem";
          $n="name";
        }
        else if($coursetype=='YEAR WISE'){
          $items = $this->getMarkListYear($appid, $ugcourse_status, $courseduration);
          $v="Year";
          $n="yr";
        }

//        dd(($items));
       
        $html='';
        for ($i=1;$i<=count($items);$i++){
//            dump($items[$i]);
            $html.= '<div class="col-6"><label class="control-label" >SGPA / Percentage of '.$v.' '.$i.' (Those who do not have data in the following given fields are not eligible to apply)</label><input type="text" placeholder="Enter" class=" form-control form-control-sm col-md-9 name_input" id="'.$n.'_'.$i.'" name="'.$n.'_'.$i.'" value="'.$items[$i].'"></div>';
        }
//      
        return response()->json(["status"=>"Educational Qualifications Saved Successfully","pgquali_subject"=>$pgquali_subject,
            "pgquali_year"=>$pgquali_year,"pgquali_endyear"=>$pgquali_endyear,"coursetype"=>$coursetype,"pgquali_exam"=>$pgquali_exam,"courseduration"=>$courseduration,
            "ugcourse_status"=>$ugcourse_status,"html"=>$html]);      
    }
    
    private function getMarkList($appid, $ugcourse_status, $courseduration){
        $query1=DB::table('tb_pg_pgquali')->select('*')->where('pgquali_pgapp_id','=',$appid)->first();
//dd($query1);
        $items = array();
         $x=0;
        if($ugcourse_status){
            $x=2;
        }

       // dd($x);
        
        for($i=1;$i<=($courseduration*2-$x);$i++){
         $mark = 'mark_sem'.$i;  
         $items[$i] = $query1->$mark;
        }
        
        return $items;
    }
    
    private function getMarkListYear($appid, $ugcourse_status, $courseduration){
        $query1=DB::table('tb_pg_pgquali')->select('*')->where('pgquali_pgapp_id','=',$appid)->first();
//dd($query1);
        $items = array();
         $x=0;
        if($ugcourse_status){
            $x=1;
        }
        
        for($i=1;$i<=($courseduration-$x);$i++){
         $mark = 'mark_year'.$i;  
         $items[$i] = $query1->$mark;
        }
        
        return $items;
    }
    
    public function storesemester(Request $request){
  
        $appid=Auth::user()->pgapp_id;
       
        $mark_sem1= $request->name_1;
        $mark_sem2=$request->name_2;
        $mark_sem3=$request->name_3;
        $mark_sem4= $request->name_4;
        $mark_sem5= $request->name_5;
        $mark_sem6= $request->name_6;
        $mark_sem7= $request->name_7;
        $mark_sem8=$request->name_8;
        $mark_sem9= $request->name_9;
        $mark_sem10=$request->name_10;
        
        $mark_year1= $request->yr_1;
        $mark_year2=$request->yr_2;
        $mark_year3=$request->yr_3;
        $mark_year4= $request->yr_4;
        $mark_year5= $request->yr_5;
        
        $query1=DB::table('tb_pg_pgquali')->select('pgquali_pgapp_id')->where('pgquali_pgapp_id','=',$appid)->get();
      
        if(count($query1)>0)
        {
            DB::update('update tb_pg_pgquali set mark_sem1=?,mark_sem2=?,mark_sem3=?,mark_sem4=?,
                mark_sem5=?,mark_sem6=?,mark_sem7=?,mark_sem8=?,mark_sem9=?,mark_sem10=?,mark_year1=?,mark_year2=?,mark_year3=?,mark_year4=?,mark_year5=? where pgquali_pgapp_id=?',
              [$mark_sem1,$mark_sem2,$mark_sem3,$mark_sem4,$mark_sem5,$mark_sem6,$mark_sem7,$mark_sem8,$mark_sem9,$mark_sem10,$mark_year1,$mark_year2,$mark_year3,$mark_year4,$mark_year5,$appid]);  
        }
        else
        { 
            DB::insert('insert into tb_pg_pgquali (mark_sem1,mark_sem2,
            mark_sem3,mark_sem4,mark_sem5,mark_sem6,mark_sem7,mark_sem8,mark_sem9,mark_sem10,mark_year1,mark_year2,mark_year3,mark_year4,mark_year5)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [$mark_sem1,$mark_sem2,$mark_sem3,$mark_sem4,$mark_sem5,$mark_sem6,$mark_sem7,$mark_sem8,$mark_sem9,$mark_sem10,$mark_year1,$mark_year2,$mark_year3,$mark_year4,$mark_year5
                     ]);
        }
       
        return response()->json(["status"=>"Semester details Saved Successfully"]);      
    }
    
    
    public function store_pmodestream(Request $request) {
        $adscsl=Auth::user()->pgapp_adsc_sl; 
        $appid=Auth::user()->pgapp_id;

        $course1= $request->course1;
        $course2= $request->course2;
        $course3= $request->course3;
        $course4= $request->course4;
        
        $opt1=1;
        $opt2=2;
        $opt3=3;
        $opt4=4;
       $option=DB::select("select * from tb_pg_projectmode where pgapp_id=?",[$appid]);


        if(count($option)==0)
        {
                DB::insert('insert into tb_pg_projectmode (pgapp_id,p_adsc_sl,p_stream,p_option)VALUES(?,?,?,?)',
                        [$appid,$adscsl,$course1,$opt1]);
                DB::insert('insert into tb_pg_projectmode (pgapp_id,p_adsc_sl,p_stream,p_option)VALUES(?,?,?,?)',
                        [$appid,$adscsl,$course2,$opt2]);
                DB::insert('insert into tb_pg_projectmode (pgapp_id,p_adsc_sl,p_stream,p_option)VALUES(?,?,?,?)',
                        [$appid,$adscsl,$course3,$opt3]);
                DB::insert('insert into tb_pg_projectmode (pgapp_id,p_adsc_sl,p_stream,p_option)VALUES(?,?,?,?)',
                        [$appid,$adscsl,$course4,$opt4]);
        }
        else{
            DB::update('update tb_pg_projectmode set p_stream=? where p_option=? and pgapp_id=?',
                   [$course1,$opt1,$appid]);
            DB::update('update tb_pg_projectmode set p_stream=? where p_option=? and pgapp_id=?',
                   [$course2,$opt2,$appid]);
            DB::update('update tb_pg_projectmode set p_stream=? where p_option=? and pgapp_id=?',
                   [$course3,$opt3,$appid]);
            DB::update('update tb_pg_projectmode set p_stream=? where p_option=? and pgapp_id=?',
                   [$course4,$opt4,$appid]);
        }
        
        return response()->json(["status"=>"Options saved successfully"]);
       
    }


    public function store_otherinfo(Request $request){
        
        $appid=Auth::user()->pgapp_id;
        $center_slexam= $request->center_slexam;
        
        $query=DB::table('tb_pgapp')->select('pgapp_sl')->where('pgapp_id','=',$appid)->get();
 
        foreach($query as $key){
            $pgapp_sl=$key->pgapp_sl;
      
        }
        $ph_status=$request->ph_status;
        $ph_type=$request->ph_type;
    
        $pgapp_inc_sl= $request->pgapp_inc_sl;
        $pgapp_wh_special_reserv= $request->pgapp_wh_special_reserv;
        $pgapp_nss= $request->pgapp_nss;
        $pgapp_ncc= $request->pgapp_ncc;
        $pgapp_arts= $request->pgapp_arts;
        $pgapp_sports= $request->pgapp_sports;
        $pgapp_sp_resrve= $request->pgapp_sp_resrve;
 
        $sql = DB::table('tbz_pgotherinfo')->select('pgotherinfo_appid','pgapp_sl_ref')->where('pgotherinfo_appid',$appid)->get();  

        if($sql->isEmpty()){
            DB::insert('insert into tbz_pgotherinfo(pgapp_sl_ref,pgotherinfo_appid,ph_status,ph_type,
                pgapp_inc_sl,pgapp_wh_special_reserv,pgapp_nss,pgapp_ncc,pgapp_arts,pgapp_sports,pgapp_sp_resrve)
                values(?,?,?,?,?,?,?,?,?,?,?)',
        [$pgapp_sl,$appid,$ph_status,$ph_type,
            $pgapp_inc_sl,$pgapp_wh_special_reserv,$pgapp_nss,$pgapp_ncc,$pgapp_arts,$pgapp_sports,$pgapp_sp_resrve]);
        
       
           
        }
        else{
            DB::table('tbz_pgotherinfo')
               ->where('pgotherinfo_appid',$appid)->where('pgapp_sl_ref',$pgapp_sl)
               ->update(['pgotherinfo_appid' => $appid,
                              'pgapp_sl_ref'=> $pgapp_sl,
                              'ph_status'=> $ph_status,
                              'ph_type'=> $ph_type,
                             'pgapp_wh_special_reserv'=> $pgapp_wh_special_reserv,
                             'pgapp_nss'=> $pgapp_nss,
                   'pgapp_ncc'=> $pgapp_ncc,
                   'pgapp_arts'=> $pgapp_arts,
                   'pgapp_sports'=> $pgapp_sports,
                    'pgapp_inc_sl'=>$pgapp_inc_sl,
                      'pgapp_sp_resrve'=>$pgapp_sp_resrve,     
                             
                              ]);
            
        }
         
        DB::update('update tb_pgapp set pgapp_exam_centre=? where pgapp_id=?', [$center_slexam,$appid]);   
        
        return response()->json(["status"=>"Other Informations Saved Successfully"]);
    }
   
   
    public function store_image(Request $request){
       $validation = Validator::make($request->all(), 
         [
             'pgapp_photo' => 'required|mimes:jpg,jpeg|max:50|min:20',
            
             ],
         [   
            'pgapp_photo.required'  => 'Please select your photo',
            'pgapp_photo.mimes'     => 'The selected photo must be jpg or jpeg',
            'pgapp_photo.max'       => 'Max photo size is 50kb',
            'pgapp_photo.min'       => 'Min photo size is 20kb',

         ]
    );
     
   
     if($validation->passes())
     {  
        $appid=Auth::user()->pgapp_id;
         if ($request->hasFile('pgapp_photo')) {
                 
                    $file = $request->file('pgapp_photo'); // will get all files
                    $extension = $file->getClientOriginalExtension(); //Get file original name
                    $file_name=$appid.'.'.$extension;
                    $file->move('images/pgphoto',$file_name);
//                    return $file_name;
                }
                else{
                    $file_name='';
                }
       
       
        DB::update('update tb_pgapp set pgapp_photo=? where pgapp_id=?',[$file_name,$appid]);
//        return "saved successfully";
        return response()->json([
       'message'   => 'File Upload Successfully',
       'status'=>1,
       'uploaded_image' => $file_name,
       'class_name'  => 'alert-success'
      ]);
    }
    else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_image' => '',
       'status'=>0,
       'class_name'  => 'alert-danger'
      ]);
     }
    }
    
    public function store_sign(Request $request){
       $validation = Validator::make($request->all(), 
         [
             'pgapp_sign' => 'required|mimes:jpg,jpeg|max:30|min:10',
            
             ],
         [   
            'pgapp_sign.required'  => 'Please select your signature',
            'pgapp_sign.mimes'     => 'The selected photo must be jpg or jpeg',
            'pgapp_sign.max'       => 'Max photo size is 30kb',
            'pgapp_sign.min'       => 'Min photo size is 10kb',

         ]
    );
     
   
     if($validation->passes())
     {  
        $appid=Auth::user()->pgapp_id;
         if ($request->hasFile('pgapp_sign')) {
                 
                    $file = $request->file('pgapp_sign'); // will get all files
                    $extension = $file->getClientOriginalExtension(); //Get file original name
                    $file_name1=$appid.'.'.$extension;
                    $file->move('images/pgsign',$file_name1);
//                    return $file_name;
                }
                else{
                    $file_name1='';
                }
       
       
        DB::update('update tb_pgapp set pgapp_sign=? where pgapp_id=?',[$file_name1,$appid]);
//        return "saved successfully";
        return response()->json([
       'message'   => 'Signature Upload Successfully',
       'status'=>1,
       'uploaded_sign' => $file_name1,
       'class_name'  => 'alert-success'
      ]);
    }
    else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_sign' => '',
       'status'=>0,
       'class_name'  => 'alert-danger'
      ]);
     }
    }
    
    public function centopt1(Request $request)

    {
           $appid=Auth::user()->pgapp_id; 
            //        dd($appid);
            $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
        //  dd($pgappall);
               foreach ($pgappall as $key)
                {
                    $pgmsl=$key->pgapp_adsc_sl;
                }
            $cent_opt = $request->input('cent1');

//            dd($pgmsl);
            //return $cent_opt;   
            // $centrop=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
            //     where  centre NOT IN(?) and pgm=? ",[$cent_opt,$pgmsl]);

                $centrop=DB::select(" SELECT tb_centre.centre_sl,tb_centre.centre_name 
                FROM 
                public.tb_admncentre, 
                public.tb_admnscheme, 
                public.tb_centre, 
                public.tb_program
                WHERE 
                tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
                tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
                tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  
                tb_admnscheme.adsc_admnyear=EXTRACT(YEAR FROM CURRENT_DATE) AND centre_sl NOT IN(?) and adsc_sl = ? ",[$cent_opt,$pgmsl]);

                



            // dd( $centrop) ;
            if(count($centrop)>0)
            {

            $htmlcent = "<div class=\"\"  id=\"cdiv2\" id=\"cdiv2\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus II :</label>
            <select  id= \"center_sl2\" name=\"center_sl2\"  class=\"form-control form-control-sm select2 col-md-8\" onchange=\"centropt2()\">
            <option value=\"\" selected disabled >  Select Centre II </option>";
            foreach ($centrop as $cntr) 
            {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
            }
            $htmlcent .= "</select></div></div>";
            return $htmlcent;
            } 
            else
            {
            }      

   }
   
    public function centopt1shortfall(Request $request)
    {
           $appid=Auth::user()->pgapp_id; 
                     //dd($appid);
            $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
          //dd($pgappall);
               foreach ($pgappall as $key)
                {
                    $pgmsl=$key->pgapp_adsc_sl;
                }
            $cent_opt = $request->input('cent1');
//            dd($cent_opt);
           // return $cent_opt;   
            $centrop=DB::select("SELECT distinct getcentrename(sh_reopt_cent) as centre_name,sh_reopt_cent as centre_sl FROM admn22.asw_pgm_centre_shortfall
                where  sh_reopt_cent NOT IN(?) and sh_pgm=?",[$cent_opt,$pgmsl]);
     
             //dd( $centrop) ;
            if(count($centrop)>0)
            {

            $htmlcent = "<div class=\"\"  id=\"cdiv2\" id=\"cdiv2\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus II :</label>
            <select  id= \"center_sl2\" name=\"center_sl2\"  class=\"form-control form-control-sm select2 col-md-8\" onchange=\"centropt2()\">
            <option value=\"\" selected disabled >  Select Centre II </option>";
            foreach ($centrop as $cntr) 
            {
            $htmlcent .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
            }
            $htmlcent .= "</select></div></div>";
            return $htmlcent;
            } 
            else
            {
            }      

   }
    public function centopt2(Request $request)
    {
       // if($appid=='ADMPG2402347'){}
//        $year=2022;
        $cent_opt = $request->input('cent1');
        $cent_opt2 = $request->input('cent2');
        $appid=Auth::user()->pgapp_id; 
//          dd($cent_opt2);
        $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
        foreach ($pgappall as $key)
        {
        $pgmsl=$key->pgapp_adsc_sl;
        }
        $centrop2=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
                where  centre NOT IN(?,?) and pgm=?",[$cent_opt,$cent_opt2,$pgmsl]); // original
        
//        $centrop2=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
//                where  centre NOT IN(?,?) and pgm=? and reopt_stat=?",[$cent_opt,$cent_opt2,$pgmsl,1]); // for reoption


$centrop2=DB::select(" SELECT tb_centre.centre_sl,tb_centre.centre_name 
FROM 
public.tb_admncentre, 
public.tb_admnscheme, 
public.tb_centre, 
public.tb_program
WHERE 
tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  
tb_admnscheme.adsc_admnyear=EXTRACT(YEAR FROM CURRENT_DATE) AND centre_sl NOT IN(?,?) and adsc_sl = ? ",[$cent_opt,$cent_opt2,$pgmsl]);

//dd($centrop2);


        
//        $centrop2=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre, 
//        public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl 
//        AND adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
//        AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? 
//        AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);      
//        dd($centrop2);
        if(count($centrop2)>0)
        {
        $htmlcent2 = "<div class=\"\"  id=\"cdiv3\" id=\"cdiv3\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus III :</label>
          
        <select id= \"center_sl3\" name=\"center_sl3\" class=\"form-control form-control-sm select2 col-sm-8\" onchange=\"centropt3()\">
        <option value=\"\" selected disabled >  Select Centre III </option>";
        foreach ($centrop2 as $cntr) {
        $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
        $htmlcent2 .= "</select></div></div>";
        return  $htmlcent2;
        }
          else
        {
          }      

     }
     
    public function centopt3(Request $request)
    {
        $cent_opt = $request->input('cent1');
        $cent_opt2 = $request->input('cent2');
        $cent_opt3 = $request->input('cent3');
        $appid=Auth::user()->pgapp_id; 
//          dd($cent_opt2);
        $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
        foreach ($pgappall as $key)
        {
        $pgmsl=$key->pgapp_adsc_sl;
        }
        
        $centrop2=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
                where  centre NOT IN(?,?,?) and pgm=?",[$cent_opt,$cent_opt2,$cent_opt3,$pgmsl]); // original


$centrop2=DB::select(" SELECT tb_centre.centre_sl,tb_centre.centre_name 
FROM 
public.tb_admncentre, 
public.tb_admnscheme, 
public.tb_centre, 
public.tb_program
WHERE 
tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  
tb_admnscheme.adsc_admnyear=EXTRACT(YEAR FROM CURRENT_DATE) AND centre_sl NOT IN(?,?,?) and adsc_sl = ? ",[$cent_opt,$cent_opt2,$cent_opt3,$pgmsl]);



        
//        $centrop2=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
//                where  centre NOT IN(?,?,?) and pgm=? and reopt_stat=?",[$cent_opt,$cent_opt2,$cent_opt3,$pgmsl,1]); // for reoption
        
//        $centrop2=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre, 
//        public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl 
//        AND adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
//        AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? 
//        AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);      
//        dd($centrop2);
        if(count($centrop2)>0)
        {
        $htmlcent2 = "<div class=\"\"  id=\"cdiv4\" id=\"cdiv4\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus IV :</label>
          
        <select  id= \"center_sl4\" name=\"center_sl4\" class=\"form-control form-control-sm select2 col-sm-8\" onchange=\"centropt4()\" >
        <option value=\"\" selected disabled >  Select Centre IV </option>";
        foreach ($centrop2 as $cntr) {
        $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
        $htmlcent2 .= "</select></div></div>";
        return  $htmlcent2;
        }
          else
        {
          }      

     } 
    public function centopt4(Request $request)
    {
        $cent_opt = $request->input('cent1');
        $cent_opt2 = $request->input('cent2');
        $cent_opt3 = $request->input('cent3');
        $cent_opt4 = $request->input('cent4');
        $appid=Auth::user()->pgapp_id; 
//          dd($cent_opt2);
        $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
        foreach ($pgappall as $key)
        {
        $pgmsl=$key->pgapp_adsc_sl;
        }
        $centrop2=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
                where  centre NOT IN(?,?,?,?) and pgm=?",[$cent_opt,$cent_opt2,$cent_opt3,$cent_opt4,$pgmsl]);

$centrop2=DB::select(" SELECT tb_centre.centre_sl,tb_centre.centre_name 
FROM 
public.tb_admncentre, 
public.tb_admnscheme, 
public.tb_centre, 
public.tb_program
WHERE 
tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  
tb_admnscheme.adsc_admnyear=EXTRACT(YEAR FROM CURRENT_DATE) AND centre_sl NOT IN(?,?,?,?) and adsc_sl = ? ",[$cent_opt,$cent_opt2,$cent_opt3,$cent_opt4,$pgmsl]);

        
//        $centrop2=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre, 
//        public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl 
//        AND adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
//        AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? 
//        AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);      
//        dd($centrop2);
        if(count($centrop2)>0)
        {
        $htmlcent2 = "<div class=\"\"  id=\"cdiv5\" id=\"cdiv5\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus V :</label>
          
        <select  id= \"center_sl5\" name=\"center_sl5\" class=\"form-control form-control-sm select2 col-sm-8\"   onchange=\"centropt5()\">
        <option value=\"\" selected disabled >  Select Centre V </option>";
        foreach ($centrop2 as $cntr) {
        $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
        $htmlcent2 .= "</select></div></div>";
        return  $htmlcent2;
        }
          else
        {
          }      

     }
     
    public function centopt5(Request $request)
    {
        $cent_opt = $request->input('cent1');
        $cent_opt2 = $request->input('cent2');
        $cent_opt3 = $request->input('cent3');
        $cent_opt4 = $request->input('cent4');
        $cent_opt5 = $request->input('cent5');
        $appid=Auth::user()->pgapp_id; 
//          dd($cent_opt2);
        $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
        foreach ($pgappall as $key)
        {
        $pgmsl=$key->pgapp_adsc_sl;
        }
        $centrop2=DB::select("SELECT distinct getcentrename(centre) as centre_name,centre as centre_sl FROM admn22.asw_seatmatrix
                where  centre NOT IN(?,?,?,?,?) and pgm=?",[$cent_opt,$cent_opt2,$cent_opt3,$cent_opt4,$cent_opt5,$pgmsl]);

$centrop2=DB::select(" SELECT tb_centre.centre_sl,tb_centre.centre_name 
FROM 
public.tb_admncentre, 
public.tb_admnscheme, 
public.tb_centre, 
public.tb_program
WHERE 
tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  
tb_admnscheme.adsc_admnyear=EXTRACT(YEAR FROM CURRENT_DATE) AND 
centre_sl NOT IN(?,?,?,?,?) and adsc_sl = ? ",[$cent_opt,$cent_opt2,$cent_opt3,$cent_opt4,$cent_opt5,$pgmsl]);



        
//        $centrop2=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre, 
//        public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl 
//        AND adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
//        AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? 
//        AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);      
//        dd($centrop2);
        if(count($centrop2)>0)
        {
        $htmlcent2 = "<div class=\"\"  id=\"cdiv5\" id=\"cdiv5\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus VI :</label>
          
        <select  id= \"center_sl6\" name=\"center_sl6\" class=\"form-control form-control-sm select2 col-sm-8\"  >
        <option value=\"\" selected disabled >  Select Centre VI </option>";
        foreach ($centrop2 as $cntr) {
        $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
        $htmlcent2 .= "</select></div></div>";
        return  $htmlcent2;
        }
          else
        {
          }      

     } 
     
    public function centopt2shortfall(Request $request)
    {
        $year=2022;
        $cent_opt = $request->input('cent1');
        $cent_opt2 = $request->input('cent2');
        $appid=Auth::user()->pgapp_id; 
//          dd($cent_opt2);
        $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
        foreach ($pgappall as $key)
        {
        $pgmsl=$key->pgapp_adsc_sl;
        }
        $centrop2=DB::select("SELECT distinct getcentrename(sh_reopt_cent) as centre_name,sh_reopt_cent as centre_sl FROM admn22.asw_pgm_centre_shortfall
                where  sh_reopt_cent NOT IN(?,?) and sh_pgm=?",[$cent_opt,$cent_opt2,$pgmsl]);
        
//        $centrop2=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre, 
//        public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl 
//        AND adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
//        AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? 
//        AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);      
//        dd($centrop2);
        if(count($centrop2)>0)
        {
        $htmlcent2 = "<div class=\"\"  id=\"cdiv3\" id=\"cdiv3\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus III :</label>
          
        <select  id= \"center_sl3\" name=\"center_sl3\" class=\"form-control form-control-sm select2 col-sm-8\"  >
        <option value=\"\" selected disabled >  Select Centre III </option>";
        foreach ($centrop2 as $cntr) {
        $htmlcent2 .= "<option value=\"" . $cntr->centre_sl . "\" class=\"col-md-12\">" . $cntr->centre_name . "</option>";
        }
        $htmlcent2 .= "</select></div></div>";
        return  $htmlcent2;
        }
          else
        {
          }      

     } 
     
    public function store_optionscopy2021(Request $request){
   
      $appid=Auth::user()->pgapp_id;  
       $adscsl=Auth::user()->pgapp_adsc_sl; 
       // dd($appid);
     $pgapp_adsc_sl= $request->pgapp_adsc_sl;
    // dd($pgapp_adsc_sl);
     $center_sl1= $request->center_sl1;
     //dd($center_sl1);
     $center_sl2= $request->center_sl2;
    //return $center_sl2;
     $center_sl3= $request->center_sl3;
     $center_slexam= $request->center_slexam;
           $opt1=1;
           $opt2=2;
           $opt3=3;
   $option=DB::select("select * from tb_pg_pgpgm where pgpgm_pgapp_id=?",[$appid]);
  // return ($option);
   // dd(count($option));
if(count($option)==1)
    
{
    //update
       DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
           [$center_sl1,$opt1,$appid]);
       DB::update('update tb_pgapp set pgapp_exam_centre=? where pgapp_id=?',
        [$center_slexam,$appid]);
}

if(count($option)==2)
    
{
        //update
      DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
           [$center_sl1,$opt1,$appid]);
     DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
           [$center_sl2,$opt2,$appid]);
   
     DB::update('update tb_pgapp set pgapp_exam_centre=? where pgapp_id=?',
        [$center_slexam,$appid]);
}




if(count($option)==3)
    
{
       // return "update";
       DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
           [$center_sl1,$opt1,$appid]);
  DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
           [$center_sl2,$opt2,$appid]);
   
    DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
           [$center_sl3,$opt3,$appid]);

       DB::update('update tb_pgapp set pgapp_exam_centre=? where pgapp_id=?',
        [$center_slexam,$appid]);
}


if(count($option)==0)
{
    if($center_sl2 == "" AND  $center_sl3== "")
    {
      DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
           [$appid,$adscsl,$center_sl1,$opt1]); 
    }
    else if($center_sl3== "")
    {
       
    DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
       [$appid,$adscsl,$center_sl1,$opt1]);
    DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
       [$appid,$adscsl,$center_sl2,$opt2]);
    }
   else {
        
    DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
            [$appid,$adscsl,$center_sl1,$opt1]);
    DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
            [$appid,$adscsl,$center_sl2,$opt2]);
    DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
            [$appid,$adscsl,$center_sl3,$opt3]);
 //   DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',
 //           [$appid,$adscsl,$center_sl3,$opt3,$center_slexam]);
   }
    DB::update('update tb_pgapp set pgapp_exam_centre=? where pgapp_id=?',
        [$center_slexam,$appid]);
}
        

       return "Options Saved Successfully";
   }
    
    public function store_optionscopy2022(Request $request){  // original save option beforeshortfall
   
      $appid=Auth::user()->pgapp_id;  
      $adscsl=Auth::user()->pgapp_adsc_sl; 
       
      $center_sl1= $request->center_sl1;
      $center_sl2= $request->center_sl2;
        $declaration_status=$request->boolean("option_declaration");
        if($declaration_status=='true'){
            $declaration_status=1;
        }
//          dd($center_sl1);

       $opt1=1;
       $opt2=2;
       $opt3=3;
   
       $option=DB::select("select * from tb_pg_pgpgm where pgpgm_pgapp_id=?",[$appid]);
 
    if(count($option)==1)
    {
        //update
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
           
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[1,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[1,1,$appid]);
        
    }

    if(count($option)==2)
    {
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);
        
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[1,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[1,1,$appid]);
    }

    if(count($option)==0)
    {
       if($center_sl2 == "")
       {
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl1,$opt1]); 
       }

       else {

            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl1,$opt1]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl2,$opt2]);
       }
       
       DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[1,$appid]);
       DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[1,1,$appid]);

    }
      $htmlbtn = "
          <a href=\"printoption\" target=\"_blank\" class=\"btn btn-flat btn-sm btn-danger float-right\">
                        Print <i class=\"fa fa-download\"></i></a>";
	  
     return response()->json(['htmlbtn' => $htmlbtn, 'message' => "success"]);
        
   
         
   }
   
    public function store_options(Request $request){  
 // dd($request->all());
      $appid=Auth::user()->pgapp_id;  
      $adscsl=Auth::user()->pgapp_adsc_sl; 
      if($adscsl==975 || $adscsl==976 || $adscsl==977 || $adscsl==970){
          $option_stat=3;
      } 
      else{
          $option_stat=1;
      }
      $center_sl1= $request->center_sl1;
      $center_sl2= $request->center_sl2;
      $center_sl3= $request->center_sl3;
      $center_sl4= $request->center_sl4;
      $center_sl5= $request->center_sl5;
      $center_sl6= $request->center_sl6;
      $declaration_status=$request->boolean("option_declaration");
      if($declaration_status=='true'){
           $declaration_status=1;
      }
         

       $opt1=1;
       $opt2=2;
       $opt3=3;
       $opt4=4;
       $opt5=5;
       $opt6=6;
       $del=DB::select("delete  from tb_pg_pgpgm where pgpgm_pgapp_id=?",[$appid]);
       $option=DB::select("select * from tb_pg_pgpgm where pgpgm_pgapp_id=?",[$appid]);
     //dd(count($option));
    if(count($option)==1)
    {
        //update
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now() where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        if($adscsl==977){
        DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl2,$opt2]);
        }           
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);        
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);
        
    }

    if(count($option)==2)
    {
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);        
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);
    }
    
    if(count($option)==3)
    {
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl3,$opt3,$appid]);
        if($adscsl==970){
        DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl4,$opt4]);
        }
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);
    }
    
    if(count($option)==4)
    {
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl3,$opt3,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl4,$opt4,$appid]);
        if($adscsl==976){
        DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl5,$opt5]);
        }
        
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);
    }
    
    if(count($option)==5)
    {
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl3,$opt3,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl4,$opt4,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl5,$opt5,$appid]);
        
        if($adscsl==975){
        DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl6,$opt6]);
        }
        
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);
    }
    
    if(count($option)==6)
    {
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl3,$opt3,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl4,$opt4,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl5,$opt5,$appid]);
        DB::update('update  tb_pg_pgpgm set pgpgm_centre_sl=?,pgpgm_timestamp=now()  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl6,$opt6,$appid]);
        
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);
    }

    if(count($option)==0)
    {
//        dd($center_sl2,$center_sl3,$center_sl4,$center_sl5,$center_sl6);
       
        if($center_sl2 == "" &&  $center_sl3== "" &&  $center_sl4== "" &&  $center_sl5== "" &&  $center_sl6== "")
        {
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
           [$appid,$adscsl,$center_sl1,$opt1]); 
        }
        else if($center_sl3== "" &&  $center_sl4== "" &&  $center_sl5== "" &&  $center_sl6== "")
        {
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl1,$opt1]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl2,$opt2]);
        }
        else if($center_sl4== "" && $center_sl5== "" &&  $center_sl6== "")
        {
       
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl1,$opt1]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl2,$opt2]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl3,$opt3]);
        
        }
        else if($center_sl5== "" &&  $center_sl6== "")
        {
       
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl1,$opt1]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl2,$opt2]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl3,$opt3]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl4,$opt4]);
        
        }
        else if($center_sl6== "")
        {
       
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl1,$opt1]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
               [$appid,$adscsl,$center_sl2,$opt2]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl3,$opt3]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl4,$opt4]);
            DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl5,$opt5]);
        
        }
        else {

         DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl1,$opt1]);
         DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl2,$opt2]);
         DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl3,$opt3]);

         DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl4,$opt4]);
         DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl5,$opt5]);
         DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                 [$appid,$adscsl,$center_sl6,$opt6]);

        }  
                     
       DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[$option_stat,$appid]);
       DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[$option_stat,1,$appid]);

    }
      $htmlbtn = "
          <a href=\"printoption\" target=\"_blank\" class=\"btn btn-flat btn-sm btn-danger float-right\">
                        Print <i class=\"fa fa-download\"></i></a>";
	  
     return response()->json(['htmlbtn' => $htmlbtn, 'message' => "success"]);
        
   
         
   }
   
    public function store_options2022(Request $request){  // original save option beforeshortfall
   
      $appid=Auth::user()->pgapp_id;  
      $adscsl=Auth::user()->pgapp_adsc_sl; 
       
      $center_sl1= $request->center_sl1;
      $center_sl2= $request->center_sl2;
      $center_sl3= $request->center_sl3;
        $declaration_status=$request->boolean("option_declaration");
        if($declaration_status=='true'){
            $declaration_status=1;
        }
//          dd($center_sl1);

       $opt1=1;
       $opt2=2;
       $opt3=3;
   
       $option=DB::select("select * from tb_shortfall_reoption where pgpgm_pgapp_id=?",[$appid]);
// dd(count($option));
    if(count($option)==1)
    {
        //update
        DB::update('update tb_shortfall_reoption set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
           
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[3,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[3,3,$appid]);
        
    }

    if(count($option)==2)
    {
        DB::update('update  tb_shortfall_reoption set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_shortfall_reoption set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);
        
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[3,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[3,3,$appid]);
    }

    if(count($option)==3)
    {
        DB::update('update  tb_shortfall_reoption set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl1,$opt1,$appid]);
        DB::update('update  tb_shortfall_reoption set pgpgm_centre_sl=?  where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl2,$opt2,$appid]);

        DB::update('update  tb_shortfall_reoption set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?',
               [$center_sl3,$opt3,$appid]);

        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[3,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[3,3,$appid]);
        
    }
    
       
    if(count($option)==0)
    {
       

            DB::insert('insert into  tb_shortfall_reoption (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl1,$opt1]);
            DB::insert('insert into  tb_shortfall_reoption (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl2,$opt2]);
            DB::insert('insert into  tb_shortfall_reoption (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option)VALUES(?,?,?,?)',
                    [$appid,$adscsl,$center_sl3,$opt3]);
         //   DB::insert('insert into  tb_pg_pgpgm (pgpgm_pgapp_id,pgpgm_adsc_sl,pgpgm_centre_sl,pg_option,pg_entrance_centre)VALUES(?,?,?,?,?)',
         //           [$appid,$adscsl,$center_sl3,$opt3,$center_slexam]);
       
        DB::update('update tbz_pgranklist set option_status=? where rank_appid=?',[3,$appid]);
        DB::update('update tb_pgapp set option_stat=?,option_declaration=? where pgapp_id=?',[3,3,$appid]);
      
    }
    
    
      $htmlbtn = "
          <a href=\"printoption\" target=\"_blank\" class=\"btn btn-flat btn-sm btn-danger float-right\">
                        Print <i class=\"fa fa-download\"></i></a>";
	  
     return response()->json(['htmlbtn' => $htmlbtn, 'message' => "success"]);
         
   }
    
   public function printoption(){
      
     $appid=Auth::user()->pgapp_id;  
     $adscl=Auth::user()->pgapp_adsc_sl;  
     $option_stat=Auth::user()->option_stat; 
     $adscname = DB::select('select adsc_name,pgm_name from  tb_admnscheme 
          inner join tb_program on pgm_sl=adsc_pgm_sl where adsc_sl=? ' , [$adscl]);

     foreach($adscname as $key){
         $pgmname=$key->pgm_name;
     }
     
//    if($option_stat==3){
//      $option = DB::select('select *,centre_name from  tb_shortfall_reoption left join tb_centre on pgpgm_centre_sl=centre_sl where pgpgm_pgapp_id=? order by tb_shortfall_reoption.pg_option' , [$appid]);
//
//    }
//    else{
      $option = DB::select('select *,centre_name from  tb_pg_pgpgm left join tb_centre on pgpgm_centre_sl=centre_sl where pgpgm_pgapp_id=? order by tb_pg_pgpgm.pg_option' , [$appid]);
//    } 
     $rank = DB::select("select rank from tbz_pgranklist
        where rank_appid=? order by rank",[$appid]);
//     dd($rank);
      $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
           date_default_timezone_set('Asia/Kolkata');
            $timenow= date("H:i:s");
//     dd($curnt_date);
    if(empty($option)){
        return "You are not submitted the options";  
    }
    else{
        $pdf = PDF::loadView('2022.optionprint',compact('option','curnt_date','timenow','pgmname','rank'));

        return $pdf->download('PGCentreOption.pdf');
     
    }

    }   
   
    public function postpg_pdf(Request $request){
        
        $appid=Auth::user()->pgapp_id;
   date_default_timezone_set('Asia/Kolkata');
        $time= date("H:i:s");  
        $pgapp=DB::table('tb_pgapp')->select('*')->where('pgquali_pgapp_id','=',$appid)->get();

        $pgquali=DB::table('tb_pg_pgquali')->select('*')->where('pgapp_id','=',$appid)->get();
        $pgotherinfo=DB::table('tbz_pgotherinfo')->select('*')->where('pgotherinfo_appid','=',$appid)->get();

//         $pgoptions= DB::table('tb_pg_pgpgm')
//                ->select('*')
//                ->where('pgpgm_pgapp_id','=',$appid)
//                ->get();
         $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,tb1.pg_entrance_centre from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

        $pdf = PDF::loadView('pdf', compact('pgapp','pgquali','pgotherinfo','pgoptions','pgpgm_flag','flags'));
	return $pdf->download('pgapplication.pdf');
    
        
    }
    

    public function pay_details()
    {
        
     
       
//        if(Auth::user()->pg_edit_appl == 1 || $this->payment_status() == 0   ){
//              return redirect('home');
//
//        }
//        
        
        $id=Auth::user()->pgapp_id;  
        $adsc_sl=Auth::user()->pgapp_adsc_sl;
        $datereg=Carbon::now();
        $pgapp_sl= Auth::user()->pgapp_sl;
        $pgapp_mobile= Auth::user()->pgapp_mobile;
        $pgapp_email= Auth::user()->pgapp_email;
        $pgapp_name= Auth::user()->pgapp_name;
//        $transactionId = rand(100000,100000000).$pgapp_sl;
        $clentcode= Auth::user()->pgapp_id;
        $pgapp_stream_id= Auth::user()->pgapp_stream_id;
        $pgapp_community= Auth::user()->pgapp_community;
        
//        atom
//        $payment_success_count = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-2025")->where('res_verified',"SUCCESS")->count();
//        $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->get();

        
//        ccavenue
       $payment_success_data = CcTrans::where('client_code', Auth::user()->pgapp_id)
    ->where('ucity_service', "PG-APPLICATION-FEE-2026")
    ->whereIn('order_status', ['Success', 'Shipped'])
    ->orderBy('trans_id')   // optional (ensures first record)
    ->first();
       
       if ($payment_success_data) {

    DB::table('tb_pgapp')
        ->where('pgapp_id', $id)
        ->where('onlinepay_status', '!=', 1)
        ->update([
            'onlinepay_status' => 1,
            'onlinepay_amount' => $payment_success_data->trans_amt,
            'onlinepay_tdate' => $payment_success_data->tdate,
            'onlinepay_merchanttxnid' => $payment_success_data->order_id
        ]);

}
       
        $payment_success_count = CcTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-APPLICATION-FEE-2026")->whereIn('order_status', ['Success', 'Shipped'])->count();
        $pay_details = CcTrans::where('client_code',Auth::user()->pgapp_id)->get();
        
//       dd($payment_success_count);
        

//        foreach ($pay_details as $value) {
//            $res_verified=$value->res_verified;
//            $adsc_sl=$value->pgapp_adsc_sl;
//        }
       
        $payment_balnc = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-BALANCE-2025")->where('res_verified',"SUCCESS")->count();
       
         $court_judge=Auth::user()->court_judge;
 
//         $allotstatusres=DB::select("select *,getcentrename(cent) as centre,special_reserv_flag from admn22.seat_allocation_matrix where app_id=? and app_id not in
//                (SELECT admn22.intra_cent_allot_change.app_id FROM admn22.intra_cent_allot_change )",[$id]);
         
         $allotstatusres=DB::select("select *,getcentrename(cent) as centre,getpgm(pgm) as program_name,special_reserv_flag from admn22.seat_allocation_matrix_not_published
 where app_id=?",[$id]);
         
          //dd($allotstatusres);
       $special_reserv_flag=0;
         $allotstat=0;
         $payf=0;
          if (empty($allotstatusres))
          {
              $allotstat=0;
          }
          else{
              foreach ($allotstatusres as $key){
                   $allot=$key->app_allotment;
                   $special_reserv_flag=$key->special_reserv_flag;
                   $allotstat=1; 
              }
               
             if($allot=='SECOND' && $adsc_sl==997){
                  
               $allotstat=4000; 
              }
              else if($allot=='THIRDD' || $adsc_sl==997){
                $allotstat=4; 
              }
              else if($allot=='FIRST55' || $allot=='FIRST-DMM'){
                $allotstat=1; 
              }
              else if($allot=='TRIAL'){
                $allotstat=10; 
              }
              else if($allot=='SECOND'){
                  
                $allotstat=2; 
              }
              else if($allot=='THIRD'){
                  
                $allotstat=3; 
              }
              else if($allot=='FOURTH'){
                  
                $allotstat=4; 
              }
              else if($allot=='FIFTH'){
                  
                $allotstat=50; 
              }
              else if($allot=='SIXTH'){
                  
                $allotstat=60; 
              }
              else if($allot=='SEVENTH'){
                  
                $allotstat=70; 
              }
              else if($allot=='EIGHTH'){
                  
                $allotstat=80; 
              }
              else if($allot=='NINTH'){
                  
                $allotstat=90; 
              }
              else if($allot=='SPOT'){
                  
                $allotstat=5; 
              }
              else if($allot=='SPOT-II'){
                  
                $allotstat=6; 
              }
              else if($allot=='SPECIAL' ||$allot=='RE-NOTIFICATION(SC/ST)'||$allot=='SPECIAL RESERVATION'||$allot=='SPECIAL ALLOTMENT'||$allot=='SECOND-DMM'
                 ||$allot=='SPECIAL REQUEST FROM THE CANDIDATE'||$allot=='SPECIAL-ALLOTMENT'||$allot=='RE-NOTIFICATION' ||
                      $allot=='MUTUAL TRANSFER REQUEST'|| $allot=='CENTRE TRANSFER (SHORTFALL)'){
                  
                $allotstat=4000; 
              }
              
//              else if($allot=='FIRST/SECOND/THIRD/FOURTH'){
//                  
//                $allotstat=4; 
//              }
              else if($allot=='SIXTH'){
                  
                $allotstat=40000; 
              }
              
          }
         
         $admstat=0; 
         $pgadm=DB::select("select * from asw_pgadm where adm_appid=?",[$id]);
          if (empty($pgadm))
          {
              $admstat=0;
          }
          else{
              foreach ($pgadm as $key){
                  $onlinepaystatus=$key->onlinepaystatus;
              }
              if($onlinepaystatus==1){
                $admstat=2; 
              }
              else if($onlinepaystatus==0){
                  $admstat=1;
              }
             
          }

         
        //  $payment_adm= PaymentTrans::where('client_code',Auth::user()->pgapp_id)
        //          ->where('ucity_service',"PG-ADMISSION-FEE-2025")->where('res_verified',"SUCCESS")->get();
         
        //  $feestat=0;
        //   if (count($payment_adm)>0)
        //   {
        //       $feestat=1;
        //   }
        //   else{
        //      $feestat=0; 
        //   }

        // 1. CCAvenue payment
$ccavenuePayments = TbzCcavenueTxn::where('client_code', Auth::user()->pgapp_id)
->where('ucity_service', 'LIKE', "PG-ADMISSION-FEE-2025")
->where('order_status', "Success")
->get();

// 2. Atom payment
$atomPayments = PaymentTrans::where('client_code', Auth::user()->pgapp_id)
->where('ucity_service', "PG-ADMISSION-FEE-2025")
->where('res_verified', "SUCCESS")
->get();

// 3. Merge payments
$payment_adm = $ccavenuePayments->merge($atomPayments);

// 4. Set status
$feestat = $payment_adm->count() > 0 ? 1 : 0;

          if (Auth::user()->pgapp_id == 'ADMPG2500555' || Auth::user()->pgapp_id == 'ADMPG2502930' || Auth::user()->pgapp_id == 'ADMPG2503118' 
                  || Auth::user()->pgapp_id == 'ADMPG2502247' || Auth::user()->pgapp_id == 'ADMPG2501458' || Auth::user()->pgapp_id == 'ADMPG2500899'
                  || Auth::user()->pgapp_id == 'ADMPG2500692'){
              $feestat=1;
          }
        
//       $newoptions=DB::select("select * from tb_pg_pgpgm_newoptions where pgpgm_pgapp_id=? and pgpgm_adsc_sl IN('820','821','823','824','829','830','831')",[$id]);
//       $optionstat=0;
//       if(count($newoptions)>0)
//       {
//          $optionstat=1;
//       } 

//return $adsc_sl;
$pubstatus=-1;
      $pubstat=DB::select("select * from asw_pub_memostat where adsc_sl=?",[$adsc_sl]);
      foreach ($pubstat as $value) {
          $pubstatus=$value->status;
      }

       
      $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
      date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");
    
//        if($datenow>'27/04/2022'){
//            return view('auth.registerclose'); 
//        }
        
         // dd($allotstat);
        $publish_status_data = DB::select("select * from tb_pg_entrancexam where ent_adscsl=?",[$adsc_sl]);
        $publish_status = $publish_status_data[0]->ent_hallticket_pub_stat;
//        $publish_status = 0;
        $index_mark = DB::select("SELECT asw_pgfalseno.indexmark
                                    FROM tb_pgapp
                                    LEFT JOIN asw_pgfalseno
                                    ON tb_pgapp.pgapp_falseno = asw_pgfalseno.ent_exam_falseno
                                    WHERE tb_pgapp.pgapp_id = ?",[Auth::user()->pgapp_id]);
                                   // dd($index_mark );
$rankDetails = DB::table('tbz_pgranklist')
    ->where('rank_appid', Auth::user()->pgapp_id)
    ->first();

$finalIndexMark = $rankDetails->final_indexmark ?? null;
            if (!empty($index_mark) && isset($index_mark[0]->indexmark)) {
                $mark = $index_mark[0]->indexmark;
            } else {
                $mark = null; // No indexmark found or it's NULL
            }

            $ranklist = DB::select("SELECT rank
                            FROM public.tbz_pgranklist
                            WHERE rank_appid = ?
                        ", [Auth::user()->pgapp_id]);

            if (!empty($ranklist) && isset($ranklist[0]->rank)) {
                $rankl = $ranklist[0]->rank;
            } else {
                $rankl = null; // No indexmark found or it's NULL
            }

            $rankRow = DB::selectOne("
                            SELECT rl.rank
                            FROM   public.tbz_pgranklist  rl
                            LEFT JOIN tb_pgapp p
                                ON p.pgapp_id = rl.rank_appid
                            WHERE  p.pgapp_id = ?
                        ", [Auth::user()->pgapp_id]);
                       // dd($rankRow);

                        /* If a row was found $rankRow will be an object; otherwise it is null */
                        $result = $rankRow ? 1 : 0;
                       // dd($result);


            $seatAllocations = DB::table('admn22.seat_allocation_matrix_not_published')
            ->select(
                'app_allotment',
                'pgm',
                'cent',
                DB::raw("public.getpgm(pgm) as adscname"),
                DB::raw("public.getcentrename(cent) as centcode"),
                DB::raw("MAX(CASE WHEN seat = 'open' THEN app_rank END) AS open"),
                DB::raw("MAX(CASE WHEN seat = 'ezhava' THEN app_rank END) AS ezhava"),
                DB::raw("MAX(CASE WHEN seat = 'muslim' THEN app_rank END) AS muslim"),
                DB::raw("MAX(CASE WHEN seat = 'obh' THEN app_rank END) AS obh"),
                DB::raw("MAX(CASE WHEN seat = 'obx' THEN app_rank END) AS obx"),
                DB::raw("MAX(CASE WHEN seat = 'lc_siuc' THEN app_rank END) AS lc_siuc"),
                DB::raw("MAX(CASE WHEN seat = 'sc' THEN app_rank END) AS sc"),
                DB::raw("MAX(CASE WHEN seat = 'st' THEN app_rank END) AS st"),
                DB::raw("MAX(CASE WHEN seat = 'ews' THEN app_rank END) AS ews")
            )
            ->where('pgm', $adsc_sl) // Add your condition here
            ->groupBy('app_allotment', 'pgm', 'cent')
            ->get();

        //    dd($seatAllocations);
        
//        dd($allotstat);
//      return view('pgfinalview', compact('allotstatusres','allotstat',
//             'pubstatus','pay_details','','adsc_sl','pgoptions','pgpgm_flag',
//             'flags','optionstat','payment_success_count','datenow','admstat','feestat','admstat','payment_balnc','publish_status','id'));
            
            
        
        
        
        //dd($pgapp_stream_id);
 
        if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
        {
        $amnt=DB::select("select pg_scstfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);

        foreach ( $amnt as $value) {
          $amount=$value->pg_scstfee;
        }

        }
        else {
           $amnt=DB::select("select pg_normalfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);
           foreach ( $amnt as $value) {
                  $amount=$value->pg_normalfee;
           }

        }
        
       $sub=DB::select("select pgapp_adsc_sl from tb_pgapp where  pgapp_sl=?",[$pgapp_sl]);
        foreach ($sub as $value1) {
              $pgapp_adsc_sl=$value1->pgapp_adsc_sl;
       }


           //Translation and office proceedings in Hindi
           if($pgapp_adsc_sl=="1200")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=50;
               }
               else
               {
                 $amount=150;  
               }

           }
           //PG Diploma in Wellness and Spa Management
           if($pgapp_adsc_sl=="1201")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

           }
            //PG Diploma in Manuscriptology
           if($pgapp_adsc_sl=="1202")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

           }
           //PG Diploma in Translation Studies
           if($pgapp_adsc_sl=="1204")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

           }
           //MPES
           if($pgapp_adsc_sl=="1195")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=110;
               }
               else
               {
                 $amount=320;  
               }

           }
           //MFA
           if($pgapp_adsc_sl=="1194")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=180;
               }
               else
               {
                 $amount=530;  
               }

           }
           //MSC
           if($pgapp_adsc_sl=="1191" || $pgapp_adsc_sl=="1192")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=80;
               }
               else
               {
                 $amount=240;  
               }

           }
           //Museology and MSW
            if($pgapp_adsc_sl=="1188" || $pgapp_adsc_sl=="1193") //841,910

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=110;
               }
               else
               {
                 $amount=320;  
               }

            }
            
            if($pgapp_adsc_sl=="1196" || $pgapp_adsc_sl=="1197" || $pgapp_adsc_sl=="1198" || $pgapp_adsc_sl=="1199" ) //Masters Programme in Disaster Management and Mitigation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=530;  
               }

            }
            if($pgapp_adsc_sl=="997") //Post Graduate Diploma in Sanskrit Computational Linguistics

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=175;
               }
               else
               {
                 $amount=750;  
               }

            }
            
            if($pgapp_adsc_sl=="1065") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

            }
            if($pgapp_adsc_sl=="1151") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

            }
            $amnt = $amount;
            
            
            
            //fee splitup
             
        $combined = collect([
    'Application Fee_' . $amnt
])->implode('+');
        
        $data = [];

$data['Application Fee'] = (float) $amnt;
        
    
            
            
     
      return view('pgfinalview', compact('allotstatusres','allotstat',
             'pay_details','adsc_sl',
             'payment_success_count','datenow','admstat','feestat','admstat',
             'payment_balnc','publish_status','id','mark','seatAllocations','result','rankl','amnt','finalIndexMark'))->with('feeDetails', $data);
      
      
      
      
//     if(Auth::user()->pgapp_adsc_sl==996||Auth::user()->pgapp_adsc_sl==997||Auth::user()->pgapp_adsc_sl==998){
//    
//     return view('pgfinalview_dmm', compact('allotstatusres','allotstat',
//             'pubstatus','pay_details','postpgadm','adsc_sl','pgoptions','pgpgm_flag',
//             'flags','optionstat','payment_success_count','datenow','admstat','feestat','payment_balnc'));
//     }
//     
//     else{
//     return view('pgfinalview', compact('allotstatusres','allotstat',
//             'pubstatus','pay_details','postpgadm','adsc_sl','pgoptions','pgpgm_flag',
//             'flags','optionstat','payment_success_count','datenow','admstat','feestat','admstat','payment_balnc'));
     
     
    // }
                
    }
    
    
     public function pay_details_bkup()
    {
      
       
        if(Auth::user()->pg_edit_appl == 1 || $this->payment_status() == 0   ){
            
              return redirect('home');

        }
        
        
        $id=Auth::user()->pgapp_id;
  
        $adsc_sl=Auth::user()->pgapp_adsc_sl;
        $payment_success_count = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-2024")->where('res_verified',"SUCCESS")->count();
        $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->get();
        
        
        
        

//        foreach ($pay_details as $value) {
//            $res_verified=$value->res_verified;
//            $adsc_sl=$value->pgapp_adsc_sl;
//        }
       
        $payment_balnc = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-BALANCE-2024")->where('res_verified',"SUCCESS")->count();

        
         $court_judge=Auth::user()->court_judge;
 
//         $allotstatusres=DB::select("select *,getcentrename(cent) as centre,special_reserv_flag from admn22.seat_allocation_matrix where app_id=? and app_id not in
//                (SELECT admn22.intra_cent_allot_change.app_id FROM admn22.intra_cent_allot_change )",[$id]);
         
         $allotstatusres=DB::select("select *,getcentrename(cent) as centre,special_reserv_flag from admn22.seat_allocation_matrix where app_id=?",[$id]);
         
           
       $special_reserv_flag=0;
         $allotstat=0;
         $payf=0;
          if (empty($allotstatusres))
          {
              $allotstat=0;
          }
          else{
              foreach ($allotstatusres as $key){
                  $allot=$key->app_allotment;
                   $special_reserv_flag=$key->special_reserv_flag;
              }
               
             if($allot=='SECOND' && $adsc_sl==997){
                  
               $allotstat=4; 
              }
              else if($allot=='THIRD' || $adsc_sl==997){
                $allotstat=4; 
              }
              else if($allot=='FIRST' || $allot=='FIRST-DMM'){
                $allotstat=4; 
              }
              else if($allot=='SECOND'){
                  
                $allotstat=4; 
              }
              else if($allot=='THIRD'){
                  
                $allotstat=4; 
              }
              else if($allot=='FIFTH'||$allot=='RE-NOTIFICATION(SC/ST)'||$allot=='SPECIAL RESERVATION'||$allot=='SPECIAL ALLOTMENT'||$allot=='SECOND-DMM'
                 ||$allot=='SPECIAL REQUEST FROM THE CANDIDATE'||$allot=='SPECIAL-ALLOTMENT'||$allot=='RE-NOTIFICATION' ||
                      $allot=='MUTUAL TRANSFER REQUEST'|| $allot=='CENTRE TRANSFER (SHORTFALL)'){
                  
                $allotstat=4; 
              }
              
              else if($allot=='FIRST/SECOND/THIRD/FOURTH'){
                  
                $allotstat=4; 
              }
              else if($allot=='SIXTH'){
                  
                $allotstat=4; 
              }
              
          }
         $admstat=0; 
         $pgadm=DB::select("select * from asw_pgadm where adm_appid=?",[$id]);
          if (empty($pgadm))
          {
              $admstat=0;
          }
          else{
              foreach ($pgadm as $key){
                  $onlinepaystatus=$key->onlinepaystatus;
              }
              if($onlinepaystatus==1){
                $admstat=2; 
              }
              else if($onlinepaystatus==0){
                  $admstat=1;
              }
             
          }
         $payment_adm= PaymentTrans::where('client_code',Auth::user()->pgapp_id)
                 ->where('ucity_service',"PG-ADMISSION-FEE-2024")->where('res_verified',"SUCCESS")->get();
         
         $feestat=0;
          if (count($payment_adm)>0)
          {
              $feestat=1;
          }
          else{
             $feestat=0; 
          }
//       $newoptions=DB::select("select * from tb_pg_pgpgm_newoptions where pgpgm_pgapp_id=? and pgpgm_adsc_sl IN('820','821','823','824','829','830','831')",[$id]);
//       $optionstat=0;
//       if(count($newoptions)>0)
//       {
//          $optionstat=1;
//       } 
      $pubstat=DB::select("select * from asw_pub_memostat where adsc_sl=?",[$adsc_sl]);
      foreach ($pubstat as $value) {
          $pubstatus=$value->status;
      }

      
      $dt_now = Carbon::now();
        
        $trn_date= $dt_now->toDateString();
     date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y");
    
//        if($datenow>'27/04/2022'){
//            return view('auth.registerclose'); 
//        }
        

        $postpgadm =-1;
        $publish_status_data = DB::select("select * from tb_pg_entrancexam where ent_adscsl=?",[$adsc_sl]);
        $publish_status = $publish_status_data[0]->ent_hallticket_pub_stat;
//        dd($publish_status);
      return view('pgfinalview', compact('allotstatusres','allotstat',
             'pubstatus','pay_details','postpgadm','adsc_sl','pgoptions','pgpgm_flag',
             'flags','optionstat','payment_success_count','datenow','admstat','feestat','admstat','payment_balnc','publish_status'));
      
      
      
      
      
//     if(Auth::user()->pgapp_adsc_sl==996||Auth::user()->pgapp_adsc_sl==997||Auth::user()->pgapp_adsc_sl==998){
//    
//     return view('pgfinalview_dmm', compact('allotstatusres','allotstat',
//             'pubstatus','pay_details','postpgadm','adsc_sl','pgoptions','pgpgm_flag',
//             'flags','optionstat','payment_success_count','datenow','admstat','feestat','payment_balnc'));
//     }
//     
//     else{
//     return view('pgfinalview', compact('allotstatusres','allotstat',
//             'pubstatus','pay_details','postpgadm','adsc_sl','pgoptions','pgpgm_flag',
//             'flags','optionstat','payment_success_count','datenow','admstat','feestat','admstat','payment_balnc'));
     
     
    // }
                
    }
    
   public function paymentstatus(Request $request) {
       
       
       
       
         $appid=Auth::user()->pgapp_id;
       
        $merchanttxnid=$request->merchanttxnid;
        $tdate=$request->input('tdate');

        $amts=DB::select("select trans_amt from  tbz_atom_transactions where  client_code=?",[$appid]);
           foreach ( $amts as $value2) {
                  $trans_amt=$value2->trans_amt;
           }
        
        
//     $xml = simplexml_load_string(file_get_contents('https://paynetzuat.atomtech.in/paynetz/vfts?merchantid=197&merchanttxnid=123123456&amt=50.00&tdate=2020-10-04'));
//dd((string)$xml['MerchantTxnID']);
     $xml=simplexml_load_file("https://payment.atomtech.in/paynetz/vfts?merchantid=71480&merchanttxnid=".$merchanttxnid."&amt=".$trans_amt."&tdate=".$tdate."");
//   https://payment.atomtech.in/paynetz/vfts?merchantid=71480&merchanttxnid=20531&amt=2125.00&tdate=2020-09-30 
//       dd($xml);
     if ($xml === false) {
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
              echo "<br>", $error->message;
            }
        } 
    else {
        $xmlvalues=$xml->attributes();
        $verfied=$xml->attributes()->VERIFIED;
        $merchanttxnid=$xml->attributes()->MerchantTxnID;
        $bank_txn=$xml->attributes()->BID;
        $discriminator=$xml->attributes()->discriminator;
        $mmp_txn=$xml->attributes()->atomtxnId;
        $CardNumber=$xml->attributes()->CardNumber;
        $surcharge=$xml->attributes()->surcharge;
        $CardNumber=$xml->attributes()->CardNumber;
        $surcharge=$xml->attributes()->surcharge;
        $udf9=$xml->attributes()->UDF9;
        $TxnDate=$xml->attributes()->TxnDate;
        
        if(strtoupper($verfied)=='SUCCESS'){
             $bankname=$xml->attributes()->bankname;
            $MerchantID=$xml->attributes()->MerchantID;
           $dateofpay=$xml->attributes()->TxnDate;
            $MerchantID=$xml->attributes()->MerchantID;
           
             $datastudexam=User::where('pgapp_sl',$udf9)
                      
                      ->update([
                        
                         'onlinepay_status'=>1,
                         
                        ]);
             $datapay=PaymentTrans::where('merchanttxnid',$merchanttxnid)
                      
                      ->update([
                       'res_bankname' => $bankname,
                         'res_bid'=>$bank_txn,
                       'res_verified'=>$xml->attributes()->VERIFIED,
                         'res_discriminator'=>$discriminator,
                          'res_atomtxn_id'=>$mmp_txn,
                         'res_card_number'=>$CardNumber,
                          'res_surcharge'=>$surcharge,
                           'res_txn_date'=>$dateofpay,
                          'res_udf9_clientcode'=>$udf9,
                          
//                         'atom_txn_id'=>$ipg_txn_id,
                        ]); 
        }
    //     dd($xmlvalues);
         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }
     
//dd($xml->attributes()->MerchantID);
    $MerchantTxnID=(string)$xml['MerchantTxnID'];
    $VERIFIED=(string)$xml['VERIFIED'];
    return $VERIFIED;
//        $triggersms = file_get_contents('https://paynetzuat.atomtech.in/paynetz/vfts?merchantid=197&merchanttxnid=123123456&amt=50.00&tdate=2020-10-04');
//      $xml=simplexml_load_file('https://paynetzuat.atomtech.in/paynetz/vfts?merchantid=197&merchanttxnid=581889114&amt=50.00&tdate=2020-10-04');

dd($xml->VerifyOutput);
//      echo $xml->bankname;
//       DD($parser($xml));
//      $triggersms = file_get_contents($xml);
//      dd($xml->VerifyOutput[0]);
        $xml = new \SimpleXMLElement($triggersms);
        $json = json_encode($xml);
        dd($json->MerchantTxnID);
$array = json_decode($json,TRUE);
//dd($array->"MerchantID);
        foreach ($xml as $value) {
            return $xml;
        }
        
    }
    
     
    
    public function getpreview(Request $request)
    {
//         if(!empty(Auth::user()->pgapp_photo)){
            $appid=Auth::user()->pgapp_id;
            $pgapp_sl= Auth::user()->pgapp_sl;
            $pgapp_stream_id= Auth::user()->pgapp_stream_id;
            $pgapp_community= Auth::user()->pgapp_community;
            $declaration_status= $request->declaration_status;
    
        $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
             //   dd($pgapp);
        foreach ($pgapp as $value) {
            $ugcourse_status=$value->ugcourse_status;
        }
     
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();

        foreach ($pgquali as $value) {
            $courseduration=$value->courseduration;
            $coursetype=$value->coursetype;

        }
//        return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
        if($coursetype=="SEMESTER WISE"){
               $semester_grades = $this->getMarkList($appid, $ugcourse_status, $courseduration);
               $name="Sem";
        }
        else if($coursetype=="YEAR WISE"){
               $semester_grades = $this->getMarkListYear($appid, $ugcourse_status, $courseduration);
               $name="Year";
        }

//        dd($items);
if (isset($community) && !is_null($community)) {
    // $community is set and not null
} else {
    
    $caste =null;}
    if (isset($caste) && !is_null($caste)) {
        // $community is set and not null
    } else {
        
        $caste =null;}


          $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,tb1.pg_entrance_centre from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

            $record = DB::table('tb_pg_pgquali')->where('pgquali_pgapp_id', $appid)->first();
               

            // Ensure variables are set correctly to avoid errors
            $filePathSSLC = $record->file_sslc_path;
            $filePathHSE = $record->file_degree_path;
            $fileUrlaadhar = $record->file_aadhar_path;

            $special_file_record = DB::table('tbz_pgotherinfo')
                    ->where('pgotherinfo_appid', $appid)
                    ->first();
                
                $filePathSpecial = $special_file_record->file_special_path;

                $campus_options = DB::select('SELECT pgpgm_pgapp_id,pg_option,pgpgm_centre_sl, getcentrename(pgpgm_centre_sl) as cent
                FROM public.tb_pg_pgpgm where pgpgm_pgapp_id=? ORDER BY pg_option', [$appid]);

            
                
                
                if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
        {
        $amnt=DB::select("select pg_scstfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);

        foreach ( $amnt as $value) {
          $amount=$value->pg_scstfee;
        }

        }
        else {
           $amnt=DB::select("select pg_normalfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);
           foreach ( $amnt as $value) {
                  $amount=$value->pg_normalfee;
           }

        }
        
      

                
                
                
//                Application fee
              $sub=DB::select("select pgapp_adsc_sl from tb_pgapp where  pgapp_sl=?",[$pgapp_sl]);
             
        foreach ($sub as $value1) {
              $pgapp_adsc_sl=$value1->pgapp_adsc_sl;
       }


            //Translation and office proceedings in Hindi
           if($pgapp_adsc_sl=="1200")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=50;
               }
               else
               {
                 $amount=150;  
               }

           }
           //PG Diploma in Wellness and Spa Management
           if($pgapp_adsc_sl=="1201")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

           }
            //PG Diploma in Manuscriptology
           if($pgapp_adsc_sl=="1202")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

           }
           //PG Diploma in Translation Studies
           if($pgapp_adsc_sl=="1204")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

           }
           //MPES
           if($pgapp_adsc_sl=="1195")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=110;
               }
               else
               {
                 $amount=320;  
               }

           }
           //MFA
           if($pgapp_adsc_sl=="1194")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=180;
               }
               else
               {
                 $amount=530;  
               }

           }
           //MSC
           if($pgapp_adsc_sl=="1191" || $pgapp_adsc_sl=="1192")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=80;
               }
               else
               {
                 $amount=240;  
               }

           }
           //Museology and MSW
            if($pgapp_adsc_sl=="1188" || $pgapp_adsc_sl=="1193") //841,910

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=110;
               }
               else
               {
                 $amount=320;  
               }

            }
            
            if($pgapp_adsc_sl=="1196" || $pgapp_adsc_sl=="1197" || $pgapp_adsc_sl=="1198" || $pgapp_adsc_sl=="1199" ) //Masters Programme in Disaster Management and Mitigation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=530;  
               }

            }
            if($pgapp_adsc_sl=="997") //Post Graduate Diploma in Sanskrit Computational Linguistics

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=175;
               }
               else
               {
                 $amount=750;  
               }

            }
            
            if($pgapp_adsc_sl=="1065") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

            }
            if($pgapp_adsc_sl=="1151") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

            }
            
            
                           
//                Application fee
//                dd($amount);

                $amnt = $amount;
        $combined = collect(['Application Fee_' . $amnt])->implode('+');
        $data = [];

$data['Application Fee'] = (float) $amnt;

    //    return view('payment',compact('pgapp','community','caste','subcaste','pgquali','pgotherinfo','pgoptions','semester_grades','name'));
        return view('payment',compact('pgapp','pgquali','pgotherinfo','pgoptions','semester_grades',
        'name','filePathSSLC','filePathHSE','filePathSpecial','campus_options','fileUrlaadhar','amnt'))->with('feeDetails', $data);



        
    }
    
    private function payment_success_status(){
        
           $id=Auth::user()->pgapp_id;
//           atom
//           $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('res_verified',"SUCCESS")->count();
           
           $pay_details = CcTrans::where('client_code',Auth::user()->pgapp_id)->whereIn('order_status', ['Success', 'Shipped'])->count();
           
//           $pay_details = DB::table('tb_pgapp')->select('tbz_atom_transactions.*','tb_pgapp.indexmark','tb_pgapp.pgapp_id')
//                   ->join('tbz_atom_transactions','tb_pgapp.pgapp_id','tbz_atom_transactions.client_code')  
//                    ->where('tbz_atom_transactions.res_verified',"SUCCESS")                
//                   ->where('tb_pgapp.pgapp_id',Auth::user()->pgapp_id)->first(); 

           return  $pay_details;      

    }
    
     private function payment_status(){
        
           $id=Auth::user()->pgapp_id;
//           atom
//           $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->count();
//           ccavenue
           $pay_details = CcTrans::where('client_code',Auth::user()->pgapp_id)->count();
           
//           $pay_details = DB::table('tb_pgapp')->select('tbz_atom_transactions.*','tb_pgapp.indexmark','tb_pgapp.pgapp_id')
//                   ->join('tbz_atom_transactions','tb_pgapp.pgapp_id','tbz_atom_transactions.client_code')  
//                    ->where('tbz_atom_transactions.res_verified',"SUCCESS")                
//                   ->where('tb_pgapp.pgapp_id',Auth::user()->pgapp_id)->first(); 
  
           return  $pay_details;    
        

    }
    
    
    //ccavenue
     public function pgpayment(Request $request)
    {

  
        $appid=Auth::user()->pgapp_id;
        $declaration_status=$request->boolean("declaration_status");
        if($declaration_status=='true'){
            $declaration_status=1;
        }
        else{
            $declaration_status=0;
        }
      
//        dd($this->payment_success_status());
        if( ($this->payment_success_status() > 0) ||  (Auth::user()->pg_edit_appl == 1) ){
//            dd('s');
           
                $data=User::where('pgapp_id',$appid)

                             ->update([

                                'pg_edit_appl'=>0,
                                'declaration_status'=>$declaration_status

                   ]);
                Session::flash('message', "Successfully edited!!!");
                Session::flash('alert-class', 'alert-success');   
                 
                return redirect()->route('pay_details');
          
        }
        
        else {
           
            
        $dt_now = Carbon::now();
        $trn_date= $dt_now->toDateString();
       date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        
//        $mytime = Carbon\Carbon::now();
        
        $datereg=Carbon::now();
        $pgapp_sl= Auth::user()->pgapp_sl;
        $pgapp_mobile= Auth::user()->pgapp_mobile;
        $pgapp_email= Auth::user()->pgapp_email;
        $pgapp_name= Auth::user()->pgapp_name;
        $transactionId = rand(100000,100000000).$pgapp_sl;
        $clentcode= Auth::user()->pgapp_id;
        $pgapp_stream_id= Auth::user()->pgapp_stream_id;
        $pgapp_community= Auth::user()->pgapp_community;
        
        
        
        //dd($pgapp_stream_id);
 
        if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
        {
        $amnt=DB::select("select pg_scstfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);

        foreach ( $amnt as $value) {
          $amount=$value->pg_scstfee;
        }

        }
        else {
           $amnt=DB::select("select pg_normalfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);
           foreach ( $amnt as $value) {
                  $amount=$value->pg_normalfee;
           }

        }
        
       $sub=DB::select("select pgapp_adsc_sl from tb_pgapp where  pgapp_sl=?",[$pgapp_sl]);
        foreach ($sub as $value1) {
              $pgapp_adsc_sl=$value1->pgapp_adsc_sl;
       }


           //Translation and office proceedings
           if($pgapp_adsc_sl=="1200")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=50;
               }
               else
               {
                 $amount=150;  
               }

           }
           //PG Diploma in Wellness and Spa Management
           if($pgapp_adsc_sl=="1201")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

           }
            //PG Diploma in Manuscriptology
           if($pgapp_adsc_sl=="1202")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

           }
           //PG Diploma in Translation Studies
           if($pgapp_adsc_sl=="1204")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

           }
           //MPES
           if($pgapp_adsc_sl=="1195")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=100;
               }
               else
               {
                 $amount=300;  
               }

           }
           //MFA
           if($pgapp_adsc_sl=="1194")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

           }
           //MSC
           if($pgapp_adsc_sl=="1191" || $pgapp_adsc_sl=="1192")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=75;
               }
               else
               {
                 $amount=220;  
               }

           }
           //Museology and MSW
            if($pgapp_adsc_sl=="1188" || $pgapp_adsc_sl=="1193") //841,910

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=100;
               }
               else
               {
                 $amount=300;  
               }

            }
            
            if($pgapp_adsc_sl=="1196" || $pgapp_adsc_sl=="1197" || $pgapp_adsc_sl=="1198" || $pgapp_adsc_sl=="1199" ) //Masters Programme in Disaster Management and Mitigation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

            }
            if($pgapp_adsc_sl=="997") //Post Graduate Diploma in Sanskrit Computational Linguistics

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=175;
               }
               else
               {
                 $amount=750;  
               }

            }
            
            if($pgapp_adsc_sl=="1065") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

            }
            if($pgapp_adsc_sl=="1151") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

            }
            

            $paymenttrans=new PaymentTrans;
             
            $paymenttrans->merchanttxnid=$transactionId;
           
            $paymenttrans->trans_amt=$amount;
             // dd($pgapp_adsc_sl);
            $paymenttrans->tdate=$trn_date;
            $paymenttrans->client_code=$clentcode;
           
            $paymenttrans->res_udf9_clientcode=$pgapp_sl;
            $paymenttrans->ucity_service='PG-ENTRANCE-FEE-'.date('Y');
            
            $paymenttrans->trans_timestamp=Carbon::now();
            
           
            
            
            $paymenttranssave = $paymenttrans->save();

              $datapg=User::where('pgapp_sl',$pgapp_sl)                     
                ->update([
                   'onlinepay_merchanttxnid'=>$transactionId,
                    'onlinepay_amount'=>$amount,
                    'onlinepay_tdate'=>$datereg,
                    'declaration_status'=>$declaration_status
                  ]);
              

            $transactionRequest = new TransactionRequest();

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


           $transactionRequest->setMode("live");
           $transactionRequest->setLogin(71480);
           $transactionRequest->setPassword("SREE@123");
           $transactionRequest->setProductId("UNIVERSITY");
           $transactionRequest->setAmount($amount);//$total
           $transactionRequest->setTransactionCurrency("INR");
           $transactionRequest->setTransactionAmount($amount);//$total 
//           $transactionRequest->setReturnUrl("http://14.139.185.106:93/home/postpgfeeresponse");
           $transactionRequest->setReturnUrl("https://pgadmission.ssus.ac.in/home/postpgfeeresponse");

           $transactionRequest->setClientCode($clentcode);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($pgapp_name);//$name_stud
            $transactionRequest->setCustomerEmailId($pgapp_email);//$email
            $transactionRequest->setCustomerMobile($pgapp_mobile);//$mob_no
            // $transactionRequest->setCustomerBillingAddress("Kerala");
            $transactionRequest->setAppId($pgapp_sl);
            $transactionRequest->setCustomerAccount("639827");
            $transactionRequest->setReqHashKey("e0a176300774097599");


            $url = $transactionRequest->getPGUrl();
          
             return Redirect::to($url);   
       
        }
        
                               
                                
    }
    
    
    
    //atom
    public function pgpayment_atom(Request $request)
    {
//         $request->validate([
//           
//            'declaration_status' => 'accepted'
//        ]);
//       
  
        $appid=Auth::user()->pgapp_id;
        $declaration_status=$request->boolean("declaration_status");
        if($declaration_status=='true'){
            $declaration_status=1;
        }
        else{
            $declaration_status=0;
        }
      
//        dd($this->payment_success_status());
        if( ($this->payment_success_status() > 0) ||  (Auth::user()->pg_edit_appl == 1) ){
//            dd('s');
           
                $data=User::where('pgapp_id',$appid)

                             ->update([

                                'pg_edit_appl'=>0,
                                'declaration_status'=>$declaration_status

                   ]);
                Session::flash('message', "Successfully edited!!!");
                Session::flash('alert-class', 'alert-success');   
                 
                return redirect()->route('pay_details');
          
        }
        
        else {
           
            
        $dt_now = Carbon::now();
        $trn_date= $dt_now->toDateString();
       date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        
//        $mytime = Carbon\Carbon::now();
        
        $datereg=Carbon::now();
        $pgapp_sl= Auth::user()->pgapp_sl;
        $pgapp_mobile= Auth::user()->pgapp_mobile;
        $pgapp_email= Auth::user()->pgapp_email;
        $pgapp_name= Auth::user()->pgapp_name;
        $transactionId = rand(100000,100000000).$pgapp_sl;
        $clentcode= Auth::user()->pgapp_id;
        $pgapp_stream_id= Auth::user()->pgapp_stream_id;
        $pgapp_community= Auth::user()->pgapp_community;
        
        
        
        //dd($pgapp_stream_id);
 
        if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
        {
        $amnt=DB::select("select pg_scstfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);

        foreach ( $amnt as $value) {
          $amount=$value->pg_scstfee;
        }

        }
        else {
           $amnt=DB::select("select pg_normalfee from tb_pg_stream where pgstream_id=?",[$pgapp_stream_id]);
           foreach ( $amnt as $value) {
                  $amount=$value->pg_normalfee;
           }

        }
        
       $sub=DB::select("select pgapp_adsc_sl from tb_pgapp where  pgapp_sl=?",[$pgapp_sl]);
        foreach ($sub as $value1) {
              $pgapp_adsc_sl=$value1->pgapp_adsc_sl;
       }


           //Translation
           if($pgapp_adsc_sl=="1132")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=50;
               }
               else
               {
                 $amount=150;  
               }

           }
           //PG Diploma in Wellness and Spa Management
           if($pgapp_adsc_sl=="1128")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

           }
           //MPES
           if($pgapp_adsc_sl=="1131")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=100;
               }
               else
               {
                 $amount=300;  
               }

           }
           //MFA
           if($pgapp_adsc_sl=="1130")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

           }
           //MSC
           if($pgapp_adsc_sl=="1122" || $pgapp_adsc_sl=="1123")

           {
               if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=75;
               }
               else
               {
                 $amount=220;  
               }

           }
           //Museology and MSW
            if($pgapp_adsc_sl=="1119" || $pgapp_adsc_sl=="1129") //841,910

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=100;
               }
               else
               {
                 $amount=300;  
               }

            }
            
            if($pgapp_adsc_sl=="1124" || $pgapp_adsc_sl=="1125" || $pgapp_adsc_sl=="1126" || $pgapp_adsc_sl=="1127" ) //Masters Programme in Disaster Management and Mitigation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

            }
            if($pgapp_adsc_sl=="997") //Post Graduate Diploma in Sanskrit Computational Linguistics

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=175;
               }
               else
               {
                 $amount=750;  
               }

            }
            
            if($pgapp_adsc_sl=="1065") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=200;
               }
               else
               {
                 $amount=500;  
               }

            }
            if($pgapp_adsc_sl=="1151") //Post Graduate Diploma in Active Ageing and Wellness Rehabilitation

            {
             if(($pgapp_community=='SC')OR ($pgapp_community=='ST')OR($pgapp_community=='ST-MUSLIM')OR($pgapp_community=='ST-OEC')OR($pgapp_community=='SC-OEC'))
               {
                   $amount=300;
               }
               else
               {
                 $amount=1000;  
               }

            }
            

            $paymenttrans=new PaymentTrans;
             
            $paymenttrans->merchanttxnid=$transactionId;
           
            $paymenttrans->trans_amt=$amount;
             // dd($pgapp_adsc_sl);
            $paymenttrans->tdate=$trn_date;
            $paymenttrans->client_code=$clentcode;
           
            $paymenttrans->res_udf9_clientcode=$pgapp_sl;
            $paymenttrans->ucity_service='PG-ENTRANCE-FEE-'.date('Y');
            
            $paymenttrans->trans_timestamp=Carbon::now();
            
           
            
            
            $paymenttranssave = $paymenttrans->save();

              $datapg=User::where('pgapp_sl',$pgapp_sl)                     
                ->update([
                   'onlinepay_merchanttxnid'=>$transactionId,
                    'onlinepay_amount'=>$amount,
                    'onlinepay_tdate'=>$datereg,
                    'declaration_status'=>$declaration_status
                  ]);
              

            $transactionRequest = new TransactionRequest();

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


           $transactionRequest->setMode("live");
           $transactionRequest->setLogin(71480);
           $transactionRequest->setPassword("SREE@123");
           $transactionRequest->setProductId("UNIVERSITY");
           $transactionRequest->setAmount($amount);//$total
           $transactionRequest->setTransactionCurrency("INR");
           $transactionRequest->setTransactionAmount($amount);//$total 
//           $transactionRequest->setReturnUrl("http://14.139.185.106:93/home/postpgfeeresponse");
           $transactionRequest->setReturnUrl("https://pgadmission.ssus.ac.in/home/postpgfeeresponse");

           $transactionRequest->setClientCode($clentcode);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($pgapp_name);//$name_stud
            $transactionRequest->setCustomerEmailId($pgapp_email);//$email
            $transactionRequest->setCustomerMobile($pgapp_mobile);//$mob_no
            // $transactionRequest->setCustomerBillingAddress("Kerala");
            $transactionRequest->setAppId($pgapp_sl);
            $transactionRequest->setCustomerAccount("639827");
            $transactionRequest->setReqHashKey("e0a176300774097599");


            $url = $transactionRequest->getPGUrl();
          
             return Redirect::to($url);   
       
        }
        
                               
                                
    }
    
    public function postpgfeeresponse(Request $request){

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
                          
//                         'atom_txn_id'=>$ipg_txn_id,
                        ]);     
 
    
           Session::flash('message', "Successfully registered!!!");
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

            Session::flash('message', "Payement Failed Try again!!!");
           Session::flash('alert-class', 'alert-danger');   
           return redirect()->route('pay_details');
        }
    } 
    else {
        return "Invalid Signature";

    }
        
      
}   

    public function pgbalancepayment(Request $request)
    {
//         $request->validate([
//           
//            'declaration_status' => 'accepted'
//        ]);
//       
  
        $appid=Auth::user()->pgapp_id;
        
           
        $dt_now = Carbon::now();
        $trn_date= $dt_now->toDateString();
      date_default_timezone_set('Asia/Kolkata');
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        
//        $mytime = Carbon\Carbon::now();
        
        $datereg=Carbon::now();
        $pgapp_sl= Auth::user()->pgapp_sl;
        $pgapp_mobile= Auth::user()->pgapp_mobile;
        $pgapp_email= Auth::user()->pgapp_email;
        $pgapp_name= Auth::user()->pgapp_name;
        $transactionId = rand(100000,100000000).$pgapp_sl;
        $clentcode= Auth::user()->pgapp_id;
        $pgapp_stream_id= Auth::user()->pgapp_stream_id;
        $pgapp_community= Auth::user()->pgapp_community;
        $amount=100;
      
            $paymenttrans=new PaymentTrans;
            $paymenttrans->merchanttxnid=$transactionId;
            $paymenttrans->trans_amt=$amount;
            $paymenttrans->tdate=$trn_date;
            $paymenttrans->client_code=$clentcode;
            $paymenttrans->res_udf9_clientcode=$pgapp_sl;
            $paymenttrans->ucity_service='PG-ENTRANCE-FEE-BALANCE-'.date('Y');
            $paymenttrans->trans_timestamp=Carbon::now();
            $paymenttranssave = $paymenttrans->save();

              $datapg=User::where('pgapp_sl',$pgapp_sl)                     
                ->update([
                   'onlinepay_merchanttxnid'=>$transactionId,
                    'onlinepay_amount'=>$amount,
                    'onlinepay_tdate'=>$datereg,
                  ]);

            $transactionRequest = new TransactionRequest();

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


           $transactionRequest->setMode("live");
           $transactionRequest->setLogin(71480);
           $transactionRequest->setPassword("SREE@123");
           $transactionRequest->setProductId("UNIVERSITY");
           $transactionRequest->setAmount($amount);//$total
           $transactionRequest->setTransactionCurrency("INR");
           $transactionRequest->setTransactionAmount($amount);//$total 
//           $transactionRequest->setReturnUrl("http://14.139.185.106:93/home/postpgfeeresponse");
           $transactionRequest->setReturnUrl("https://pgadmission.ssus.ac.in/home/postpgfeeresponse");

           $transactionRequest->setClientCode($clentcode);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($pgapp_name);//$name_stud
            $transactionRequest->setCustomerEmailId($pgapp_email);//$email
            $transactionRequest->setCustomerMobile($pgapp_mobile);//$mob_no
            // $transactionRequest->setCustomerBillingAddress("Kerala");
            $transactionRequest->setAppId($pgapp_sl);
            $transactionRequest->setCustomerAccount("639827");
            $transactionRequest->setReqHashKey("e0a176300774097599");


            $url = $transactionRequest->getPGUrl();
          
             return Redirect::to($url);   
       
      
                                 
    }
    
    public function getpdf(Request $request){
    
    $appid=Auth::user()->pgapp_id;


        
    if($this->payment_success_status()){
         
            $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
//                return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
        date_default_timezone_set('Asia/Kolkata');
            $time= date("H:i:s");
            $pgapp = DB::table('tb_pgapp')
            ->select('tb_pgapp.*', 'tb_admnscheme.adsc_name', 'tb_gender.gender_name')
            ->leftJoin('tb_admnscheme', 'tb_admnscheme.adsc_sl', '=', 'tb_pgapp.pgapp_adsc_sl')
            ->leftJoin('tb_gender', 'tb_gender.gender_sl', '=', 'tb_pgapp.pgapp_gender_sl')
            ->leftJoin('tbz_reservation_list', 'tbz_reservation_list.id', '=', 'tb_pgapp.pgapp_caste_sl')
            ->where('tb_pgapp.pgapp_id', '=', $appid)
            ->get();
            
        
            foreach ($pgapp as $value) {
                $ugcourse_status=$value->ugcourse_status;
            }
            
//            atom
//            $payment_success= PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-2025")->where('res_verified',"SUCCESS")->first();
            
           $payment_balnc = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-BALANCE-2025")->where('res_verified',"SUCCESS")->first();
             
//            ccavenue
            $payment_success= CcTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-APPLICATION-FEE-2026")->whereIn('order_status', ['Success', 'Shipped'])->first();
//            dd($payment_success);
            $religion= DB::table('tb_religion')
                ->select('relgn_sl','relgn_name')
                ->get();
        
             $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
             foreach ($pgquali as $value) {
                $courseduration=$value->courseduration;
                $coursetype=$value->coursetype;

              }
            $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
            
//             $pgoptions= DB::table('tb_pg_pgpgm')
//                ->select('*')
//                ->where('pgpgm_pgapp_id','=',$appid)
//                ->get();
              $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,tb1.pg_entrance_centre from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);
                      
           if($coursetype=="SEMESTER WISE"){
               $semester_grades = $this->getMarkList($appid, $ugcourse_status, $courseduration);
               $name="Sem";
            }
            else if($coursetype=="YEAR WISE"){
                   $semester_grades = $this->getMarkListYear($appid, $ugcourse_status, $courseduration);
                   $name="Year";
            }
            
            $pmodeoption= DB::table('tb_pg_projectmode')
                ->select('*')
                ->where('pgapp_id','=',$appid)
                ->get();
             $pflag=0;
             if(!$pmodeoption->isEmpty()){
                 $pflag=1;
             }

            else{
                 $pflag=0;
            }

            $record = DB::table('tb_pg_pgquali')->where('pgquali_pgapp_id', $appid)->first();
               

            // Ensure variables are set correctly to avoid errors
            $filePathSSLC = $record->file_sslc_path;
            $filePathHSE = $record->file_degree_path;
            $fileUrlaadhar = $record->file_aadhar_path;

            $special_file_record = DB::table('tbz_pgotherinfo')
                    ->where('pgotherinfo_appid', $appid)
                    ->first();
                
                $filePathSpecial = $special_file_record->file_special_path;

                $campus_options = DB::select('SELECT pgpgm_pgapp_id,pg_option,pgpgm_centre_sl, getcentrename(pgpgm_centre_sl) as cent
                FROM public.tb_pg_pgpgm where pgpgm_pgapp_id=? ORDER BY pg_option', [$appid]);

//           return view('applnprintout',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto',
//                    'pgsign','curnt_date','time','pgoptions','semester_grades','payment_success'));

            // $pdf = PDF::loadView('applnprintout',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto',
            //         'pgsign','curnt_date','time','pgoptions','semester_grades','payment_success','name','pflag','pmodeoption','payment_balnc'));

            $pdf = PDF::loadView('applnprintout',compact('pgapp','religion','pgquali','pgotherinfo',
            'curnt_date','time','pgoptions','semester_grades','payment_success','name','pflag','pmodeoption',
            'payment_balnc','filePathSSLC','filePathHSE','filePathSpecial','campus_options','fileUrlaadhar'));

        return $pdf->download('PgApplication.pdf');
     }
     else{
         return "Something went wrong";
     }

    }
    
    
    
    
    
    public function interviewmemo(){
      
     $appid=Auth::user()->pgapp_id;  
     $adscl=Auth::user()->pgapp_adsc_sl;  
     $adscname = DB::select('select adsc_name,pgm_name from  tb_admnscheme 
          inner join tb_program on pgm_sl=adsc_pgm_sl where adsc_sl=? ' , [$adscl]);

     foreach($adscname as $key){
         $pgmname=$key->pgm_name;
     }
     $fee =[];
//     $allotment = DB::select('select *,getcentrename(centid) as allot_cent,getpgm(pgmid) as pgm FROM tb_pgallotmentdate INNER JOIN
//         admn22.pg_allotment ON tb_pgallotmentdate.sh_adscsl = admn22.pg_allotment.pgmid
//            where admn22.pg_allotment.appid=?',[$appid]);
//     $allotment = DB::select('select *,getcentrename(cent) as allot_cent,getpgm(pgm) as pgm,upper(seat) as seat,
//         upper(weightage) as weightage FROM tb_pgallotmentdate LEFT JOIN
//         admn22.seat_allocation_matrix ON tb_pgallotmentdate.sh_adscsl = admn22.seat_allocation_matrix.pgm
//            where admn22.seat_allocation_matrix.app_id=?',[$appid]);
     
     $allotment = DB::select('
    SELECT *, 
           getcentrename(cent) AS allot_cent, 
           getpgm(pgm) AS pgm, 
           UPPER(seat) AS seat, 
           UPPER(weightage) AS weightage 
    FROM admn22.seat_allocation_matrix 
    WHERE app_id = ?
', [$appid]);

// dd($allotment);
      $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
          date_default_timezone_set('Asia/Kolkata');
            $timenow= date("H:i:s");
//      if($adscl==1041 || $adscl==1054 || $adscl==1063 || $adscl==1064)   {
//         $fee = DB::select('select fee_title,fee_gen from asw_admfee_list where fee_adsc_sl=? ' , [1054]); 
//      } 
       if($adscl==1126 || $adscl==1127 || $adscl==1124 || $adscl==1125)   {
         $fee = DB::select('select fee_title,fee_gen from asw_admfee_list where fee_adsc_sl=? ' , [1126]); 
      }
      
      if($adscl==1085)   {
         $fee = DB::select('select fee_title,fee_gen from asw_admfee_list where fee_adsc_sl=? ' , [1085]); 
      } 
            // dd($fee);
    if(empty($allotment)){
        return "If any memo download problem, please contact SSUS IT Section.";  
    }
    else{

//        dd($fee);
//        $pdf = PDF::loadView('2022.interviewmemo',compact('allotment','curnt_date','timenow','pgmname','adscl'));
        $pdf = PDF::loadView('2022.interviewmemo',compact('allotment','curnt_date','timenow','pgmname','adscl','fee'));

        return $pdf->download('InterviewMemo.pdf');
     
    }

    }  
    
    public function interviewmemotest(){
      
     $appid=Auth::user()->pgapp_id;  
     $adscl=Auth::user()->pgapp_adsc_sl;  
     $adscname = DB::select('select adsc_name,pgm_name from  tb_admnscheme 
          inner join tb_program on pgm_sl=adsc_pgm_sl where adsc_sl=? ' , [$adscl]);

     foreach($adscname as $key){
         $pgmname=$key->pgm_name;
     }
     
//     $allotment = DB::select('select *,getcentrename(centid) as allot_cent,getpgm(pgmid) as pgm FROM tb_pgallotmentdate INNER JOIN
//         admn22.pg_allotment ON tb_pgallotmentdate.sh_adscsl = admn22.pg_allotment.pgmid
//            where admn22.pg_allotment.appid=?',[$appid]);
     $allotment = DB::select('select *,getcentrename(cent) as allot_cent,getpgm(pgm) as pgm,upper(seat) as seat,
         upper(weightage) as weightage FROM tb_pgallotmentdate INNER JOIN
         admn22.seat_allocation_matrix ON tb_pgallotmentdate.sh_adscsl = admn22.seat_allocation_matrix.pgm
            where admn22.seat_allocation_matrix.app_id=?',[$appid]);
//     dd($allotment);
      $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
          date_default_timezone_set('Asia/Kolkata');
            $timenow= date("H:i:s");

    if(empty($allotment)){
        return "You are not in the Allotment list";  
    }
    else{
        $pdf = PDF::loadView('2022.interviewmemotest',compact('allotment','curnt_date','timenow','pgmname'));

        return $pdf->download('InterviewMemo.pdf');
     
    }

    }  
    
    public function checkpay(Request $request)
    {
       // dd($request);
//       
//        if( Auth::user()->pgapp_id == 'ADMPG2400035qqq') {
//       
//                        dd('helloooo1111ssss'); 
//           }
       //  $appid=Auth::user()->pgapp_id;
        $nodata='NODATA';
         $appid=  $request->input('pgapp_id');
         $verification = 'SUCCESS';
         $t=" ('Cancelled') ";
         try
         {
            $amnt=DB::connection('pgsql2')->select("select * from tbz_atom_transactions where    ucity_service = 'PG-ENTRANCE-FEE-2025' and  client_code=?  order by trans_id limit 100	  ",[$appid]);

        // $amnt=DB::connection('pgsql2')->select("select * from tbz_atom_transactions where    ucity_service = 'PG-ENTRANCE-FEE-2024' and  client_code=?  order by trans_id limit 100	  ",[$appid]);
           //$amnt=DB::connection('pgsql2')->select("select * from tbz_atom_transactions where((client_code = '$appid') and (res_verified = '$verification')) ");
//        dd($amnt);
        
         }
         catch(Exception $e)
         {
             dd($e);
         }
        //dd($amnt); 
        foreach ( $amnt as $value2) {
            
                  $trans_amt=$value2->trans_amt;
                  $merchanttxnid=$value2->merchanttxnid;
                  $tdate=$value2->tdate;
                  
                $xml=simplexml_load_file("https://payment.atomtech.in/paynetz/vfts?merchantid=71480&merchanttxnid=".$merchanttxnid."&amt=".$trans_amt."&tdate=".$tdate."");
        
                   $xmlvalues=$xml->attributes();
        $verfied=$xml->attributes()->VERIFIED;
        $merchanttxnid=$xml->attributes()->MerchantTxnID;
        $bank_txn=$xml->attributes()->BID;
        $discriminator=$xml->attributes()->discriminator;
        $mmp_txn=$xml->attributes()->atomtxnId;
        $CardNumber=$xml->attributes()->CardNumber;
        $surcharge=$xml->attributes()->surcharge;
        $CardNumber=$xml->attributes()->CardNumber;
        $surcharge=$xml->attributes()->surcharge;
        $udf9=$xml->attributes()->UDF9;
        $TxnDate=$xml->attributes()->TxnDate;
         if(strtoupper($verfied)=='SUCCESS'){
             $bankname=$xml->attributes()->bankname;
            $MerchantID=$xml->attributes()->MerchantID;
           $dateofpay=$xml->attributes()->TxnDate;
            $MerchantID=$xml->attributes()->MerchantID;
           
             $datastudexam=User::where('pgapp_sl',$udf9)
                      
                      ->update([
                        
                         'onlinepay_status'=>1,
                         
                        ]);
             $datapay=PaymentTrans::where('merchanttxnid',$merchanttxnid)
                      
                      ->update([
                       'res_bankname' => $bankname,
                         'res_bid'=>$bank_txn,
                       'res_verified'=>$xml->attributes()->VERIFIED,
                         'res_discriminator'=>$discriminator,
                          'res_atomtxn_id'=>$mmp_txn,
                         'res_card_number'=>$CardNumber,
                          'res_surcharge'=>$surcharge,
                           'res_txn_date'=>$dateofpay,
                          'res_udf9_clientcode'=>$udf9,
                          
//                         'atom_txn_id'=>$ipg_txn_id,
                        ]); 
        }
       
        if(strtoupper($verfied)=='FAILED'){
             $bankname=$xml->attributes()->bankname;
            $MerchantID=$xml->attributes()->MerchantID;
           $dateofpay=$xml->attributes()->TxnDate;
            $MerchantID=$xml->attributes()->MerchantID;
           // dd($bankname);
           //  dd($udf9);
             if(true) {
             $datastudexam=User::where('pgapp_sl',$udf9)
                      
                      ->update([
                        
                         'onlinepay_status'=>0,
                         
                        ]);
            
             $datapay=PaymentTrans::where('merchanttxnid',$merchanttxnid)
                      
                      ->update([
                       'res_bankname' => $bankname,
                         'res_bid'=>$bank_txn,
                       'res_verified'=>$xml->attributes()->VERIFIED,
                         'res_discriminator'=>$discriminator,
                          'res_atomtxn_id'=>$mmp_txn,
                         'res_card_number'=>$CardNumber,
                          'res_surcharge'=>$surcharge,
                           'res_txn_date'=>$dateofpay,
                          'res_udf9_clientcode'=>$udf9,
                          
//                         'atom_txn_id'=>$ipg_txn_id,
             ]);
             
             }
              
        }
        
           }
       
        
       //    $trans_amt=150;
        
            
        
         return redirect()->back()->with('success', 'your message,here');
        
       
    }
    public function checkpayone()
    {
//        dd('$request');
//       
//        if( Auth::user()->pgapp_id == 'ADMPG2400035qqq') {
//       
//                        dd('helloooo1111ssss'); 
//           }
       //  $appid=Auth::user()->pgapp_id;
        $merchanttxnid="1313268960868";
        $nodata='NODATA';
         $appid= 'ADMPG2400120';
         $verification = 'SUCCESS';
         $t=" ('Cancelled') ";
         try
         {
         $amnt=DB::connection('pgsql2')->select("select * from tbz_atom_transactions where    ucity_service = 'PG-ENTRANCE-FEE-2024'  and merchanttxnid=?  order by trans_id limit 10	  ",[$merchanttxnid]);
           //$amnt=DB::connection('pgsql2')->select("select * from tbz_atom_transactions where((client_code = '$appid') and (res_verified = '$verification')) ");
         
//         dd($amnt);
         }
         catch(Exception $e)
         {
             dd($e);
         }
        //dd($amnt); 
        foreach ( $amnt as $value2) {
                  $trans_amt=$value2->trans_amt;
                  $merchanttxnid=$value2->merchanttxnid;
                  $tdate=$value2->tdate;
                  
                   $xml=simplexml_load_file("https://payment.atomtech.in/paynetz/vfts?merchantid=71480&merchanttxnid=".$merchanttxnid."&amt=".$trans_amt."&tdate=".$tdate."");
                   
    }
//    dd($xml);
    
        }


        public function uploadDocuments(Request $request) {
           //dd($request->all());
            try {
                // Validate input
               //dd($request->all());
               $appid = Auth::user()->pgapp_id;
                $pgapp_sl = Auth::id();
               $record = DB::table('tb_pg_pgquali')->where('pgquali_pgapp_id', $appid)->first();
               

            // Ensure variables are set correctly to avoid errors
            $filePathSSLC = $record->file_sslc_path ?? null;
            $filePathHSE = $record->file_degree_path ?? null;
            $filePathAadhar  = $record->file_aadhar_path ?? null;

            $request->validate([
                'pdf_file_sslc' => ($request->hasFile('pdf_file_sslc') || empty($filePathSSLC)) 
                    ? 'required|file|mimes:pdf|max:1024' : 'nullable|file|mimes:pdf|max:1024',
                'pdf_file_hse' => ($request->hasFile('pdf_file_hse') || empty($filePathHSE)) 
                    ? 'required|file|mimes:pdf|max:1024' : 'nullable|file|mimes:pdf|max:1024',
                    'pdf_file_aadhar' => ($request->hasFile('pdf_file_aadhar') || empty($filePathAadhar)) 
                    ? 'required|file|mimes:pdf|max:1024' : 'nullable|file|mimes:pdf|max:1024',
                'doc' => 'nullable|file|mimes:pdf|max:1024',
                'pdf_file_special' => 'nullable|file|mimes:pdf|max:1024',
            ], [
                'pdf_file_sslc.required' => 'The 10th certificate is required.',
                'pdf_file_hse.required' => 'The Degree certificate is required.',
                'pdf_file_aadhar.required' => 'The Degree certificate is required.',
                'pdf_file_sslc.mimes' => 'Only PDF files are allowed.',
                'pdf_file_hse.mimes' => 'Only PDF files are allowed.',
                'pdf_file_aadhar.mimes' => 'Only PDF files are allowed.',
                'pdf_file_sslc.max' => 'File size must be less than 1MB.',
                'pdf_file_hse.max' => 'File size must be less than 1MB.',
                'pdf_file_aadhar.max' => 'File size must be less than 1MB.',
            ]);

                $appid = Auth::user()->pgapp_id;
                $pgapp_sl = Auth::id();
        
                // ====== Handle Special Document Upload ======
                $special_file_record = DB::table('tbz_pgotherinfo')
                    ->where('pgotherinfo_appid', $appid)
                    ->first();
                
                $filePathSpecial = $special_file_record->file_special_path ?? null;
        
                if ($request->hasFile('pdf_file_special')) {
                    if ($filePathSpecial && Storage::disk('public')->exists($filePathSpecial)) {
                        Storage::disk('public')->delete($filePathSpecial);
                    }
                    $filePathSpecial = $request->file('pdf_file_special')->store('certificates', 'public');
                }
        
                if ($special_file_record) {
                    DB::table('tbz_pgotherinfo')
                        ->where('pgotherinfo_appid', $appid)
                        ->where('pgapp_sl_ref', $pgapp_sl)
                        ->update(['file_special_path' => $filePathSpecial]);
                } else {
                    DB::table('tbz_pgotherinfo')->insert([
                        'pgotherinfo_appid' => $appid,
                        'pgapp_sl_ref' => $pgapp_sl,
                        'file_special_path' => $filePathSpecial
                    ]);
                }
        
                // ====== Handle SSLC & HSE Document Uploads ======
                $record = DB::table('tb_pg_pgquali')->where('pgquali_pgapp_id', $appid)->first();
                if (!$record) {
                    return redirect()->back()->with('error', 'Record not found.');
                }
        
                $filePath = $record->file_sslc_path ?? null;
                $filePathHse = $record->file_degree_path ?? null;
                $filePathAadhar  = $record->file_aadhar_path ?? null;
        
                if ($request->hasFile('pdf_file_sslc')) {
                    if ($filePath && Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                    $filePath = $request->file('pdf_file_sslc')->store('certificates', 'public');
                }
        
                if ($request->hasFile('pdf_file_hse')) {
                    if ($filePathHse && Storage::disk('public')->exists($filePathHse)) {
                        Storage::disk('public')->delete($filePathHse);
                    }
                    $filePathHse = $request->file('pdf_file_hse')->store('certificates', 'public');
                }
                if ($request->hasFile('pdf_file_aadhar')) {
                    if ($filePathAadhar && Storage::disk('public')->exists($filePathAadhar)) {
                        Storage::disk('public')->delete($filePathAadhar);
                    }
                    $filePathAadhar = $request->file('pdf_file_aadhar')->store('certificates', 'public');
                }

        
                DB::table('tb_pg_pgquali')
                    ->where('pgquali_pgapp_id', $appid)
                    ->update([
                        'file_sslc_path' => $filePath,
                        'file_degree_path' => $filePathHse,
                        'file_aadhar_path' => $filePathAadhar
                    ]);
        
                // ====== Handle Additional Document Upload ======
                if ($request->hasFile('doc')) {
                    $file = $request->file('doc');
                    //dd($file);
                    $filename = $appid . '-' . str_replace(' ', '', $file->getClientOriginalName());
                    $directory = 'Candidate-Certificates/' . $appid;
        
                    if (!Storage::disk('public')->exists($directory)) {
                        Storage::disk('public')->makeDirectory($directory);
                    }
        
                    $storagePath = Storage::disk('public')->putFileAs($directory, $file, $filename);
                    
                    $user = User::where('pgapp_sl', $pgapp_sl)->first();
                    if ($user) {
                        $user->update(['directory_docs' => $storagePath]);
                    }
                    //dd($user);
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Documents uploaded successfully.'
                ]);
        
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        }
        




}
