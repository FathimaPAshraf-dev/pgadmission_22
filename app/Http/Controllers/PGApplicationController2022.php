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
use PDF;

class PGApplicationController2022 extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }


      protected function guard()
    {
        return Auth::guard();
    }

 
    public function getoption()
    {
        $appid=Auth::user()->pgapp_id;
        
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
         return view('2022.optionpage',compact('rank'));
        }
    }

 
    public function centopt1(Request $request)
     {
           $appid=Auth::user()->pgapp_id; 
           $year=2021;
           //dd($appid);
            $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
          //dd($pgappall);
               foreach ($pgappall as $key)
                {
                    $pgmsl=$key->pgapp_adsc_sl;
                }
            $cent_opt = $request->input('cent1');
           // return $cent_opt;   
            $centrop=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre,
           public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl
           AND tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
           AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? AND (tb_centre.centre_sl NOT IN($cent_opt))",[$pgmsl,$year ]);
     
             //dd( $centrop) ;
            if(count($centrop)>0)
            {

            $htmlcent = "<class=\"col-sm-4\" id=\"cdiv2\" name=\"cdiv2\">
            <select  id= \"center_sl2\" name=\"center_sl2\" onchange=\"centropt2()\" class=\"form-control select2 col-sm-8\">
            <option value=\"\" >
            ------Select Centre II-----
            </option>";
            foreach ($centrop as $cntr) 
            {
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
                $year=2021;
                $cent_opt = $request->input('cent1');
                $cent_opt2 = $request->input('cent2');
                $appid=Auth::user()->pgapp_id; 
                //  dd($appid);
                $pgappall=DB::select("select * from tb_pgapp where pgapp_id=?",[$appid]);
                foreach ($pgappall as $key)
                {
                $pgmsl=$key->pgapp_adsc_sl;
                }
                $centrop2=DB::select("SELECT tb_centre.centre_name,tb_centre.centre_sl FROM public.tb_admncentre, 
                public.tb_admnscheme, public.tb_centre, public.tb_program WHERE tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl 
                AND adsc_pgm_sl = tb_program.pgm_sl AND tb_centre.centre_sl = tb_admncentre.adcen_centre_sl 
                AND  tb_admnscheme.adsc_sl =? AND  tb_admnscheme.adsc_admnyear=? 
                AND (tb_centre.centre_sl NOT IN($cent_opt2,$cent_opt))",[$pgmsl,$year ]);      
    
                if(count($centrop2)>0)
                {
                $htmlcent2 = "<class=\"col-sm-4\" id=\"cdiv3\" name=\"cdiv3\">
                <select  id= \"center_sl3\" name=\"center_sl3\" class=\"form-control select2 col-sm-8\" >
                <option value=\"\" >
                ------Select Centre III-----
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
     
    public function store_options(Request $request){
   
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
    
    
    
    public function getpdf(Request $request){
    
    $appid=Auth::user()->pgapp_id;


        
    if($this->payment_success_status()){
         
            $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
//                return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
//                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
            foreach ($pgapp as $value) {
                $ugcourse_status=$value->ugcourse_status;
            }
            $payment_success= PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('res_verified',"SUCCESS")->first();

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

//           return view('applnprintout',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto',
//                    'pgsign','curnt_date','time','pgoptions','semester_grades','payment_success'));

            $pdf = PDF::loadView('applnprintout',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto',
                    'pgsign','curnt_date','time','pgoptions','semester_grades','payment_success','name'));

        return $pdf->download('PgApplication.pdf');
     }
     else{
         return "Something went wrong";
     }

    }   

}
