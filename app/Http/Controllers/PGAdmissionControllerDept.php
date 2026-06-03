<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
//use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use App\PaymentTrans;
use PaymentGateway\Atom\Facades\Atompay;
use App\Gateway\TransactionRequest;
use App\Gateway\TransactionResponse;
use Redirect;


class PGAdmissionControllerDept extends Controller
{
    
    public function admfeereceipt2022dept($id)
    {
//        dd($id);
        $details =DB::SELECT("SELECT getcentrename(asw_pgadm.adm_centid)as centre,*,getpgm(adm_pgmid) as pgm,getcentrecode(transferred_centre) as transferred_centre,
            getcentrecode(asw_pgadm.adm_centid) as centcode,tb_pgapp.* FROM  public.asw_pgadm
        inner join tb_pgapp on tb_pgapp.pgapp_id = asw_pgadm.adm_appid where adm_appid=?",[$id]);
//dd($details);
        $feestructure = DB::select('SELECT * from asw_pgadm_feestucture where appid=?',[$id]);
        $admfee = DB::connection('pgsql2')->select('SELECT distinct * from tbz_atom_transactions where client_code=? and ucity_service=?'
                 . 'and res_verified=?',[$id,'PG-ADMISSION-FEE-2022','SUCCESS']);
        $flag=0;
        if(count($admfee)>1){
            $flag=1;
        }
        $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $timenow= date("H:i:s");

        $pdf = PDF::loadView('2022.pgfeerecipt2022',compact('details','curnt_date','timenow','feestructure','admfee','flag'));

        return $pdf->download('PGAdmissionFeeReceipt.pdf');
     
    }
    
    
    public function pgpdf2022($appid){
    
    if($this->payment_success_status($appid)){
         
            $query1=DB::table('tb_pgapp')->select('*')->where('pgapp_id','=',$appid)->get();
//                return $query1;
            $dt_now = Carbon::now();
            $curnt_dat= $dt_now->toDateString();
            $curnt_date= date("d-m-Y", strtotime($curnt_dat) );
            date_default_timezone_set("Asia/Calcutta");
            $time= date("H:i:s");
            $pgapp= DB::table('tb_pgapp')
                ->select('tb_pgapp.*','tb_admnscheme.adsc_name','tb_gender.gender_name','subcaste')
                ->join('tb_admnscheme','tb_admnscheme.adsc_sl','=','tb_pgapp.pgapp_adsc_sl')
                ->join('tb_gender','tb_gender.gender_sl','=','tb_pgapp.pgapp_gender_sl')
                ->join('tbz_reservation_list','tbz_reservation_list.id','=','tb_pgapp.pgapp_caste_sl')
                ->where('pgapp_id','=',$appid)
                ->get();
            foreach ($pgapp as $value) {
                $ugcourse_status=$value->ugcourse_status;
            }
            $payment_success= PaymentTrans::where('client_code',$appid)->where('res_verified',"SUCCESS")->first();

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

            $pdf = PDF::loadView('2022.applnprintout_dept',compact('pgapp','religion','community','caste','subcaste','pgquali','pgotherinfo','pgphoto',
                    'pgsign','curnt_date','time','pgoptions','semester_grades','payment_success','name'));

        return $pdf->download('PgApplication.pdf');
     }
     else{
         return "Something went wrong";
     }

    }   

  
    private function payment_success_status($appid){
        
//           $id=Auth::user()->pgapp_id;
           $pay_details = PaymentTrans::where('client_code',$appid)->where('res_verified',"SUCCESS")->count();
           
//           $pay_details = DB::table('tb_pgapp')->select('tbz_atom_transactions.*','tb_pgapp.indexmark','tb_pgapp.pgapp_id')
//                   ->join('tbz_atom_transactions','tb_pgapp.pgapp_id','tbz_atom_transactions.client_code')  
//                    ->where('tbz_atom_transactions.res_verified',"SUCCESS")                
//                   ->where('tb_pgapp.pgapp_id',Auth::user()->pgapp_id)->first(); 

           return  $pay_details;      

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
    
}   
    

