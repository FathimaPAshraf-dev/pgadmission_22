<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postpg extends Model
{
    protected $table='tb_postpgapp';
    protected $primaryKey = 'postpgapp_sl';
    protected $fillable = [
        'postpgapp_appid',
        'postpgapp_app_password',
        'postpgapp_admission_year',
        'postpgapp_pgmtyp_sl_ref',
        'postpgapp_adsc_sl_ref',
        'postpgapp_studname',
        'postpgapp_father_guardian_name',
        'postpgapp_photo',
        'postpgapp_dob',
        'postpgapp_age',
        'postpgapp_gender_sl',
        'postpgapp_nationality',
        'postpgapp_religion_sl',
        'postpgapp_community_sl',
        'postpgapp_caste_sl',
        'postpgapp_subcaste_sl',
        'postpgapp_comn_address',
        'postpgapp_permt_address',
        'postpgapp_landphone',
        'postpgapp_mobile',
        'postpgapp_email',
        'postpgapp_additional_info',
        'postpgapp_ipaddress',
        'postpgapp_admn_applnverify_status',
        'postpgapp_admn_confirm_status',
        'postpgapp_delete_chkflag',
        'postpgapp_date',
        'postpgapp_verified',
        'ph_status',
        'ph_type',
        'password_dob',
        'pgcourse_status',
        'mphilcourse_status',
        'postpgapp_serial',
        'postpgapp_status',
        'postpgapp_centre_sl',
        'sslc_regno',
        'postpgapp_aadharno'

    ];
        
}
