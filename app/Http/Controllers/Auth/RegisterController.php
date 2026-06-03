<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\Register;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
     
    public function getexiststudata(Request $request)
    {
       
        $result =$request->regno;


        $result= trim($result," ");
        //return $result;

         $result = DB::select("select *  from tb_pgapp where sslc_regno=? ",[$result]);

       if(count($result)>2)

       {

         return 0;  
       }

        else {

          return 1;

        }
    }
    
    
    
public function forsubject(Request $request)
{
   $pgstream_name= $request->input('formData');
    if($pgstream_name=="1") //MA
    {
              
// $result = DB::select("select *  from tb_admnscheme where adsc_sl IN (752,749,756,755,758,750,757,747,744,748,760,751,761,746,745,742,743,815)");
        $result = DB::connection('pgsql2')->select("SELECT 
          tb_admnscheme.adsc_sl, 
          tb_admnscheme.adsc_admnyear, 
          tb_admnscheme.adsc_name, 
          tb_program.pgm_sl, 
          tb_program.pgm_name, 
          tb_admnscheme.adsc_pgm_sl
        FROM 
          public.tb_admnscheme, 
          public.tb_program
        WHERE 
          tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2026' and adsc_name not like '%DIP%' and  adsc_name not like '%SPORTS%' 
          and adsc_name not like '%MSC%' and adsc_name not like '%MITIGATION%' and adsc_name not like '%MFA%' and adsc_name not like'%B.A.%' and adsc_name not like '%SOCIAL WORK%' ");
          
   //year 2023 (969,970,971,972,973,974,975,976,977,978,979,980,981,982,983,984,985,986,987,988)     
//YEAR 2020//  (752,749,756,755,758,750,757,747,744,748,760,751,761,746,745,742,743,815)             // 2021 = 820,821,823,824,825,826,827,828,829,830,831,832,834,835,836,837,838,840,842,841
        //year 2022 //908,909,910,911,914,915,916,918,919,920,921,922,923,925,926,927,928,929
        
    }        
    
    if($pgstream_name=="2") // MSW
    {

        // $result = DB::select("select *  from tb_admnscheme where adsc_sl IN(762)");
         
        $result =DB::connection('pgsql2')->select("SELECT 
          tb_admnscheme.adsc_sl, 
          tb_admnscheme.adsc_admnyear, 
          tb_admnscheme.adsc_name, 
          tb_program.pgm_sl, 
          tb_program.pgm_name, 
          tb_admnscheme.adsc_pgm_sl
        FROM 
          public.tb_admnscheme, 
          public.tb_program
        WHERE 
          tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2026' and  (adsc_name  like '%SOCIAL WORK%' or  adsc_name   like '%DISASTER%' ) ");
           //819,905
    }

                        
    if($pgstream_name=="3") // M.PES
    {

        $result = DB::connection('pgsql2')->select("SELECT 
          tb_admnscheme.adsc_sl, 
          tb_admnscheme.adsc_admnyear, 
          tb_admnscheme.adsc_name, 
          tb_program.pgm_sl, 
          tb_program.pgm_name, 
          tb_admnscheme.adsc_pgm_sl
        FROM 
          public.tb_admnscheme, 
          public.tb_program
        WHERE 
          tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2026' and  adsc_name  like '%SPORTS%' ");
     //907
    }
   
        
    if($pgstream_name=="6") //MFA
    {
//        $result = DB::select("select *  from tb_admnscheme where adsc_sl IN (763)");
              // $result = DB::select("select *  from tb_program where pgm_sl IN(202)");
        $result = DB::connection('pgsql2')->select("SELECT 
          tb_admnscheme.adsc_sl, 
          tb_admnscheme.adsc_admnyear, 
          tb_admnscheme.adsc_name, 
          tb_program.pgm_sl, 
          tb_program.pgm_name, 
          tb_admnscheme.adsc_pgm_sl
        FROM 
          public.tb_admnscheme, 
          public.tb_program
        WHERE 
          tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2026' and  adsc_name  like '%MFA%' and  adsc_name  like '%VISUAL%' ");
       //846,906
    }
    
    if($pgstream_name=="8") // MSC
    {
              
      //  $result = DB::select("select *  from tb_admnscheme where adsc_sl IN(753,754)");
             //  $result = DB::select("select *  from tb_program where pgm_sl IN(201,200)");
        $result = DB::connection('pgsql2')->select("SELECT 
          tb_admnscheme.adsc_sl, 
          tb_admnscheme.adsc_admnyear, 
          tb_admnscheme.adsc_name, 
          tb_program.pgm_sl, 
          tb_program.pgm_name, 
          tb_admnscheme.adsc_pgm_sl
        FROM 
          public.tb_admnscheme, 
          public.tb_program
        WHERE 
          tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2026' and (adsc_name like '%MSC%' and  adsc_name not like '%DISASTER%') ");
        //    (989,990)   753,754   833,822    ,904  
    }
    
    if($pgstream_name=="9")
    {
        $result = DB::connection('pgsql2')->select("SELECT 
            tb_admnscheme.adsc_sl, 
            tb_admnscheme.adsc_admnyear, 
            tb_admnscheme.adsc_name, 
            tb_program.pgm_sl, 
            tb_program.pgm_name, 
            tb_admnscheme.adsc_pgm_sl
          FROM 
            public.tb_admnscheme, 
            public.tb_program
          WHERE 
        tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl
    AND tb_admnscheme.adsc_admnyear = '2026'
    AND adsc_name LIKE '%P.G.DIPLOMA%'
     ");
//            tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2025' and  adsc_name  like '%P.G.DIP%' ");
        
 // tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2024' and  adsc_name  like '%COMPUTATIONAL%' ");
        // 993,994      844,845
    }
    
    if($pgstream_name=="12")
    {
        $result = DB::connection('pgsql2')->select("SELECT 
            tb_admnscheme.adsc_sl, 
            tb_admnscheme.adsc_admnyear, 
            tb_admnscheme.adsc_name, 
            tb_program.pgm_sl, 
            tb_program.pgm_name, 
            tb_admnscheme.adsc_pgm_sl
          FROM 
            public.tb_admnscheme, 
            public.tb_program
          WHERE 
            tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2026' and  adsc_name  like '%DMM%'");

        //844,845
    }
    if($pgstream_name=="13")
    {
        $result = DB::connection('pgsql2')->select("SELECT 
            tb_admnscheme.adsc_sl, 
            tb_admnscheme.adsc_admnyear, 
            tb_admnscheme.adsc_name, 
            tb_program.pgm_sl, 
            tb_program.pgm_name, 
            tb_admnscheme.adsc_pgm_sl
          FROM 
            public.tb_admnscheme, 
            public.tb_program
          WHERE 
            tb_admnscheme.adsc_pgm_sl = tb_program.pgm_sl  and  tb_admnscheme.adsc_admnyear='2025' ");

        // 997,996      844,845
    }

 $htmlcent = "<class=\"col-sm-5\" id=\"divsub\" name=\"divsub\">
  <select  id= \"pgapp_adsc_sl\" name=\"pgapp_adsc_sl\"onchange=\"pgapp_pgm()\" class=\"form-control form-control-sm select2\">
                                       <option value=\"\" >
                                     --Select--
                                </option>";
       foreach ($result as $cntr) {
            $htmlcent .= "<option value=\"" . $cntr->adsc_sl . "\" class=\"col-md-12\">" . $cntr->pgm_name . "</option>";
        }
       $htmlcent .= "</select></div>";
       
      //  dd($html);
         return $htmlcent;


}
    
    protected function validator(array $data)
    {
     // dd($data);
        return Validator::make($data, [
           
            'pgapp_name' => ['required', 'string', 'max:255'],
            'pgapp_dob' => ['required'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'pgapp_gender_sl' => ['required'],
            'sslc_regno' => ['required'],
            'pgapp_adsc_sl' => ['required'],
            'pgapp_adhar' => ['required', 'string', 'min:12','max:12'],
            'pgapp_mobile' => ['required','min:10','max:10'],
//            'pgapp_email' => ['required', 'string', 'email', 'max:255','unique:tb_pgapp'],
            'pgapp_email' => ['required', 'string', 'email', 'max:255'],
            'pgapp_adhar1'=> ['required', 'string', 'min:12','max:12'],
            'pgapp_mobile1'=> ['required','min:10','max:10'],
            'pgapp_stream_id' => ['required'],

        ],
                [   'pgapp_name.required'=>'Please enter your name',
                    'pgapp_stream_id.required'=>'Please select Stream',
                   ' pgapp_adsc_sl.required'=>'Please enter your Program',
                    ' pgapp_stream_id.required'=>'Please enter your Stream',
                    'pgapp_dob.required'=>'Please enter your date of birth',
                    'password.required'=>'Please enter your password',
                    'pgapp_gender_sl.required'=>'Please select your gender',
                    'sslc_regno.required'=>'Please enter your sslc register no',
                    'pgapp_adsc_sl.required'=>'Please select stream in which you are applied for',
                    'pgapp_adhar.required'=>'Please enter your aadhaar number',
                    'pgapp_mobile.required'=>'Please enter your mobile number',
                    'password.confirmed'=>'password confirmation does not match',
                    'pgapp_adhar.min'=>'Aadhaar Number must be 12 digits',
                    'pgapp_adhar.max'=>'Aadhaar Number must be 12 digits',
                    
                    
                    'pgapp_adhar1.min'=>'Aadhaar Number must be 12 digits',
                    'pgapp_adhar1.max'=>'Aadhaar Number must be 12 digits',
                 
                    'pgapp_mobile.max'=>'Please enter valid mobile number,must be 10 digits',
                    'pgapp_mobile.min'=>'Please enter valid mobile number,must be 10 digits',
                    'pgapp_email.required'=>'Please enter your email id',
                    'pgapp_email.unique'=>'This email id is already exists',
                    'pgapp_email.email'=>'Please enter a valid email id',
                    'pgapp_mobile1.max'=>'Please enter valid mobile number,must be 10 digits',
                    'pgapp_mobile1.min'=>'Please enter valid mobile number,must be 10 digits',
                    'password.min'=>'Minimum 8 characters required',
                    
                ]
                
        );
    }

    
   
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */ 
    protected function create(array $data)
    {
       $pgapp_dob=Carbon::parse($data['pgapp_dob']);
      
       DB::beginTransaction();
       try{
            $user= User::create([
           // 'pgapp_id'=> $pgapp_idgen,
            'pgapp_name' => strtoupper($data['pgapp_name']),
            'pgapp_dob' => $pgapp_dob,
             'pgapp_password' =>$data['password'],
             'password' => Hash::make($data['password']),
             'pgapp_stream_id' => $data['pgapp_stream_id'],
            'pgapp_gender_sl' => $data['pgapp_gender_sl'],
            'sslc_regno' => $data['sslc_regno'],
                
            'pgapp_adsc_sl' => $data['pgapp_adsc_sl'],
            'pgapp_adhar' => $data['pgapp_adhar'],
            'pgapp_mobile' => $data['pgapp_mobile'],
            'pgapp_email' => $data['pgapp_email'],
            'series_id' => 5, 
            'pgapp_abcid' =>  $data['pgapp_abcid'],  
            'academic_year' =>  $data['academic_year'], 
        ]);
        
          
       $mobile=DB::SELECT("SELECT  * from tb_pgapp where pgapp_adsc_sl=? and pgapp_adhar=?",[$user->pgapp_adsc_sl,$user->pgapp_adhar]   ) ;     
          // $mobno="9447534928";
        //dd ($mobile); 
         foreach($mobile as $key){
            $pgapp_id=$key->pgapp_id;
            $pgapp_password=$key->pgapp_password;
        } 

        // return("errorr");
            $mes="PG ADMISSION ".date("Y")."  Application ID is: {$pgapp_id}  and Password : {$pgapp_password} ";
            //
            //  $url="http://godspeed.liveair.co.in/httpapi/httpapi?token=ab7ed290de591baf67a6bc0860311a1f&sender=SSUSKA&number=".$user->pgapp_mobile;
            //                 $url=$url."&route=2&type=1&sms=".$mes; 
            //              $client = new \GuzzleHttp\Client();
            //              $response = $client->request('GET', $url);     
          
        Mail::to($user->pgapp_email)->send(new Register($user));
        DB::commit();
        return $user;
               
       }
       catch (Exception $ex) {
           DB::rollback();
           return $ex;
       } 
            

    }
//     public function showRegistrationForm()
//     {
    
// //        $admission = DB::select("select adsc_sl,adsc_name from tb_admnscheme where adsc_sl in(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[752,749,756,755,758,750,757,747,753,754,744,763,748,760,751,761,762,746,745,742,743,759,765,815]);

// //       $admission= DB::connection('pgsql2')->select("select adsc_sl,adsc_name from tb_admnscheme where adsc_sl in(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[752,749,756,755,758,750,757,747,753,754,744,763,748,760,751,761,762,746,745,742,743,759,765,815]);
//         $dt_now = Carbon::now();
// $trn_date = $dt_now->toDateString();

// date_default_timezone_set('Asia/Calcutta');

// // Convert to Carbon date
// $datenow = Carbon::now()->format("d/m/Y");

// // Convert both dates to DateTime for comparison
// $compare_date = Carbon::createFromFormat("d/m/Y", '17/08/2025');
// $current_date = Carbon::createFromFormat("d/m/Y", $datenow);

// if ($current_date->greaterThan($compare_date)) {
//     return view('auth.registerclose'); 
// } else {
//     return view('auth.register', compact('datenow'));
// }

        
// //        return view('auth.register',compact('datenow'));
//     }

public function showRegistrationForm()
    {
    
   
     $current_year = Carbon::now()->format('Y');
     $admyear=$current_year;
     $admission = DB::select("select adsc_sl,adsc_name from tb_admnscheme inner join tb_program on adsc_pgm_sl= pgm_sl 
           inner join tb_programtype on pgm_type=pgtype_sl where adsc_admnyear=? and pgm_type in(4,6)",[$admyear]);
      
     
        //    $academicYear = '2024-2025';
        $academicYear = DB::table('academic_years')
                  ->where('enabled', true) // Use 'enabled' instead of 'enable'
                  ->value('academic_year');


            $today = Carbon::now();

    
    $registration = DB::table('application_dates')
        ->where('status', 0) // Only fetch main registration dates (status = 0)
        ->first(['opening_date', 'closing_date']); // Fetch both opening and closing dates


    // If no record exists, assume registration is closed
    if (!$registration) {
        return view('auth.registerclose'); // Show registration closed message
    }

    // Convert dates to Carbon instances
    $openingDate = Carbon::parse($registration->opening_date);
    $closingDate = Carbon::parse($registration->closing_date);

    

    // Check if registration has not yet started
    if ($today->lt($openingDate)) {
       // dd($openingDate,$closingDate,$today);
        return view('auth.registerclose')->with('message', 'Registration has not started yet.'); // Show not started message
    }

    // Check if registration has ended
    if ($today->gt($closingDate)) {
        return view('auth.registerclose')->with('message', 'Registration is closed.'); // Show closed message
    }

    return view('auth.register', compact('admission', 'academicYear'));
     
     
     
    }

}
