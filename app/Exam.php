<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table='tb_exam';
    protected $primaryKey = 'exam_sl';
    protected $fillable = [

        'exam_adsc_sl',
        'exam_sem_sl',
        'exam_month',
        'exam_year',
        'exam_name',
        'examreg_status',	
        'publish_status',
        'hallticket_status',
    ];

//     public  function program_table()
//    {
//    	return $this->belongsTo('App\User','stud_sl', 'pgm_sl');
//    }

}



