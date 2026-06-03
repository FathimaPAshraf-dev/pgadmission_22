<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class AllotmentControllerPostpg extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }   
  public function mphilallotment(Request $request)
  {
       $appid=Auth::user()->postpgapp_appid;

        $category=DB::select('select *,allotment,UPPER (reserve) as allot_category,getcentrename(centid)as allot_cent FROM asw_postpg_allotment where appid=?',[$appid]);
 // $view=DB::connection('pgsql2')->select('select *,getcentrename(centid)as allot_cent,UPPER (reserve) as allot_category FROM asw_allotment_copy where appid=?',[$ids]);

             $results=DB::select('select * from tb_postpgapp where postpgapp_appid=?',[$appid]);
             
   if(count($category)<1){
  // return "no";
    return view('memo.mphiltryallotment',compact('results')) ;
   }
   else{
      //return "yes";
         return view('memo.mphilviewallotment',compact('view','results')) ;

   }
  }
     
    public function memodownload(Request $request){
        $appid=Auth::user()->postpgapp_appid;
        $category=DB::select('select *,allotment,UPPER (reserve) as allot_category,getcentrename(centid)as allot_cent FROM asw_postpg_allotment where appid=?',[$appid]);
        $postpgapp=DB::select('select *,getpgm(rank_adscsl) as pgm from tb_postpgapp tb1 left join tbz_postpg_ranklist tb2 on tb1.postpgapp_appid=tb2.rank_appid  left join tb_admnscheme tb3 on tb2.rank_adscsl=tb3.adsc_sl left join tb_program tb4 on tb3.adsc_pgm_sl=tb4.pgm_sl '
                . ' where tb1.postpgapp_appid=?', [$appid]);

        
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            
         $pdf = PDF::loadView('memo.memo_pdf',compact('postpgapp','category','curnt_date','time'));

        return $pdf->download('memo.pdf');

   }
  
    
    
     
}
