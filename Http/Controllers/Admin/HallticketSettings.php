<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;
use Carbon\Carbon;

class HallticketSettings extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $examname=DB::select("select exam_sl,exam_name from tb_exam");
        $prgm=DB::select('select pgtype_sl,pgtype_name from tb_programtype');
        
        return view('admin/hallticket/hallticketsettings', compact('examname','prgm'));
    }
    public function search(Request $request){
        $input=$request->strUser;
        dd($input);
    }
}
