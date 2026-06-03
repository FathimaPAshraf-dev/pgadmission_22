
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Centre;
use App\Department;
use Session;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Dompdf\Dompdf as Dompdf;

class ViewrankControllermphil extends Controller {
    
     public function viewranklist(Request $request)
     {
return "ff";
         


     $list = DB::select("SELECT tb3.adsc_name,count(*),adsc_sl FROM tb_postpgapp tb1
                inner join
                tbz_atom_transactions tb2 on tb1.onlinepay_merchanttxnid=tb2.merchanttxnid
                inner join tb_admnscheme tb3 on tb1.postpgapp_adsc_sl_ref=tb3.adsc_sl
                WHERE tb2.res_verified='SUCCESS' and tb3.adsc_sl not in(799,805,806,807,808,809,810,811,804,813,812,800,801,802,803,814)  group by tb3.adsc_name,tb3.adsc_sl order by tb3.adsc_name");
//          dd($count)   ;     
         
         
         
// return( $list);
        return view('managelist', compact('list'));  
         
      //return "yes";   
         
         
     }
}