<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPgOtherInfo extends Model
{
    protected $primarykey='postpgotherinfo_id';
    protected $table='tbz_postpgotherinfo';
    protected $fillable=[
        'ph_status',
        'ph_type',
        'postpgapp_sl_ref',
        'postpgotherinfo_appid',
        'postpgjrf_option',
        'postpgjrf_regno',
        'postpgjrf_year',
        'postpgemployment_option',
        'postpgemployment_details',
        'postpgemployment_teach_exp',
        'postpgpaperpublish_option',
        'postpgpaperpublish_info'
    ];
}
