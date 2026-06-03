<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class ViewAllotmentControllerPostpg extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
    
    
    
  public function viewallotment(Request $request)
  {
            $ids =Auth::user()->pgapp_id;
         //   return $ids;
            
       return view('pgallotment') ;      
            
            
    
  }   
        public function changeoption(Request $request)
  {
           $ids =Auth::user()->pgapp_id;
          // return $ids;
           
           
                   $centre_options_mal =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('16','22')");
//                    $centre_options_hind =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('16','21')");
//                     $centre_options_philo =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('15')");
//                      $centre_options_ved =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('15')");
//                       $centre_options_gen =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('20')");
//                        $centre_options_sah =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('16','21')");
//                         $centre_options_vya =DB::SELECT("SELECT * from  tb_centre where centre_sl  in('19')");
                   // dd($centre_options);
              $view=DB::select('select*,getpgm(pgapp_adsc_sl) as adscsl FROM tb_pgapp where pgapp_id=?',[$ids]);
$pgpgm_count=0;
         $pgpgm_new=DB::select('select *  FROM tb_pg_pgpgm_newoptions  where pgpgm_pgapp_id=?',[$ids]); 
         
         $pg_opt1="";
         $pg_opt2="";
           if(count($pgpgm_new)>0) 
           {
               $pgpgm_count=1;
               
                 $pgpgm_new1=DB::select('select *  FROM tb_pg_pgpgm_newoptions  where pgpgm_pgapp_id=? AND pg_option=1',[$ids]);  
                      $pgpgm_new2=DB::select('select *  FROM tb_pg_pgpgm_newoptions  where pgpgm_pgapp_id=? AND pg_option=2',[$ids]);  

           
                      
                      
                      foreach ($pgpgm_new1 as $key)
                      {
                          $pg_opt1=$key->pgpgm_centre_sl;
                      }
                      
                        foreach ($pgpgm_new2 as $key)
                      {
                          $pg_opt2=$key->pgpgm_centre_sl;
                      }
                      
           }
              
           //dd($view);
            return view('addoptions',compact('view','centre_options_mal','centre_options_hind','centre_options_philo','centre_options_ved','centre_options_gen','centre_options_sah','centre_options_vya','pgpgm_count','pgpgm_new','pg_opt1','pg_opt2')) ;
           
  }
  
        public function changeexamcentre(Request $request)
  {
           $ids =Auth::user()->pgapp_id;
           //return $ids;
                   $centre_options =DB::SELECT("SELECT * from  tb_centre where centre_sl not in('17')");
                   // dd($centre_options);
              $view=DB::select('select* FROM tb_pgapp where pgapp_id=?',[$ids]);

           //dd($view);
            return view('updateexamcentre ',compact('view','centre_options')) ;
           
  }
  
          public function loadallotment(Request $request)
  {
           $ids =Auth::user()->pgapp_id;
          //  return $ids;
           
            
           //  $view=DB::select('select *,getcentrename(centid)as allot_cent,UPPER (reserve) as allot_category,allotment FROM asw_postpg_allotment where appid=?',[$ids]);
   $view=DB::select('select *,getcentrename(centid)as allot_cent,UPPER (reserve) as allot_category,allotment FROM asw_allotment_first where appid=?',[$ids]);

//dd($view);
             $results=DB::select('select * from tb_pgapp where pgapp_id=?',[$ids]);
       //    dd($results);
             
   if(count($view)<1){
  // return "no";
  return view('tryallotment',compact('results')) ;
}
else{
   // return "yes";
       return view('viewallotmentpg',compact('view','results')) ;
    
}

  }
  
   public function saveoptions(Request $request){
        $appid=Auth::user()->pgapp_id;
        $view =DB::select('select * from tb_pgapp where pgapp_id=?',[$appid]);
        //dd($view);
        foreach ($view as $key)
        {
         $adscsl=$key->pgapp_adsc_sl ;  
        }
       // dd($adscsl);
       
       // return $appid;
        $status=1;
        date_default_timezone_set("Asia/Calcutta");
        $time= date("H:i:s"); 
       // dd($time);
        $timestamp=Carbon::now();
//       dd($timestamp[2]);
//       
        //  $ent_exam_name = $request->input('ent_exam_name');
        
        if($adscsl==820 ||  $adscsl==821  || $adscsl==830)
        {
        $centre1 = $request->input('center_slexam');
        
        $centre2 = $request->input('center_slexam2');
     
         $view =DB::select('select * from tb_pg_pgpgm_newoptions where pgpgm_pgapp_id=?',[$appid]);
        if(count($view)>0)
        {
        
        $opt1=1;
         $opt2=2;
       $results1 =DB::update('update tb_pg_pgpgm_newoptions
                  set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?', [$centre1,$opt1,$appid]); 
             $results2 =DB::update('update tb_pg_pgpgm_newoptions
                  set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?', [$centre2,$opt2,$appid]); 
        
        }
        else {
            
            $opt1=1;
         $opt2=2;
         
         $result1=DB::insert('insert into tb_pg_pgpgm_newoptions(pgpgm_pgapp_id,pgpgm_adsc_sl,pg_option,pgpgm_centre_sl) values(?,?,?,?)', [$appid,$adscsl,$opt1,$centre1]);  
           
         $result2=DB::insert('insert into tb_pg_pgpgm_newoptions(pgpgm_pgapp_id,pgpgm_adsc_sl,pg_option,pgpgm_centre_sl) values(?,?,?,?)', [$appid,$adscsl,$opt2,$centre2]);  
           
               
            
            
            
        }
            
        }
        else
        {
            
             $centre1 = $request->input('center_slexam');
        
                      $view =DB::select('select * from tb_pg_pgpgm_newoptions where pgpgm_pgapp_id=?',[$appid]);
                      
        if(count($view)>0)
        {
        
        $opt1=1;
         
       $results1 =DB::update('update tb_pg_pgpgm_newoptions
                  set pgpgm_centre_sl=? where pg_option=? and pgpgm_pgapp_id=?', [$centre1,$opt1,$appid]); 
              
        
        }
        else {
            
            $opt1=1;
            
            
            
           // $timestamp="2021-04-13 12:34:11.851114";
         
         $result1=DB::insert('insert into tb_pg_pgpgm_newoptions(pgpgm_pgapp_id,pgpgm_adsc_sl,pg_option,pgpgm_centre_sl) values(?,?,?,?)', [$appid,$adscsl,$opt1,$centre1]);  
           
       
           
               
            
            
            
        }               
                      
                      
                      
                      

        }
        
        
        
       // tb_pg_pgpgm_newoptions?:

   
//        $result = DB::connection('pgsql3')->update('update tb_pgapp
//                  set pgapp_exam_centre=?  where pgapp_id=?', [$centre,$appid]);
      //  return "yes";
            return redirect()->action('HomeController@pay_details');
       // dd($centre);
// //return $ent_exam_id;
//  $ent_exam_name = $request->input('ent_exam_name');
//  $ent_exam_date = $request->input('ent_exam_date');
   }
   public function updatecentre(Request $request){
        $appid=Auth::user()->pgapp_id;
        //return $appid;
        $status=1;
        date_default_timezone_set("Asia/Calcutta");
        $time= date("H:i:s"); 
        $timestamp=Carbon::now();
       //dd($timestamp);
        //  $ent_exam_name = $request->input('ent_exam_name');
        $centre = $request->input('center_slexam');
        $results =DB::update('update tb_pgapp
                  set pgapp_exam_centre=?,centre_status=1,time=?  where pgapp_id=?', [$centre,$timestamp,$appid]);
//        $result = DB::connection('pgsql3')->update('update tb_pgapp
//                  set pgapp_exam_centre=?  where pgapp_id=?', [$centre,$appid]);
      //  return "yes";
            return redirect()->action('HomeController@pay_details');
       // dd($centre);
// //return $ent_exam_id;
//  $ent_exam_name = $request->input('ent_exam_name');
//  $ent_exam_date = $request->input('ent_exam_date');
   }
   public function uploadcertificates(Request $request){
        $appid=Auth::user()->pgapp_id;
    // return $appid;
     $results=DB::select('select * from tb_pgapp where pgapp_id=?',[$appid]);
    // dd($results);
      return view('uploadcertificates',compact('results')) ;
   }
  
    public function downloadmemo(Request $request){
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
    public function mphildownloadallotment() {
    // return"hh";    
       $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS' and tb3.adsc_name like '%M.PHIL%'   group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
        // dd($count)   ;      
        return view('postpgviewranklist',compact('count'));
      
    } 
   
   
   
   
   
    
     
}
