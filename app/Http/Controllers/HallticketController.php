<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class HallticketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pay_details = DB::table('tb_postpgapp')->select('tbz_atom_transactions.*')
                   ->join('tbz_atom_transactions','tb_postpgapp.onlinepay_merchanttxnid','tbz_atom_transactions.merchanttxnid')
                   
                   ->where('tb_postpgapp.postpgapp_serial',Auth::user()->postpgapp_serial)->get(); 
                foreach ($pay_details as $value) {
                    $res_verified=$value->res_verified;
                }
          
//                dd($pay_details);
              return view('hallticketview', compact('pay_details'));
    }
    
    public function pdf(Request $request){
    $appid=Auth::user()->pgapp_id;
        
   // dd($appid);
    //$status=1;
            $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
               //return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $pgapp= DB::select('SELECT 
                tb_pgapp.pgapp_id, 
                tb_pgapp.pgapp_name, 
                 tb_pg_entrancexam.*,
                tb_program.pgm_name,
                tb_centre.centre_name,
                tb_pgapp.pgapp_adsc_sl
              FROM 
                public.tb_admnscheme, 
                public.tb_pgapp, 
                public.tb_pg_entrancexam, 
                public.tb_program,
                 public.tb_centre
              WHERE 
                tb_admnscheme.adsc_sl = tb_pgapp.pgapp_adsc_sl AND
                tb_pgapp.pgapp_adsc_sl = tb_pg_entrancexam.ent_adscsl AND
                tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl and
                tb_centre.centre_sl = tb_pgapp.pgapp_exam_centre
                and tb_pgapp.pgapp_id=? ',[$appid]);
      //dd($pgapp);
         $pdf = PDF::loadView('hallticketpdf',compact('pgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time','list'));
         // dd($pdf );
        return $pdf->download('PgHallticket.pdf');

   }
   
   public function hallticket2022(Request $request){
    $appid=Auth::user()->pgapp_id;
        
//    dd($appid);
    //$status=1;
            $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
               //return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $pgapp= DB::select('SELECT 
                tb_pgapp.pgapp_id, 
                tb_pgapp.pgapp_name, 
                 tb_pg_entrancexam.*,
                tb_program.pgm_name,
                tb_centre.centre_name,
                tb_pgapp.pgapp_adsc_sl
              FROM 
                public.tb_admnscheme, 
                public.tb_pgapp, 
                public.tb_pg_entrancexam, 
                public.tb_program,
                 public.tb_centre
              WHERE 
                tb_admnscheme.adsc_sl = tb_pgapp.pgapp_adsc_sl AND
                tb_pgapp.pgapp_adsc_sl = tb_pg_entrancexam.ent_adscsl AND
                tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl and
                tb_centre.centre_sl = tb_pgapp.pgapp_exam_centre
                and tb_pgapp.pgapp_id=? ',[$appid]);
//            dd($pgapp);
            
             // newly added code for download status
         $sz= DB::select('SELECT settimezone();');
         $updateadm=DB::update("update tb_pgapp set ent_hallticket_downloaded_stat=ent_hallticket_downloaded_stat+1,ent_hallticket_downloaded_on=now() where pgapp_id=? ",[$appid]);

//      dd($pgapp);
//         $pdf = PDF::loadView('2022.hallticket',compact('pgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time','list'));
          $pdf = PDF::loadView('2022.hallticket',compact('pgapp','curnt_date','time'));
// dd($pdf );
         
        
        return $pdf->download('PgEntranceHallticket.pdf');

   }
  
    }   
    

