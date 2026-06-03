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


    public function index()
    {
       if((!empty(Auth::user()->onlinepay_merchanttxnid))&&(Auth::user()->pg_edit_appl==0)) {
           return redirect('pay_details');

       }
       else{
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
        }
       // return $adscsl;
        $result_cent =DB::SELECT("SELECT tb_centre.centre_sl,tb_centre.centre_name 
FROM 
  public.tb_admncentre, 
  public.tb_admnscheme, 
  public.tb_centre, 
  public.tb_program
WHERE 
  tb_admncentre.adcen_adsc_sl = tb_admnscheme.adsc_sl AND
  tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl AND
  tb_centre.centre_sl = tb_admncentre.adcen_centre_sl  AND  tb_admnscheme.adsc_sl=?  AND tb_admnscheme.adsc_admnyear='2020'",[$adscsl]);
        
    // dd($result_cent);
        
        //return $adsc_sl;
//        dd(Auth::user()->subcaste_table); 
//        $religion= DB::table('tb_religion')
//                ->select('relgn_sl','relgn_name')
//                ->get();
         $entireTableinc=DB::select('select * from tb_income');

        $religion=DB::select("select relgn_sl,relgn_name from tb_religion ");
        
      
          //  $religion=DB::select("select relgn_sl,relgn_name from tb_religion where relgn_name not in(?,?)",['NO RELIGION','OTHERS']);
    
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
//        return $pgotherinfo;
        $pgphoto= DB::table('tb_pgapp')
                ->select('pgapp_photo')
                ->where('pgapp_id','=',$appid)
                ->get();
        return view('home',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','pgqualicount','entireTableinc','result_cent'));
       
     //   return view('regclosed'); 
        
       }
        
    }
    
     public function editpostpg()
    {
         $appid=Auth::user()->pgapp_id;
         $data=User::where('pgapp_id',$appid)
                      
                      ->update([
                        
                         'postpg_edit_appl'=>1,
                         
            ]);
         return redirect()->route('home');
        
    }

    public function religion(Request $request)
    { 
    
        $data = $request->input('formData');

        $result=DB::select("select distinct(community) from tbz_reservation_list where religion=? ",[$data]);
//    return $result;
            $htmlcent = "<class=\"col-sm-8\" id=\"commdiv\" name=\"commdiv\">
            <select class=\"form-control select2 col-md-8\" id= \"pgapp_community\" name=\"pgapp_community\"onchange=\"commchange()\">
                                          <option value=\"\" >
                                        --Select--
                                   </option>";
          foreach ($result as $cntr) {
               $htmlcent .= "<option value=\"" . $cntr->community . "\" class=\"col-md-12\">" . $cntr->community . "</option>";
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
                        <select class=\"form-control select2 col-md-8\"  id= \"pgapp_caste_sl\" name=\"pgapp_caste_sl\" >
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
        
        return "Personal Information saved successfully";
    }
   
     public function store_quali(Request $request){
               
         $appid=Auth::user()->pgapp_id;
        // dd($appid);
        $query=DB::table('tb_pgapp')->select('pgapp_sl')->where('pgapp_id','=',$appid)->get();
        //dd($query);
        foreach($query as $key){
            $pgapp_sl=$key->pgapp_sl;
        }

        $pgquali_exam= $request->pgquali_exam;
        $pgquali_institute= $request->pgquali_institute;
        
        $pgquali_university= $request->pgquali_university;
        $pgquali_subject= $request->pgquali_subject;
        $pgquali_year= $request->pgquali_year;
        $pgquali_grade=$request->pgquali_grade;
        
        DB::insert('insert into tb_pg_pgquali (pgquali_pgapp_id,pgquali_exam,pgquali_institute,
        pgquali_university,pgquali_subject,pgquali_year,pgquali_grade)values(?,?,?,?,?,?,?)',
        [$appid,$pgquali_exam,$pgquali_institute,$pgquali_university,$pgquali_subject,$pgquali_year,$pgquali_grade]);
        
        $sel=DB::table('tb_pg_pgquali')->select('*')->where('pgquali_pgapp_id','=',$appid)->get();
        $htmlcent = "
                      <div class=\"col-sm-12 table-responsive\">
                      <table id=\"tb_student\" class=\"table table-bordered table-hover\">
                                <thead>
                                <th>Exam</th>
                                <th>College/Institute</th>
                                <th>University</th>
                                <th>Main/Core Subjects</th>
                                <th>Year</th>
                                <th>Grade & Grade Point/Percentage of marks</th>   
                                <th>Action</th>
                            </thead>
                ";
       foreach ($sel as $key) {
            $htmlcent .= "<tr><td>".$key->pgquali_exam."</td>
            <td>".$key->pgquali_institute."</td>
            <td>".$key->pgquali_university."</td>
            <td>".$key->pgquali_subject."</td>
            <td>".$key->pgquali_year."</td>
            <td>".$key->pgquali_grade."</td>
                <td><button class=\"btn btn-success\" data-pgquali_sl=".$key->pgquali_sl." data-pgquali_exam=".$key->pgquali_exam." 
                                             data-pgquali_institute=".$key->pgquali_institute." data-pgquali_university=".$key->pgquali_university." 
                                      data-pgquali_subject=".$key->pgquali_subject." data-pgquali_year=".$key->pgquali_year." 
                                     data-pgquali_grade=".$key->pgquali_grade."  data-toggle=\"modal\" data-target=\"#edit\">Edit<span class=\"fa fa-edit\"></span></button>
                                                  
            </tr>";
            
        }
       $htmlcent .= "</table></div>";
       
//         dd($html);
         return $htmlcent;
         
    }
    
    
    
    
    
    
    
    
    
    
    public function update_quali(Request $request)
    {
//        return $request->all();
        $appid=Auth::user()->pgapp_id;
        $id=$request->pgquali_serial;
        $pgquali_exam= $request->pgquali_exam;
        $pgquali_institute= $request->pgquali_institute;
        
        $pgquali_university= $request->pgquali_university;
        $pgquali_subject= $request->pgquali_subject;
        $pgquali_year= $request->pgquali_year;
        $pgquali_grade=$request->pgquali_grade;
        
        DB::update('update tb_pg_pgquali set pgquali_exam=?,pgquali_institute=?,pgquali_university=?,
        pgquali_subject=?,pgquali_year=?,pgquali_grade=? where   pgquali_pgapp_id=?',
        [$pgquali_exam,$pgquali_institute,$pgquali_university,$pgquali_subject,$pgquali_year,$pgquali_grade,$appid]);
        
//        $fieldproject = PostpgQuali::findOrFail($request->pgquali_serial);
//        $fieldproject->update($request->all());
        $sel=DB::table('tb_pg_pgquali')->select('*')->where('pgquali_pgapp_id','=',$appid)->get();
        $htmlcent = "
                      <div class=\"col-sm-12 table-responsive\">
                      <table id=\"tb_student\" class=\"table table-bordered table-hover\">
                                <thead>
                                <th>Exam</th>
                                <th>College/Institute</th>
                                <th>University</th>
                                <th>Main/Core Subjects</th>
                                <th>Year</th>
                                <th>Grade & Grade Point/Percentage of marks</th>
                                 <th>Action</th>
                            </thead>
                ";
       foreach ($sel as $key) {
            $htmlcent .= "<tr><td>".$key->pgquali_exam."</td>
            <td>".$key->pgquali_institute."</td>
            <td>".$key->pgquali_university."</td>
            <td>".$key->pgquali_subject."</td>
            <td>".$key->pgquali_year."</td>
            <td>".$key->pgquali_grade."</td>
             <td><button class=\"btn btn-success\"  data-pgquali_exam=".$key->pgquali_exam." 
                                             data-pgquali_institute=".$key->pgquali_institute." data-pgquali_university=".$key->pgquali_university." 
                                      data-pgquali_subject=".$key->pgquali_subject." data-pgquali_year=".$key->pgquali_year." 
                                     data-pgquali_grade=".$key->pgquali_grade."  data-toggle=\"modal\" data-target=\"#edit\">Edit<span class=\"fa fa-edit\"></span></button>
                                                  
            </tr>";
            
        }
       $htmlcent .= "</table></div>";
       
//         dd($html);
         return $htmlcent;
     
    }
    
    public function store_resultawaiting(Request $request){
//        return 'store_resultawaiting';    
        $appid=Auth::user()->pgapp_id;
      // dd($appid);
        $ugcourse_status= $request->ugcourse_status;

       DB::update('update tb_pgapp set ugcourse_status=? where pgapp_id=?',
        [$ugcourse_status,$appid]);
          return "Educational Qualifications Saved Successfully";      
    }
    public function store_otherinfo(Request $request){
        
       // return "hhh";
        $appid=Auth::user()->pgapp_id;
       // dd($appid);
        $query=DB::table('tb_pgapp')->select('pgapp_sl')->where('pgapp_id','=',$appid)->get();
        //dd($query);
        foreach($query as $key){
            $pgapp_sl=$key->pgapp_sl;
            //return $pgapp_sl;
        }
        $ph_status=$request->ph_status;
       // return $ph_status;
        $ph_type=$request->ph_type;
        //dd($ph_type);

        
       $pgapp_inc_sl= $request->pgapp_inc_sl;
       $pgapp_wh_special_reserv= $request->pgapp_wh_special_reserv;
        $pgapp_nss= $request->pgapp_nss;
         $pgapp_ncc= $request->pgapp_ncc;
          $pgapp_arts= $request->pgapp_arts;
           $pgapp_sports= $request->pgapp_sports;
       //dd($pgapp_inc_sl);
        $sql = DB::table('tbz_pgotherinfo')->select('pgotherinfo_appid','pgapp_sl_ref')->where('pgotherinfo_appid',$appid)->get();  
//       
//        $sql=DB::select('select * from tbz_pgotherinfo where pgotherinfo_appid=?',[$appid]); 
        // dd($sql);
        
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
        
        return "Other Informations Saved Successfully";
    }
   
   
    public function store_image(Request $request){
       $validation = Validator::make($request->all(), 
         [
             'pgapp_photo' => 'required|mimes:jpg,jpeg,png|max:50|min:20',
             ],
         [   
            'pgapp_photo.required'  => 'Please select your photo',
            'pgapp_photo.mimes'     => 'The selected photo must be jpg,jpeg or png',
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
       public function centopt1(Request $request)
     {
           $appid=Auth::user()->pgapp_id; 
           $year=2020;
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
            <select  id= \"center_sl2\" name=\"center_sl2 \" onchange=\"centropt2()\" class=\"form-control select2 col-sm-8\">
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
                $year=2020;
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
                <select  id= \"center_sl3\" name=\"center_sl3 \" class=\"form-control select2 col-sm-8\" >
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
    $aa=$request->all();
    dd($aa);
     //  return "yes";
        $appid=Auth::user()->pgapp_id;
       // dd($appid);
        $query=DB::table('tb_pgapp')->select('pgapp_sl')->where('pgapp_id','=',$appid)->get();
        //dd($query);
        foreach($query as $key){
            $pgapp_sl=$key->pgapp_sl;
            //return $pgapp_sl;
        }
        $ph_status=$request->ph_status;
       // return $ph_status;
        $ph_type=$request->ph_type;
        //dd($ph_type);

        $postpgemployment_teach_exp= $request->postpgemployment_teach_exp;
       $pgapp_inc_sl= $request->pgapp_inc_sl;
       //dd($pgapp_inc_sl);
        

        return "Options Saved Successfully";
    }
    


    
    public function postpg_pdf(Request $request){
        
        $appid=Auth::user()->pgapp_id;
        date_default_timezone_set("Asia/Calcutta");
        $time= date("H:i:s");  
        $pgapp=DB::table('tb_pgapp')->select('*')->where('pgquali_pgapp_id','=',$appid)->get();

        $pgquali=DB::table('tb_pg_pgquali')->select('*')->where('pgapp_id','=',$appid)->get();
        $pgotherinfo=DB::table('tbz_pgotherinfo')->select('*')->where('pgotherinfo_appid','=',$appid)->get();

        
        $pdf = PDF::loadView('pdf', compact('pgapp','pgquali','pgotherinfo'));
	return $pdf->download('pgapplication.pdf');
    
        
    }
    

    public function pay_details()
    {
        $id=Auth::user()->pgapp_id;
        $adsc_sl=Auth::user()->pgapp_adsc_sl;
        $pay_details = DB::table('tb_pgapp')->select('tbz_atom_transactions.*','tb_pgapp.*','tb_pgapp.pgapp_id','tb_pgapp.*')
                   ->join('tbz_atom_transactions','tb_pgapp.onlinepay_merchanttxnid','tbz_atom_transactions.merchanttxnid')
                   
                   ->where('tb_pgapp.pgapp_sl',Auth::user()->pgapp_sl)->get(); 
                foreach ($pay_details as $value) {
                    $res_verified=$value->res_verified;
//                    $adsc_sl=$value->pgapp_adsc_sl;
                }
          
         $postpgadm=DB::select("select * from asw_postpg_adm where adm_appid=?",[$id]);   

//           return count($postpgadm)  ;   
                
//                if($adsc_sl==814)
//                {
              //      return view('finalpostpg', compact('pay_details'));
//                }
//                else{    
                    
                return view('hallticketview', compact('pay_details','postpgadm','adsc_sl'));
                
//                }
                
                
    }
    
   public function paymentstatus(Request $request) {
        
       
        $merchanttxnid=$request->merchanttxnid;
        $tdate=$request->input('tdate');
//        dd($tdate);
        
//     $xml = simplexml_load_string(file_get_contents('https://paynetzuat.atomtech.in/paynetz/vfts?merchantid=197&merchanttxnid=123123456&amt=50.00&tdate=2020-10-04'));
//dd((string)$xml['MerchantTxnID']);
     $xml=simplexml_load_file("https://payment.atomtech.in/paynetz/vfts?merchantid=71480&merchanttxnid=".$merchanttxnid."&amt=150.00&tdate=".$tdate."");
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
    
    
    
    
    
    
  
     
    
     public function getpreview()
    {
//         if(!empty(Auth::user()->pgapp_photo)){
            $appid=Auth::user()->pgapp_id;
          //  dd($appid);
        $query=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
             //  return $query1;
  foreach($query as $key){
            $pgapp_sl=$key->pgapp_sl;
           // return $pgapp_sl;
        }
        
        
        
        
     
       
               
               
               
               
               
               
               
        $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
//                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
        
       // dd($pgapp);
//        dd(Auth::user()->subcaste_table);
        $religion= DB::table('tb_religion')
                ->select('relgn_sl','relgn_name')
                ->get();
        
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
//        return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
//        return $pgotherinfo;
        $pgphoto= DB::table('tb_pgapp')
                ->select('pgapp_photo')
                ->where('pgapp_id','=',$appid)
                ->get();
        return view('payment',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto'));
//         }
//         else{
//             return 0;
//         }

//       return view('preview');
        
    }
    
     public function getpreviewold()
    {
//         if(!empty(Auth::user()->pgapp_photo)){
            $appid=Auth::user()->pgapp_id;
            dd($appid);
        $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
             //   return $query1;

        $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
//                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
//        dd(Auth::user()->subcaste_table);
        $religion= DB::table('tb_religion')
                ->select('relgn_sl','relgn_name')
                ->get();
        
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
//        return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
//        return $pgotherinfo;
        $pgphoto= DB::table('tb_pgapp')
                ->select('pgapp_photo')
                ->where('pgapp_id','=',$appid)
                ->get();
        return view('payment',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto'));
//         }
//         else{
//             return 0;
//         }

//       return view('preview');
        
    }
   public function postpgpayment()
    {
         
      // return "yes";
                                if(Auth::user()->onlinepay_status==0){
                                  //  return "yes0";
                                $dt_now = Carbon::now();
                                $trn_date= $dt_now->toDateString();
        
                                date_default_timezone_set('Asia/Calcutta');
                                $datenow = date("d/m/Y h:m:s");
                                $transactionDate = str_replace(" ", "%20", $datenow);
//dd($transactionDate);
                                $datereg=Carbon::now();;
                                $pgapp_sl= Auth::user()->pgapp_sl;
                               // dd($pgapp_sl);
                                $pgapp_mobile= Auth::user()->pgapp_mobile;
                                //dd($pgapp_mobile);
                                $pgapp_email= Auth::user()->pgapp_email;
                               // dd($pgapp_email);
                                $pgapp_name= Auth::user()->pgapp_name;
                               // dd($pgapp_name);
                                $transactionId = rand(100000,100000000).$pgapp_sl;
                                    
//                                    dd($transactionId);
                                    $clentcode= Auth::user()->pgapp_id;
                                    //dd($clentcode);
//                                    require_once 'TransactionRequest.php';

                                      $paymenttrans=new PaymentTrans;
                                     $paymenttrans->merchanttxnid=$transactionId;
                                     $paymenttrans->trans_amt=150;
                                    $paymenttrans->tdate=$trn_date;
                                    $paymenttrans->client_code=$clentcode;
                                    $paymenttrans->res_udf9_clientcode=$pgapp_sl;
                                    $paymenttrans->ucity_service='PG-ENTRANCE-FEE-'.date('Y');
                                    $paymenttrans->trans_timestamp=Carbon::now();
                                    $paymenttranssave = $paymenttrans->save();
                                    
                                      $datapostpg=User::where('pgapp_sl',$pgapp_sl)                     
                                        ->update([
                                           'onlinepay_merchanttxnid'=>$transactionId,
                                            'onlinepay_amount'=>150,
                                            'onlinepay_tdate'=>$datereg
                                          ]);
                                    
                                    
                                    $transactionRequest = new TransactionRequest();

//                                    //Setting all values here
                                     $transactionRequest->setMode("test");
                                     $transactionRequest->setLogin(197);
                                     $transactionRequest->setPassword("Test@123");
                                     $transactionRequest->setProductId("NSE");
                                     $transactionRequest->setAmount(50);
                                     $transactionRequest->setTransactionCurrency("INR");
                                     $transactionRequest->setTransactionAmount(50);
                                     $transactionRequest->setReturnUrl("http://14.139.185.106:97/home/postpgfeeresponse");
                                     $transactionRequest->setClientCode(123);
                                     $transactionRequest->setTransactionId($transactionId);
                                     $transactionRequest->setTransactionDate($transactionDate);
                                     $transactionRequest->setCustomerName("Test Name");
                                     $transactionRequest->setCustomerEmailId('vishnupriya@ssus.ac.in');
                                     $transactionRequest->setCustomerMobile(9447534928);
//                                     $transactionRequest->setCustomerBillingAddress("Kerala");
                                     $transactionRequest->setAppId($pgapp_sl);
                                     $transactionRequest->setCustomerAccount("639827");
                                     $transactionRequest->setReqHashKey("KEY123657234");


//                                     $transactionRequest->setMode("live");
//                                    $transactionRequest->setLogin(71480);
//                                    $transactionRequest->setPassword("SREE@123");
//                                    $transactionRequest->setProductId("UNIVERSITY");
//                                    $transactionRequest->setAmount(150);//$total
//                                    $transactionRequest->setTransactionCurrency("INR");
//                                    $transactionRequest->setTransactionAmount(150);//$total
//                                    $transactionRequest->setReturnUrl("http://14.139.185.106:97/home/postpgfeeresponse");
//                                    $transactionRequest->setClientCode($clentcode);
//                                    $transactionRequest->setTransactionId($transactionId);
//                                    $transactionRequest->setTransactionDate($transactionDate);
//                                    $transactionRequest->setCustomerName($pgapp_studname);//$name_stud
//                                    $transactionRequest->setCustomerEmailId($pgapp_email);//$email
//                                    $transactionRequest->setCustomerMobile($pgapp_mobile);//$mob_no
//                                    // $transactionRequest->setCustomerBillingAddress("Kerala");
//                                    $transactionRequest->setAppId($pgapp_sl);
//                                    $transactionRequest->setCustomerAccount("639827");
//                                    $transactionRequest->setReqHashKey("e0a176300774097599");


                                    $url = $transactionRequest->getPGUrl();
                                     return Redirect::to($url);   
                                }
                                elseif(Auth::user()->onlinepay_status==1){
                                   // return "yes1";
                                    
                                    $appid=Auth::user()->pgapp_id;
                                    $data=User::where('pgapp_id',$appid)

                                                 ->update([

                                                    'pg_edit_appl'=>0,

                                       ]);
                                    Session::flash('message', "Successfully edited!!!");
                                    Session::flash('alert-class', 'alert-warning');   
                                    return redirect()->route('pay_details');
                                }
                                else{
                                  //  return "wrong";
                                    return "Something went wrong";
                                }
        
    }  
   public function postpgfeeresponse(Request $request){
     //  return "yes";
//dd(Auth::user());
        $transactionResponse = new TransactionResponse();
        //for test
       $transactionResponse->setRespHashKey("KEYRESP123657234");
   //for live    
//$transactionResponse->setRespHashKey("ef929d2be4c79a7b99");

//        dd($_POST);
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

$datastudexam=User::where('pgapp_sl',$udf9)
                      
                      ->update([
                        
                         'onlinepay_status'=>1,
                         
                        ]);
      $datapay=PaymentTrans::where('merchanttxnid',$mer_txn)
                      
                      ->update([
                       'res_bankname' => $bank_name,
                         'res_bid'=>$bank_txn,
                        
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
           Session::flash('alert-class', 'alert-warning');   
           return redirect()->route('pay_details');
    }
      else if($f_code == 'F'){

       $datastudexam=User::where('pgapp_sl',$udf9)
                      
                      ->update([
                        
                         'onlinepay_status'=>0,
                         
                        ]);
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
//        dd($mer_txn);
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
         $merchanttxnid=$request->merchanttxnid;
        $tdate=$request->input('tdate');
//        dd(Auth::user()->onlinepay_status);
        
//     $xml = simplexml_load_string(file_get_contents('https://paynetzuat.atomtech.in/paynetz/vfts?merchantid=197&merchanttxnid=123123456&amt=50.00&tdate=2020-10-04'));
//dd((string)$xml['MerchantTxnID']);
     $xml=simplexml_load_file("https://payment.atomtech.in/paynetz/vfts?merchantid=71480&merchanttxnid=".$merchanttxnid."&amt=150.00&tdate=".$tdate."");
//     dd($xml);
     if ($xml === false) {
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
              echo "<br>", $error->message;
            }
        } 
        
     else if(Auth::user()->onlinepay_status==1){
         
            $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
//                return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','tbz_atom_transactions.*')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
                ->join('tbz_atom_transactions','tbz_atom_transactions.merchanttxnid','=','tb_pgapp.onlinepay_merchanttxnid')
//                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
//        dd($pgapp);
            $religion= DB::table('tb_religion')
                ->select('relgn_sl','relgn_name')
                ->get();
        
             $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
//        return $pgquali;
            $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
//        return $pgotherinfo;
            $pgphoto= DB::table('tb_pgapp')
                ->select('pgapp_photo')
                ->where('pgapp_id','=',$appid)
                ->get();
            $pdf = PDF::loadView('pdf',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','curnt_date','time'));

        return $pdf->download('PostPgApplication.pdf');
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
      
    
    
        $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
//                return $query1;
$dt_now = Carbon::now();
    $curnt_dat= $dt_now->toDateString();
    $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
    date_default_timezone_set("Asia/Calcutta");
    $time= date("H:i:s");
        $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','tbz_atom_transactions.*')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
                ->join('tbz_atom_transactions','tbz_atom_transactions.merchanttxnid','=','tb_pgapp.onlinepay_merchanttxnid')
//                 ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
//        dd(Auth::user()->subcaste_table);
        $religion= DB::table('tb_religion')
                ->select('relgn_sl','relgn_name')
                ->get();
        
        $pgquali= DB::table('tb_pg_pgquali')
                ->select('*')
                ->where('pgquali_pgapp_id','=',$appid)
                ->get();
//        return $pgquali;
        $pgotherinfo= DB::table('tbz_pgotherinfo')
                ->select('*')
                ->where('pgotherinfo_appid','=',$appid)
                ->get();
//        return $pgotherinfo;
        $pgphoto= DB::table('tb_pgapp')
                ->select('pgapp_photo')
                ->where('pgapp_id','=',$appid)
                ->get();
         $pdf = PDF::loadView('pdf',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto','curnt_date','time'));

        return $pdf->download('PostPgApplication.pdf');
//    return view('pdf',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto'));
}
else {
    return "Something Went wrong Try again";
}
   
   }
    //     dd($xmlvalues);
//         return view('paymentstatus', compact('xmlvalues','merchanttxnid','tdate'));
    }   
     

}
