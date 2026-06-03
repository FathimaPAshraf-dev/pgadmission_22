<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PostpgEntranceExam;
use Session;
use App\Centre;
use App\Department;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class PostpgEntranceController extends Controller
{
    public function entrancepostpg() {
        
        $list =DB::table('tb_postpg_entrancexam')->get();
      
        return view('postpgentrance.postpgEntrance', compact('list'));
    }
    
    public function newEntrancePostpg(Request $request) {

//        $adsc = DB::connection('pgsql2')->select('SELECT 
//        tb_admnscheme.adsc_sl, 
//        tb_admnscheme.adsc_pgm_sl, 
//        tb_admnscheme.adsc_admnyear, 
//        tb_admnscheme.adsc_time, 
//        tb_program.pgm_name, 
//        tb_programtype.pgtype_name, 
//        tb_program.pgm_type, 
//        tb_admnscheme.adsc_name
//        FROM 
//        public.tb_admnscheme, 
//        public.tb_program, 
//        public.tb_programtype
//        WHERE 
//        tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
//        tb_program.pgm_type = tb_programtype.pgtype_sl and adsc_admnyear = 2020 and (pgm_type=13 or pgm_type=16 or pgm_type=15) order by pgm_name');
        
        $admission = DB::select("select adsc_sl,adsc_name from tb_admnscheme where extract(year from adsc_time)=? and extract(month from adsc_time)=?",[2020,10]);
        return view('postpgentrance.newEntrancePostpg', compact('admission'));
    }
    
    public function saveEntrancePostpg(Request $request) {
        $input =$request->all();
        $ent_exam_id = 0;
       $ent_exam_id = $request->input('ent_exam_id');
        $ent_exam_name = $request->input('ent_exam_name');
        $ent_adscsl = $request->input('ent_adscsl');
        $ent_exam_date = $request->input('ent_exam_date');
        $ent_exam_time = $request->input('ent_exam_time');
       
               
          try{ 
              DB::beginTransaction();
              
              if ($ent_exam_id <= 0) {

                PostpgEntranceExam::create($request->all());
            } else {


                $res = DB::update('update tb_postpg_entrancexam set ent_exam_name=?,'
                        . 'ent_exam_date=? ,' . ' ent_exam_time=? where ent_exam_id=? ', [$ent_exam_name, $ent_exam_date, $ent_exam_time, $ent_exam_id]);
            }
              
               
        
            DB::commit();
//            return 'Created successfully';
          
          }
          
          
           catch(Exception $e){
              DB::rollback();
              return "error";
             }
            
      

         return redirect()->action('PostpgEntranceController@entrancepostpg');

//        if ($res >= 1) {
//
//            return redirect()->action('EntranceController@manageEntrance');
//        }
    }
    
     public function updateentrancepostpg(Request $request) {

        $category = PostpgEntranceExam::findOrFail($request->ent_exam_id);

//      return $category;
        $category->update($request->all());
         return redirect()->action('PostpgEntranceController@entrancepostpg');

//        if ($res >= 1) {
//
//            return redirect()->action('EntranceController@manageEntrance');
//        }
    }
    
    public function editEntrancePostpg($id) {
       
        $viewdata = DB::select('select * from tb_postpg_entrancexam where ent_exam_id=? ', [$id]);
//        dd($viewdata);
        return view('postpgentrance.editpostpgentrance')->with('viewdata', $viewdata);
    }
     public function viewstatus(Request $request) {
         
        $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS'  group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
//          dd($count)   ;      
        return view('postpgentrance.viewpostpgcount',compact('count'));
      
    }
    public function viewApplicants($id) {
      
        $studlist = DB::select("SELECT 
                    tb_program.pgm_name, 
                    tb_admnscheme.adsc_name, 
                    tb_admnscheme.adsc_sl,
                    tbz_atom_transactions.res_verified, 
                    tb_postpgapp.postpgapp_studname, 
                    tb_postpgapp.postpgapp_appid,
                    tb_postpgapp.postpgapp_rollno
                  FROM 
                    public.tb_admnscheme, 
                    public.tb_program, 
                    public.tbz_atom_transactions, 
                    public.tb_postpgapp
                  WHERE 
                    tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
                    tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
                    tb_postpgapp.onlinepay_merchanttxnid = tbz_atom_transactions.merchanttxnid AND
                    tbz_atom_transactions.res_verified='SUCCESS' AND tb_postpgapp.postpgapp_adsc_sl_ref=? order by tb_postpgapp.postpgapp_rollno", [$id]);

        return view('postpgentrance.PostpgApplicants',compact('studlist'));
    }
    public function viewstatuspostpg(Request $request) {
         
        $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS'  group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
//          dd($count)   ;      
        return view('postpgentrance.pgentrance.countpostpg',compact('count'));
      
    }
    public function publishpostpg(Request $request) {
       // return "uu";
         
        $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS' and tb3.adsc_sl not in(799,805,806,807,808,809,810,811,804,813,812,800,801,802,803,814)  group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
//          dd($count)   ;      
        return view('postpgentrance.pgentrance.publishpostpg',compact('count'));
      
    }
    public function viewApplicantspostpg($id) {
      
        $studlist = DB::select("SELECT 
                    tb_program.pgm_name, 
                    tb_admnscheme.adsc_name, 
                    tb_admnscheme.adsc_sl,
                    tbz_atom_transactions.res_verified, 
                    tb_postpgapp.postpgapp_studname, 
                    tb_postpgapp.postpgapp_appid,
                    tb_postpgapp.postpgapp_rollno
                  FROM 
                    public.tb_admnscheme, 
                    public.tb_program, 
                    public.tbz_atom_transactions, 
                    public.tb_postpgapp
                  WHERE 
                    tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
                    tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
                    tb_postpgapp.onlinepay_merchanttxnid = tbz_atom_transactions.merchanttxnid AND
                    tbz_atom_transactions.res_verified='SUCCESS' AND tb_postpgapp.postpgapp_adsc_sl_ref=? order by tb_postpgapp.postpgapp_rollno", [$id]);

        return view('postpgentrance.pgentrance.viewapplicants',compact('studlist'));
    }
    public function rollEntrance($id) {

        $viewdata = DB::select('select * from tb_postpg_entrancexam where ent_exam_id=? ', [$id]);

        return view('postpgentrance.rollpostpgentrance')->with('viewdata', $viewdata);
    }

    public function generateRoll(Request $request) {

        $ent_exam_id = 0;
        $res = 0;
        $ent_exam_id = $request->input('ent_exam_id');
        $ent_adscsl = $request->input('ent_adscsl');
        $ent_exam_roll = $request->input('ent_exam_roll');
        $pgapp_rollno = $request->input('pgapp_rollno');

        $data = $request->all();
        
        $ent_exam_roll = $request->input('ent_exam_roll');
//         return( $ent_exam_roll);
        $rs = DB::select('select * from tb_postpg_entrancexam  where ent_exam_roll=?', [$ent_exam_roll]);
//         return($rs);
        
        if (count($rs) > 0) {
            Session::flash('message', 'Already Use this roll number !');
            return redirect()->back();
// return redirect()->back()->with('alert','Already added');
        } else {

            $result = DB::update('update tb_postpg_entrancexam
                  set ent_exam_roll=?  where ent_exam_id=?', [$ent_exam_roll, $ent_exam_id]);


            try {
                if ($ent_exam_id > 0) {

                    $res = DB::select('select postpgroll(?,?)', [$ent_adscsl, $ent_exam_roll]);
//                    dd($res);
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $message = $ex->getMessage();

                return view('postpgentrance.error_view')->with('message', $message);
            }



            if ($res >= 1) {

                return redirect()->action('PostpgEntranceController@entrancepostpg');
            }
        }
    }
    
    public function viewApplicantsdepartment() {
        

                 $active=1;    

                if($active==1)
                {
        if(Session::has('idSession')) 
          {
             $user_id=Session::get('idSession');   
          }
          else
          {
            $user_id=" ";
          }
          $userdetails=DB::select("select * from tb_user_report where id=?",[$user_id]);
          if(count($userdetails)>0)
          {
            foreach ($userdetails as $key) {
              $centre  =$key->centre;  
              $department=$key->department;
              $usertype=$key->user_type;

            }
              // Session::flash('message', 'Some error had occured do not proceed contact IT-Division'); 
          }
          
          else
          {
             Session::flash('message', 'Some error had occured do not proceed contact IT-Division'); 
          }
//dd($centre);
          $years = DB::select("select *,year_name+1 as year  from tb_year where year_name>2017 and year_name<2019 ");
          $scheme=DB::select("select * from tb_admnscheme order by  adsc_sl desc ");
          if($department!="")
          {
             //  $dept =Department::all()->where('dept_sl',$department);  
               $dept = Department::all()->where('dept_sl', $department);
                }
          else
          {
    
                $dept=DB::select('select dept_sl,dept_name from tb_department tb1 join tb_program tb2 on tb1.dept_sl=tb2.pgm_dept_sl 
                join tb_programcentre tb3 on tb2.pgm_sl=tb3.pgmcentre_pgm_sl

                group by dept_sl,dept_name 
                order by dept_name ');
          }
          
           if($centre !=23 )
           
          $centre_details = Centre::all()->where('centre_sl',$centre);
      else {
          $centre_details = Centre::all()->where('centre_sl',23);
      }

         // dd( $centre_details);
          return view('postpgentrance.exam.studentlist',compact('years','dept','centre_details','scheme'));
            }
                else
                {
                    $message='Entrance Nominal Report Closed....';
                    return view('pages.display_message',compact('message'));
                }


    }
    
      public function  loadapplicantslist(Request $request)
     {
                
                $data=$request->formdata;
                parse_str($data, $returndata);
//                dd($returndata);
                $course_type=$returndata['course_type'];
                $centre=$returndata['centre'];
                $dept=$returndata['section'];
                $semester=4;
                $month=4;
                $year=$returndata['year'];
                $jrf=$returndata['jrf'];
//                dd($course_type);
                $examsl=$returndata['exam'];
                $exampaper=$returndata['exampaper'];
                $qrystr=" ";$qrycent=" ";
                if($dept!=1000)
                $qrystr=" and dept_sl=".$dept;
                
                if($centre!=1000)
                $qrycent=" and pgapp_centre_sl=".$centre;
                
                if($course_type==4 || $course_type==6)
                     $typstr=" ,getregpgpapers(exstd_sl) as papers ";
                 else if($course_type==5)
                     $typstr=" ,getregugpapers(stud_registerno,exam_sl) as papers ";
            if($jrf==100){
                $list=DB::select("SELECT 
            tb_program.pgm_dept_sl, 
            tb_program.pgm_name, 
            tb_admnscheme.adsc_name, 
            tb_program.pgm_type, 
            tb_admnscheme.adsc_admnyear, 
            tb_postpgapp.postpgapp_appid, 
            tb_postpgapp.postpgapp_studname,
            tb_postpgapp.postpgapp_rollno,
            tb_postpgapp.postpgapp_mobile,
            tbz_postpgotherinfo.postpgjrf_option
            
          FROM 
            public.tb_department, 
            public.tb_program, 
            public.tb_admnscheme, 
            public.tb_postpgapp, 
            public.tbz_atom_transactions,
            public.tbz_postpgotherinfo 
          WHERE 
            tb_department.dept_sl = tb_program.pgm_dept_sl AND
            tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
          tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
            tbz_atom_transactions.merchanttxnid = tb_postpgapp.onlinepay_merchanttxnid and
           tb_postpgapp.postpgapp_sl=tbz_postpgotherinfo.postpgapp_sl_ref AND
           tb_program.pgm_type=?  AND 
           tb_program.pgm_dept_sl=? and tb_admnscheme.adsc_admnyear=? AND postpgjrf_option IN(1,2)

           and tbz_atom_transactions.res_verified='SUCCESS' order by postpgapp_rollno",[$course_type,$dept,$year]);

            } 
            else{
            $list=DB::select("SELECT 
            tb_program.pgm_dept_sl, 
            tb_program.pgm_name, 
            tb_admnscheme.adsc_name, 
            tb_program.pgm_type, 
            tb_admnscheme.adsc_admnyear, 
            tb_postpgapp.postpgapp_appid, 
            tb_postpgapp.postpgapp_studname,
            tb_postpgapp.postpgapp_rollno,
            tb_postpgapp.postpgapp_mobile,
            tbz_postpgotherinfo.postpgjrf_option
            
          FROM 
            public.tb_department, 
            public.tb_program, 
            public.tb_admnscheme, 
            public.tb_postpgapp, 
            public.tbz_atom_transactions,
            public.tbz_postpgotherinfo 
          WHERE 
            tb_department.dept_sl = tb_program.pgm_dept_sl AND
            tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
          tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
            tbz_atom_transactions.merchanttxnid = tb_postpgapp.onlinepay_merchanttxnid and
           tb_postpgapp.postpgapp_sl=tbz_postpgotherinfo.postpgapp_sl_ref AND
           tb_program.pgm_type=?  AND 
           tb_program.pgm_dept_sl=? and tb_admnscheme.adsc_admnyear=? AND postpgjrf_option=?

           and tbz_atom_transactions.res_verified='SUCCESS' order by postpgapp_rollno",[$course_type,$dept,$year,$jrf]);
            }
        return view('postpgentrance.exam.loadstudentlist',compact('list'));
             
        }

    public function getpdf($id){
//    dd($id);
     $studlist = DB::select("SELECT 
                   
                    tb_postpgapp.*
                  FROM 
                    public.tb_admnscheme, 
                    public.tb_program, 
                    public.tbz_atom_transactions, 
                    public.tb_postpgapp
                  WHERE 
                    tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
                    tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
                    tb_postpgapp.onlinepay_merchanttxnid = tbz_atom_transactions.merchanttxnid AND
                    tbz_atom_transactions.res_verified='SUCCESS' AND tb_postpgapp.postpgapp_appid=?", [$id]);
//dd($studlist);
         
          
//                return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $postpgapp= DB::table('tb_postpgapp')
                ->select('tb_postpgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','tbz_atom_transactions.*','tbz_reservation_list.subcaste')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_postpgapp.postpgapp_adsc_sl_ref')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_postpgapp.postpgapp_gender_sl')
                ->join('tbz_atom_transactions','tbz_atom_transactions.merchanttxnid','=','tb_postpgapp.onlinepay_merchanttxnid')
                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_postpgapp.postpgapp_caste_sl')
                ->where('postpgapp_appid','=',$id)
                ->get();
//        dd(Auth::user()->subcaste_table);
            $religion= DB::table('tb_religion')
                ->select('relgn_sl','relgn_name')
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
            $pdf = PDF::loadView('postpgentrance.pgentrance.pdf',compact('postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('PostPgApplication.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }       
      
    public function getallpdf($id){
//    dd($id);
     $studlist = DB::select("SELECT 
                    tb_program.pgm_name, 
                    tb_admnscheme.adsc_name, 
                    tb_admnscheme.adsc_sl,
                    tbz_atom_transactions.res_verified, 
                    tb_postpgapp.postpgapp_studname, 
                    tb_postpgapp.postpgapp_appid,
                    tb_postpgapp.postpgapp_rollno
                  FROM 
                    public.tb_admnscheme, 
                    public.tb_program, 
                    public.tbz_atom_transactions, 
                    public.tb_postpgapp
                  WHERE 
                    tb_admnscheme.adsc_sl = tb_postpgapp.postpgapp_adsc_sl_ref AND
                    tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl AND
                    tb_postpgapp.onlinepay_merchanttxnid = tbz_atom_transactions.merchanttxnid AND
                    tbz_atom_transactions.res_verified='SUCCESS' AND tb_postpgapp.postpgapp_adsc_sl_ref=? order by tb_postpgapp.postpgapp_rollno", [$id]);

          
//                return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $postpgapp= DB::table('tb_postpgapp')
                ->select('tb_postpgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','tbz_atom_transactions.*','tbz_reservation_list.subcaste')
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
            $pdf = PDF::loadView('postpgentrance.pgentrance.allpdf',compact('studlist','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('PostPgApplication.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
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
            $pdf = PDF::loadView('postpgentrance.pgentrance.viewranklist',compact('studlist','studlistjrf','adsc_admnyear','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo','postpgphoto','curnt_date','time'));

        return $pdf->download('MphilphdRanklist.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }  
    
  // ranklist 
      public function rank_phd(Request $request) {
         
        $count = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS' and tb3.adsc_name like '%PH.D%'   group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
//          dd($count)   ;      
        return view('viewranklistphd',compact('count'));
      
    }
   
    public function phdranklistview($id){
//    dd($id);
                $dobform='DD-MM-YYYY';
 $sc="SC";
 
 $st="ST";
 $ph=1;
// $nolist = DB::select("SELECT adsc_name from tb_admnscheme where adsc_sl=?",[$id]);
  
 $nolist = DB::select("SELECT adsc_name,pgm_name,adsc_admnyear from tb_admnscheme inner join tb_program on tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl
          where adsc_sl=?",[$id]);
    
// dd($nolist);
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
                    

      
                 order by postpgapp_dob asc,postpgapp_studname asc", [$id]);

     
     $list_teacher = DB::select("SELECT 
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

                 ( tbz_postpgotherinfo.teach_status='teacher' and   tb_postpgapp.postpgapp_adsc_sl_ref=?) 
                    

      
                 order by postpgapp_dob asc,postpgapp_studname asc", [$id]);
      
          
//               dd($studlistjrf) ;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
          
      return  view('phdranklistview',compact('studlist','studlistjrf','list_teacher','adsc_admnyear','curnt_date','time','nolist'));

//      
    }  
     public function phdranklistpdf($id){
//    dd($id);
                $dobform='DD-MM-YYYY';
 $sc="SC";
 
 $st="ST";
 $ph=1;
//  $nolist = DB::select("SELECT adsc_name from tb_admnscheme where adsc_sl=?",[$id]);

  $nolist = DB::select("SELECT  	adsc_sl,adsc_name,pgm_name,adsc_admnyear from tb_admnscheme inner join tb_program on tb_program.pgm_sl = tb_admnscheme.adsc_pgm_sl
          where adsc_sl=?",[$id]);
   foreach($nolist as $key){
     $adsc_sl=$key->adsc_sl;  
   }
 if($adsc_sl==814){
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
      
                 order by postpg_indexmark desc,postpgapp_dob asc,postpgapp_studname asc", [$id,2]);
 }
 else{
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
    
 } 
// dd($studlist);
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
                    

      
                 order by postpgapp_dob asc,postpgapp_studname asc", [$id]);
//dd($studlistjrf);
     
     $list_teacher = DB::select("SELECT 
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

                 ( tbz_postpgotherinfo.teach_status='teacher' and   tb_postpgapp.postpgapp_adsc_sl_ref=?) 
                    

      
                 order by postpgapp_dob asc,postpgapp_studname asc", [$id]);
      
//               dd($list_teacher) ;
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
            $pdf = PDF::loadView('phdranklistpdf',compact('studlist','studlistjrf','list_teacher','adsc_admnyear','postpgapp','religion','community','caste','subcaste','postpgquali','postpgotherinfo',
                    'postpgphoto','curnt_date','time','nolist'));

        return $pdf->download('PhDRanklist.pdf');
  
   
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }  
    
     
}
