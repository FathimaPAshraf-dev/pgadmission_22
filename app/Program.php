<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table='tb_program';
    protected $primaryKey = 'pgm_sl';
    protected $fillable = [

'pgm_name',
'pgm_duration',
'pgm_code',
'pgm_year',
'pgm_sgpa',
'pgm_cgpa',
'pgm_mincredit',
'pgm_status',
'pgm_user_sl',
'pgm_time',
'pgm_type',
'pgm_passgrade',
'pgm_fac_sl',
'pgstream_id',
'pgm_code_upd',
'pgm_identifier',
'pgm_dept_sl',


    ];
     public  function dept_table()
    {
    	return $this->belongsTo('App\Department','pgm_dept_sl', 'dept_sl');
    }
    public  function faculty_table()
    {
    	return $this->belongsTo('App\Faculty','pgm_fac_sl', 'sl');
    }

}
