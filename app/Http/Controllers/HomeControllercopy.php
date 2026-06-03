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

      if($adscsl==906||$adscsl==907||$adscsl==909||$adscsl==916||$adscsl==917||$adscsl==918)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[23]);  //except REGIONAL CAMPUS, THRISSUR 
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
     
     $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(11,14,15,18,22,23,24,25,26,27,28,33,34,38,39,40)"); 
       $ugqualisubject=DB::select('select * from tb_degqualisub'); 
        
        
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
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y");
//        dd($datenow);
//       if($datenow>'27/04/2022'){
// return view('auth.registerclose'); 
//       }
//       else{
           return view('home1',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
                'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
             'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent'));
      
//       }
  
  //dd($amnt);
//     return view('home1',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
//                'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
//             'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent'));
      
 
        
       }
        
    }
   
    public function index()
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

       if($adscsl==906||$adscsl==907||$adscsl==909||$adscsl==916||$adscsl==917||$adscsl==918)  {
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl in(?)",[23]);  //except REGIONAL CAMPUS, THRISSUR 
      }
      else{
      $examcentre=DB::select("select centre_sl,centre_name from tb_centre where centre_sl not in(?)",[17]);  //except REGIONAL CAMPUS, THRISSUR  
       }
        
         $entireTableinc=DB::select('select * from tb_income');

//        $religion=DB::select("select relgn_sl,relgn_name from tb_religion  "); //original
        $state=DB::select("select state_sl,state_name from tb_state ");
        $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?,?)",
                ['NO RELIGION','OTHERS','ISLAM']); // for renotification

       
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
     
     $ugquali = DB::select("select *  from tb_degquali where degq_sl IN(11,14,15,18,22,23,24,25,26,27,28,33,34,38,39,40)"); 
       $ugqualisubject=DB::select('select * from tb_degqualisub'); 
        
        
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
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y");
    
//    if($datenow>'27/04/2022'){
//        return view('auth.registerclose'); 
//    }
//    else{
//
//     return view('home',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgsign','pgqualicount',
//                'entireTableinc','centre_options','state','pgoptions','pgpgm_flag','flags','pgpgm1','pgpgm2','pgpgm3',
//             'pgopt1','pgopt2','pgopt3','ugquali','ugqualisubject','pgquali_exam','pgquali_subject','examcentre','examcent'));
//  
//     
//    }
         return view('auth.registerclose'); 

       }
        
    }
 
    public function getoption()
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

            if(($count_centr)>=2)
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
//dd($data);
        $result=DB::select("select distinct(community) from tbz_reservation_list where religion=? and community in('SC','ST') ",[$data]);
//    return $result;
            $htmlcent = "<class=\"col-sm-8\" id=\"commdiv\" name=\"commdiv\">
            <select class=\"form-control form-control-sm select2 col-md-8\" id= \"pgapp_community\" name=\"pgapp_community\"onchange=\"commchange()\">
                                          <option value=\"\" >
                                        --Select--
                                   </option>";
          foreach ($result as $cntr) {
               $htmlcent .= "<option value=\"" . $cntr->community . "\" class=\"col-md-12\">" . $cntr->community . "</option>";
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
   
    // dd ($appid);
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
        $query1=DB::table('tb_pg_pgquali')->select('pgquali_pgapp_id')->where('pgquali_pgapp_id','=',$appid)->get();
//      dd($query1)
        if(count($query1)>0)
        {
            DB::update('update tb_pg_pgquali set pgquali_pgapp_id=?,pgquali_institute=?,pgquali_university=?,pgquali_subject=?,
                  pgquali_year=?,pgquali_grade=?,pgquali_exam=?,sslc_regno=?,sslc_mark=?,courseduration=?,regnodegree=?,
                  degree_aggregate=?,ugcourse_status=?,coursetype=?,pgquali_endyear=? where pgquali_pgapp_id=?',
                  [$appid,$pgquali_institute,$pgquali_university,$pgquali_subject,$pgquali_year,$pgquali_grade,$pgquali_exam,
                   $sslc_regno,$sslc_mark,$courseduration,$regnodegree,$degree_aggregate,$ugcourse_status,$coursetype,$pgquali_endyear,$appid]);  
        }
        else
        { 
            DB::insert('insert into tb_pg_pgquali (pgquali_pgapp_id,pgquali_institute,
            pgquali_university,pgquali_subject,pgquali_year,pgquali_grade,pgquali_exam,sslc_regno,sslc_mark,courseduration,
            regnodegree,degree_aggregate,ugcourse_status,coursetype,pgquali_endyear)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [$appid,$pgquali_institute,$pgquali_university,$pgquali_subject,$pgquali_year,$pgquali_grade,$pgquali_exam
                     ,$sslc_regno,$sslc_mark,$courseduration,$regnodegree,$degree_aggregate,$ugcourse_status,$coursetype,$pgquali_endyear]);
        }
       
        DB::update('update tb_pgapp set ugcourse_status=? where pgapp_id=?',[$ugcourse_status,$appid]);
        if($coursetype=='SEMESTER WISE'){
          $items = $this->getMarkList($appid, $ugcourse_status, $courseduration);
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
        
        $mark_year1= $request->yr_1;
        $mark_year2=$request->yr_2;
        $mark_year3=$request->yr_3;
        $mark_year4= $request->yr_4;
        
        $query1=DB::table('tb_pg_pgquali')->select('pgquali_pgapp_id')->where('pgquali_pgapp_id','=',$appid)->get();
      
        if(count($query1)>0)
        {
            DB::update('update tb_pg_pgquali set mark_sem1=?,mark_sem2=?,mark_sem3=?,mark_sem4=?,
                mark_sem5=?,mark_sem6=?,mark_sem7=?,mark_sem8=?,mark_year1=?,mark_year2=?,mark_year3=?,mark_year4=? where pgquali_pgapp_id=?',
              [$mark_sem1,$mark_sem2,$mark_sem3,$mark_sem4,$mark_sem5,$mark_sem6,$mark_sem7,$mark_sem8,$mark_year1,$mark_year2,$mark_year3,$mark_year4,$appid]);  
        }
        else
        { 
            DB::insert('insert into tb_pg_pgquali (mark_sem1,mark_sem2,
            mark_sem3,mark_sem4,mark_sem5,mark_sem6,mark_sem7,mark_sem8,mark_year1,mark_year2,mark_year3,mark_year4)values(?,?,?,?,?,?,?,?,?,?,?,?)',
            [$mark_sem1,$mark_sem2,$mark_sem3,$mark_sem4,$mark_sem5,$mark_sem6,$mark_sem7,$mark_sem8,$mark_year1,$mark_year2,$mark_year3,$mark_year4
                     ]);
        }
       
        return response()->json(["status"=>"Semester details Saved Successfully"]);      
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
 
        $sql = DB::table('tbz_pgotherinfo')->select('pgotherinfo_appid','pgapp_sl_ref')->where('pgotherinfo_appid',$appid)->get();  

        if($sql->isEmpty()){
            DB::insert('insert into tbz_pgotherinfo(pgapp_sl_ref,pgotherinfo_appid,ph_status,ph_type,
                pgapp_inc_sl,pgapp_wh_special_reserv,pgapp_nss,pgapp_ncc,pgapp_arts,pgapp_sports)
                values(?,?,?,?,?,?,?,?,?,?)',
        [$pgapp_sl,$appid,$ph_status,$ph_type,
            $pgapp_inc_sl,$pgapp_wh_special_reserv,$pgapp_nss,$pgapp_ncc,$pgapp_arts,$pgapp_sports]);
        
       
           
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
           $year=2022;
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

            $htmlcent = "<div class=\"\"  id=\"cdiv2\" id=\"cdiv2\">
                      <div class=\"form-group\"> 
                      <label class=\"control-label\">Study Campus II :</label>
            <select  id= \"center_sl2\" name=\"center_sl2\"  class=\"form-control form-control-sm select2 col-md-8\">
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
        $year=2022;
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
    
  public function store_options(Request $request){
   
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
    
   public function printoption(){
      
     $appid=Auth::user()->pgapp_id;  
     $adscl=Auth::user()->pgapp_adsc_sl;  
     $adscname = DB::select('select adsc_name,pgm_name from  tb_admnscheme 
          inner join tb_program on pgm_sl=adsc_pgm_sl where adsc_sl=? ' , [$adscl]);

     foreach($adscname as $key){
         $pgmname=$key->pgm_name;
     }
     
    

     $option = DB::select('select *,centre_name from  tb_pg_pgpgm left join tb_centre on pgpgm_centre_sl=centre_sl where pgpgm_pgapp_id=? order by tb_pg_pgpgm.pg_option' , [$appid]);
     
     $rank = DB::select("select rank from tbz_pgranklist
        where rank_appid=? order by rank",[$appid]);
//     dd($rank);
      $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
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
        date_default_timezone_set("Asia/Calcutta");
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
        if(Auth::user()->pg_edit_appl == 1 || $this->payment_status() == 0   ){
              return redirect('home');

        }
        $id=Auth::user()->pgapp_id;
  
        $adsc_sl=Auth::user()->pgapp_adsc_sl;
        $payment_success_count = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('ucity_service',"PG-ENTRANCE-FEE-2022")->where('res_verified',"SUCCESS")->count();
        $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->get();

//        foreach ($pay_details as $value) {
//            $res_verified=$value->res_verified;
//            $adsc_sl=$value->pgapp_adsc_sl;
//        }
       
         $court_judge=Auth::user()->court_judge;
 
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
               if($special_reserv_flag==1){
                $allotstat=5; 
              }
              if($allot=='FIRST'){
                $allotstat=1; 
              }
              else if($allot=='SECOND'){
                  $allotstat=2;
              }
              else if($allot=='THIRD' || $court_judge==1 || $allot=='THIRD_SPECIAL'|| $allot=='SC/ST RE-NOTIFICATION'){
                  $allotstat=3;
              }
              else if($allot=='SPECIAL ALLOTMENT'){
                  $allotstat=4;
                  $payf=1;
              }
              else if($allot=='Judgement in WP(C) No.21770 of 2022 dated,07.07.2022' || $allot=='Judgement in WP(C) No. 22770 of 2022 dated,13.07.2022'|| $allot=='SC/ST RE-NOTIFICATION-II'){
                  $allotstat=5;
                  $payf=1;
              }
              
          }

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
                 ->where('ucity_service',"PG-ADMISSION-FEE-2022")->where('res_verified',"SUCCESS")->get();
         
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
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y");
    
//        if($datenow>'27/04/2022'){
//            return view('auth.registerclose'); 
//        }
     return view('pgfinalview', compact('allotstatusres','allotstat',
             'pubstatus','pay_details','postpgadm','adsc_sl','pgoptions','pgpgm_flag',
             'flags','optionstat','payment_success_count','datenow','admstat','feestat'));

                
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
          // dd($appid);
            $declaration_status= $request->declaration_status;
    
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
        

          $pgoptions = DB::select('select tb2.centre_name,tb1.pg_option,tb1.pgpgm_adsc_sl,tb1.pg_entrance_centre from tb_pg_pgpgm tb1'
            . ' left join tb_centre tb2 on  tb1.pgpgm_centre_sl = tb2.centre_sl WHERE pgpgm_pgapp_id=?'
            . ' ORDER BY tb1.pg_option', [$appid]);

        return view('payment',compact('pgapp','community','caste','subcaste','pgquali','pgotherinfo','pgoptions','semester_grades','name'));

        
    }
    
    private function payment_success_status(){
        
           $id=Auth::user()->pgapp_id;
           $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->where('res_verified',"SUCCESS")->count();
           
//           $pay_details = DB::table('tb_pgapp')->select('tbz_atom_transactions.*','tb_pgapp.indexmark','tb_pgapp.pgapp_id')
//                   ->join('tbz_atom_transactions','tb_pgapp.pgapp_id','tbz_atom_transactions.client_code')  
//                    ->where('tbz_atom_transactions.res_verified',"SUCCESS")                
//                   ->where('tb_pgapp.pgapp_id',Auth::user()->pgapp_id)->first(); 

           return  $pay_details;      

    }
    
     private function payment_status(){
        
           $id=Auth::user()->pgapp_id;
           $pay_details = PaymentTrans::where('client_code',Auth::user()->pgapp_id)->count();
           
//           $pay_details = DB::table('tb_pgapp')->select('tbz_atom_transactions.*','tb_pgapp.indexmark','tb_pgapp.pgapp_id')
//                   ->join('tbz_atom_transactions','tb_pgapp.pgapp_id','tbz_atom_transactions.client_code')  
//                    ->where('tbz_atom_transactions.res_verified',"SUCCESS")                
//                   ->where('tb_pgapp.pgapp_id',Auth::user()->pgapp_id)->first(); 

           return  $pay_details;      

    }
    
    public function pgpayment(Request $request)
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
        date_default_timezone_set('Asia/Calcutta');
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        
        $datereg=Carbon::now();
        $pgapp_sl= Auth::user()->pgapp_sl;
        $pgapp_mobile= Auth::user()->pgapp_mobile;
        $pgapp_email= Auth::user()->pgapp_email;
        $pgapp_name= Auth::user()->pgapp_name;
        $transactionId = rand(100000,100000000).$pgapp_sl;
        $clentcode= Auth::user()->pgapp_id;
        $pgapp_stream_id= Auth::user()->pgapp_stream_id;
        $pgapp_community= Auth::user()->pgapp_community;

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
           if($pgapp_adsc_sl=="913")

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
           //Museology
            if($pgapp_adsc_sl=="910") //841

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

            $paymenttrans=new PaymentTrans;
            $paymenttrans->merchanttxnid=$transactionId;
            $paymenttrans->trans_amt=$amount;
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
    
    
    
    
    
    public function interviewmemo(){
      
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
      $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $timenow= date("H:i:s");

    if(empty($allotment)){
        return "You are not in the Allotment list";  
    }
    else{
        $pdf = PDF::loadView('2022.interviewmemo',compact('allotment','curnt_date','timenow','pgmname'));

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
            date_default_timezone_set("Asia/Calcutta");
            $timenow= date("H:i:s");

    if(empty($allotment)){
        return "You are not in the Allotment list";  
    }
    else{
        $pdf = PDF::loadView('2022.interviewmemotest',compact('allotment','curnt_date','timenow','pgmname'));

        return $pdf->download('InterviewMemo.pdf');
     
    }

    }  

}
