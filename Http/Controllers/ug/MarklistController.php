<?php

namespace App\Http\Controllers\ug;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class MarklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {  
        $stud_regno=Auth::user()->stud_registerno;
        $ugexam=DB::select("select  tb1.exam_name,exam_sem_sl,exam_sl from tb_exam tb1 
                    inner join tb_studexam tb2 on tb1.exam_sl=tb2.exstd_exam_sl 
                    where tb2.exstd_registerno=? and publish_status=1  order by exam_sl  desc" ,[$stud_regno]);
             
        return view('ug.result.home',compact('ugexam'));
            
       
    }
    public function marklist(Request $request){
       
        $stud_regno=Auth::user()->stud_registerno;
        $sem=$request->input('sem');
        $examsl=$request->input('examsl');
//        dd($examsl);

        $exam_name=DB::select("select  tb1.exam_name,tb1.exam_sem_sl,upper(tb2.tb_name_of_stud) as tb_name_of_stud,tb2.tb_center_name,
                            tb2.exstd_exam_sl,tb2.exstd_withheld,tb2.exstd_provisional_verify,tb1.exam_type,exam_sl
                            from tb_exam tb1 inner join tb_studexam tb2 on tb1.exam_sl=tb2.exstd_exam_sl 
                            where tb2.exstd_registerno=?  and tb1.exam_sem_sl=? and tb1.exam_sl=?" ,[$stud_regno,$sem,$examsl]);

//        dd($exam_name);
        foreach($exam_name as $res){
            $centre=$res->tb_center_name;
            $exstd_withheld=$res->exstd_withheld;
            $exstd_provisional_verify=$res->exstd_provisional_verify;
         }
        if($exstd_withheld==1 || $exstd_provisional_verify==1){

           session()->flash('message', 'Result Provisionally withheld !!! Please contact office/department');
           return redirect('/index');

        }
        $center=DB::select("select centre_name from tb_centre where centre_sl=?" ,[$centre]);

        $pdetsl=DB::select("select s.pdetsl,s.sem,s.intx,s.extx,s.mxintx,s.mxextx,s.totx,s.mxx,s.grade,s.grdpt,s.cgp,s.sgpa,p.pdet_credit,p.pdet_code,p.pdet_name,p.pdet_ptype_sl,t.ptype_name,t.ptype_sl 
                from tbz_studexamdet s inner join tb_paperdetails p on s.pdetsl=p.pdet_sl
                inner join tb_papertype t on t.ptype_sl=p.pdet_ptype_sl
                where s.regno=? and s.sem=? and s.exmsl=? order by p.pdet_code asc",[$stud_regno,$sem,$examsl]);
        
        $coureresult=DB::select("select exstd_sem,exstd_cgpa,exstd_cgpa_grd from tb_studexam tb1 inner join tb_exam tb2
                     on tb2.exam_sl=tb1.exstd_exam_sl where tb1.exstd_registerno=? and exstd_sem=? and exam_sl=?" ,[$stud_regno,$sem,$examsl]);
//        dd($coureresult);
        
        return view('ug.result.marklistpreview')->with('exam_name',$exam_name)->with('center',$center)->with('pdetsl',$pdetsl)->with('coureresult',$coureresult);

    }
    
public function marklistpdf(Request $request){
    
        $regno=Auth::user()->stud_registerno;
         $exam_sl=$request->input('exmsl');
         $sem=$request->input('sem');
        $exam_name=DB::select("select  tb1.exam_name,tb1.exam_sem_sl,upper(tb2.tb_name_of_stud) as tb_name_of_stud,tb2.tb_center_name,
                         tb1.exam_month,tb1.exam_year,tb1.exam_type,
                         tb2.exstd_exam_sl,tb2.exstd_withheld,tb2.exstd_provisional_verify,tb1.exam_type
                         from tb_exam tb1 inner join tb_studexam tb2 on tb1.exam_sl=tb2.exstd_exam_sl
                         where tb2.exstd_registerno=?  and tb1.exam_sem_sl=? and tb1.exam_sl=?" ,[$regno,$sem,$exam_sl]);

//        $prgm=DB::select("select tb1.pgm_name,tb4.dept_name from tb_program tb1 inner join tb_admnscheme tb2
//                        on tb1.pgm_sl=tb2.adsc_pgm_sl inner join tb_studadmin tb3 on tb3.stud_adsc_sl=tb2.adsc_sl
//                        inner join tb_department tb4 on  tb4.dept_sl=tb1.pgm_dept_sl  
//                        where tb3.stud_registerno=?",[$regno]);

 
    $fac=DB::select('select name from tb_faculty tb1 inner join tb_program tb2 on tb1.sl=tb2.pgm_fac_sl

                    inner join tb_admnscheme tb3 on tb3.adsc_pgm_sl=tb2.pgm_sl

                    inner join tb_studadmin tb4 on tb4.stud_adsc_sl=tb3.adsc_sl where stud_registerno=?',[$regno]);
    foreach ($fac as $key) {
         $facname=$key->name;
       
    }
 
    $pdetsl=DB::select("select s.pdetsl,s.sem,s.intx,s.extx,s.mxintx,s.mxextx,s.totx,s.mxx,s.grade,s.grdpt,s.cgp,s.sgpa,p.pdet_credit,
            p.pdet_code,p.pdet_name,p.pdet_ptype_sl,t.ptype_name,t.ptype_sl from tbz_studexamdet s
            inner join tb_paperdetails p on s.pdetsl=p.pdet_sl
            inner join tb_papertype t on t.ptype_sl=p.pdet_ptype_sl where s.regno=? and s.sem=? and s.exmsl=? order by p.pdet_code asc",[$regno,$sem,$exam_sl]);
    
    $coureresult=DB::select("select exstd_sem,exstd_cgpa,exstd_cgpa_grd from tb_studexam tb1 inner join tb_exam tb2
                     on tb2.exam_sl=tb1.exstd_exam_sl where tb1.exstd_registerno=? and exstd_sem=? and exam_sl=?" ,[$regno,$sem,$exam_sl]);

    $pdf = PDF::loadView('ug.result.pdf', compact('exam_name','pdetsl','facname','coureresult'))->setPaper('a4', 'landscape');
    return $pdf->download('marklist.pdf');
   
    }
}