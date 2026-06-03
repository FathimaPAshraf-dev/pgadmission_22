<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class RankListController extends Controller
{
    
        public function rank_pg1(Request $request) {
       // return "yes";
        $list = DB::select('select * from  tb_pg_entrancexam where pub_ranklist=1');
        return view('viewranklistpgnew',compact('list')); 
        }
    public function rank_pg(Request $request) {
       // return "yes";
        $list = DB::select('select * from  tb_pg_entrancexam where pub_ranklist=1');
      // dd($list); 
     //  return  "yes";
       return view('viewranklistpg',compact('list'));

       //dd($list); 
    }
     public function rank_ab(Request $request) {
         
        $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS' and tb3.adsc_name like '%M.PHIL%'   group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
//          dd($count)   ;      
        return view('viewranklist',compact('count'));
      
    }
   
     public function pgranklistpdf($id){
         
       // dd($id);  
//          $dob=' to_char(rank_dob, "DD/MM/YYYY") as rank_dob ' ;
ini_set("max_execution_time",0 );
          $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
             $adscname = DB::select('select adsc_name from  tb_admnscheme  where adsc_sl=? ' , [$id]);
$rank = DB::select('select * from tbz_pgranklist where rank_adscsl=? order by rank ',[$id]);


   // dd($adscname) ; 
//dd($rank);

 $pdf = PDF::loadView('pgranklistpdf',compact('rank','adscname','curnt_date','time'));
//dd($pdf);
// $pdf = PDF::loadView('ranklistpdf',compact('studlist','studlistjrf','adsc_admnyear','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('PGRanklist.pdf');
     }
    public function mphilranklistpdf($id){
//    dd($id);
                $dobform='DD-MM-YYYY';
 $sc="SC";
 
 $st="ST";
 $ph=1;
 
     $studlist = DB::select("SELECT 
                    tb_program.pgm_name, 
                    tb_admnscheme.adsc_name, 
                    tb_admnscheme.adsc_sl,tb_admnscheme.adsc_admnyear,
                    tbz_atom_transactions.res_verified, 
                    upper(tb_postpgapp.postpgapp_studname) as postpgapp_studname, 
                    tb_postpgapp.postpgapp_appid,
                    tb_postpgapp.postpgapp_rollno,
                    tb_postpgapp.postpgapp_community,
                    tb_postpgapp.postpgapp_dob,
                    tbz_postpgotherinfo.ph_status,
                    tb_postpgapp.postpg_indexmark,
                    tb_postpgapp.mphilrenotification,
                    tbz_postpgotherinfo.postpgjrf_option
                  FROM 
                    public.tb_admnscheme, 
                    public.tb_program, 
                    public.tbz_atom_transactions, 
                    public.tb_postpgapp,
                    public.tbz_postpgotherinfo,
                    public.tb_postpg_entrancexam 
                  WHERE 
                    tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
                    tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
                    tb_postpgapp.onlinepay_merchanttxnid = tbz_atom_transactions.merchanttxnid AND
                    tbz_postpgotherinfo.postpgapp_sl_ref=tb_postpgapp.postpgapp_sl AND
                    tbz_atom_transactions.res_verified='SUCCESS' AND
                    tb_postpg_entrancexam.ent_adscsl=tb_postpgapp.postpgapp_adsc_sl_ref AND                    

                 ( (  (postpg_indexmark > 0.00 and postpg_indexmark is not null ) and   tb_postpgapp.postpgapp_adsc_sl_ref=? 
                    and  ((tb_postpgapp.postpg_indexmark >= tb_postpg_entrancexam.ent_cuttoff)
     
      OR (tb_postpgapp.postpg_indexmark >= tb_postpg_entrancexam.sc_st_cuttoff AND tbz_postpgotherinfo.ph_status=?)
      OR (tb_postpgapp.postpg_indexmark >= tb_postpg_entrancexam.sc_st_cuttoff AND postpgapp_community in('OBX','OBH','MUSLIM','LC/SIUC','EZHAVA','SC','ST') ))   ) 
)
      
                 order by postpg_indexmark desc,postpgapp_dob asc,postpgapp_studname asc", [$id,$ph]);
     
     $studlistjrf = DB::select("SELECT 
                    tb_program.pgm_name, 
                    tb_admnscheme.adsc_name, 
                    tb_admnscheme.adsc_sl,
                    tb_admnscheme.adsc_admnyear,
                    tbz_atom_transactions.res_verified, 
                    upper(tb_postpgapp.postpgapp_studname) as postpgapp_studname, 
                    tb_postpgapp.postpgapp_appid,
                    tb_postpgapp.postpgapp_rollno,
                    tb_postpgapp.postpgapp_community,
                    tb_postpgapp.postpgapp_dob,
                    tbz_postpgotherinfo.ph_status,
                    tb_postpgapp.postpg_indexmark,
                    tb_postpgapp.mphilrenotification,
                    tbz_postpgotherinfo.postpgjrf_option
                  FROM 
                    public.tb_admnscheme, 
                    public.tb_program, 
                    public.tbz_atom_transactions, 
                    public.tb_postpgapp,
                    public.tbz_postpgotherinfo,
                    public.tb_postpg_entrancexam 
                  WHERE 
                    tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
                    tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
                    tb_postpgapp.onlinepay_merchanttxnid = tbz_atom_transactions.merchanttxnid AND
                    tbz_postpgotherinfo.postpgapp_sl_ref=tb_postpgapp.postpgapp_sl AND
                    tbz_atom_transactions.res_verified='SUCCESS' AND
                    tb_postpg_entrancexam.ent_adscsl=tb_postpgapp.postpgapp_adsc_sl_ref AND                    

                 ( tbz_postpgotherinfo.postpgjrf_option=1 and   tb_postpgapp.postpgapp_adsc_sl_ref=?) 
                    

      
                 order by postpg_indexmark desc,postpgapp_dob asc,postpgapp_studname asc", [$id]);

     
          
              // dd($studlistjrf) ;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $postpgapp= DB::table('tb_postpgapp')
                ->select('tb_postpgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','tbz_atom_transactions.*','tbz_reservation_list.community')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_postpgapp.postpgapp_adsc_sl_ref')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_postpgapp.postpgapp_gender_sl')
                ->join('tbz_atom_transactions','tbz_atom_transactions.merchanttxnid','=','tb_postpgapp.onlinepay_merchanttxnid')
                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_postpgapp.postpgapp_caste_sl')
                ->where('postpgapp_adsc_sl_ref','=',$id)
                ->get();
      
             $postpgquali= DB::table('tb_postpgquali')
                ->select('*')
                ->where('postpgquali_postpgapp_appid','=',$id)
                ->get();
//        return $postpgquali;
            $postpgotherinfo= DB::table('tbz_postpgotherinfo')
                ->select('*')
                ->where('postpgotherinfo_appid','=',$id)
                ->get();
//        return $postpgotherinfo;
            $postpgphoto= DB::table('tb_postpgapp')
                ->select('postpgapp_photo')
                ->where('postpgapp_appid','=',$id)
                ->get();
            $pdf = PDF::loadView('ranklistpdf',compact('studlist','studlistjrf','adsc_admnyear','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('MphilPhDRanklist.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }  
    
    public function mphildownloadallotment() {
   //  return"hh";    
       $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS' and tb3.adsc_name like '%M.PHIL%'   group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
        // dd($count)   ;      
        return view('postpgviewranklist',compact('count'));
      
    }
    public function mphilselectionlistpdf ($id){
         
  // dd($id);
                $dobform='DD-MM-YYYY';
 $sc="SC";
 
 $st="ST";
 $ph=1;
 

      $studlist = DB::select("SELECT getcentrename(centid) as allot_cent,getpgm(rank_adscsl)as pgm,
                      getadmoptionspostpg(rank_appid) as options, *,asw_postpg_allotment.allotment FROM
  public.asw_postpg_allotment left join public.asw_postpg_adm on  asw_postpg_allotment.appid = asw_postpg_adm.adm_appid
  
   inner join  public.tbz_postpg_ranklist on  tbz_postpg_ranklist.rank_appid = asw_postpg_allotment.appid
  inner join  public.tb_admnscheme on  asw_postpg_allotment.pgmid = tb_admnscheme.adsc_sl
  inner join   public.tb_program on tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl
  inner join public.tb_department on tb_program.pgm_dept_sl = tb_department.dept_sl where rank_adscsl=? order by tbz_postpg_ranklist.rank " , [$id]);
     
     
          
             //  dd($studlist) ;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $postpgapp= DB::table('tb_postpgapp')
                ->select('tb_postpgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','tbz_atom_transactions.*','tbz_reservation_list.community')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_postpgapp.postpgapp_adsc_sl_ref')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_postpgapp.postpgapp_gender_sl')
                ->join('tbz_atom_transactions','tbz_atom_transactions.merchanttxnid','=','tb_postpgapp.onlinepay_merchanttxnid')
                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_postpgapp.postpgapp_caste_sl')
                ->where('postpgapp_adsc_sl_ref','=',$id)
                ->get();
      
             $postpgquali= DB::table('tb_postpgquali')
                ->select('*')
                ->where('postpgquali_postpgapp_appid','=',$id)
                ->get();
//        return $postpgquali;
            $postpgotherinfo= DB::table('tbz_postpgotherinfo')
                ->select('*')
                ->where('postpgotherinfo_appid','=',$id)
                ->get();
//        return $postpgotherinfo;
            $postpgphoto= DB::table('tb_postpgapp')
                ->select('postpgapp_photo')
                ->where('postpgapp_appid','=',$id)
                ->get();
            $pdf = PDF::loadView('mphilselectionlistpdf',compact('studlist','studlistjrf','adsc_admnyear','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('Mphilselectionlist.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }  
    
    public function phdselectionlistpdf ($id){
         
//   dd($id);
                $dobform='DD-MM-YYYY';
 $sc="SC";
 
 $st="ST";
 $ph=1;
 

//      $studlist = DB::select("SELECT getcentrename(centid) as allot_cent, * FROM
//  public.asw_postpg_allotment left join public.asw_postpg_adm on  asw_postpg_allotment.appid = asw_postpg_adm.adm_appid
//  
//   inner join  public.tbz_postpg_ranklist on  tbz_postpg_ranklist.rank_appid = asw_postpg_allotment.appid
//  inner join  public.tb_admnscheme on  asw_postpg_allotment.pgmid = tb_admnscheme.adsc_sl
//  inner join   public.tb_program on tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl
//  inner join public.tb_department on tb_program.pgm_dept_sl = tb_department.dept_sl where rank_adscsl=? order by tbz_postpg_ranklist.rank " , [$id]);
     
           $studlist = DB::select("SELECT 
  asw_postpg_allotment.appid, 
  asw_postpg_allotment.reserve, 
  asw_postpg_allotment.rank, 
  asw_postpg_allotment.allotment, 
  asw_postpg_allotment.appname, 
  asw_postpg_allotment.idxmark, 
  getcentrename(asw_postpg_allotment.centid) as allot_cent, 
  tb_postpgapp.postpgapp_community, 
  tb_program.pgm_name, 
  tb_admnscheme.adsc_admnyear,
  asw_postpg_allotment.pgmid
FROM 
  public.asw_postpg_allotment, 
  public.tb_postpgapp, 
  public.tb_admnscheme, 
  public.tb_program
WHERE 
  asw_postpg_allotment.appid = tb_postpgapp.postpgapp_appid AND
  tb_postpgapp.postpgapp_adsc_sl_ref = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl and asw_postpg_allotment.pgmid=? order by asw_postpg_allotment.rank " , [$id]);

          
//               dd($studlist) ;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            
      
            $pdf = PDF::loadView('phdselectionlistmalayalampdf',compact('studlist','studlistjrf','adsc_admnyear','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('PhDselectionlist.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }  
    
}
