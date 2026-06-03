<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table='tb_pgapp';
    protected $primaryKey = 'pgapp_sl';
    protected $fillable = [
                            'pgapp_name',
                            'pgapp_centre_sl',
                            'pgapp_gender_sl',
                            'pgapp_dob',
                            'pgapp_nationality',
                            'pgapp_relgn_sl',
                            'pgapp_caste_sl',
                            'pgapp_comm_sl',
                            'pgapp_father',
                            'pgapp_occp',
                            'pgapp_inc_sl',
                            'pgapp_permaddress',
                            'pgapp_commaddress',
                            'pgapp_email',
                            'pgapp_degq_sl',
                            'pgapp_dqsub_sl',
                            'pgapp_encl',
                            'pgapp_id',
                            'pgapp_differential',
                            'pgapp_jawan',
                            'pgapp_orphan',
                            'pgapp_arts',
                            'pgapp_sports',
                            'pgapp_ncc',
                            'pgapp_status',
                            'pgapp_timestamp',
                            'pgapp_user_sl',
                            'pgapp_verified',
                            'pgapp_qualimark',
                            'pgapp_subcaste_sl',
                            'pgapp_college',
                            'pgapp_photo',
                            'pgapp_sl',
                            'verify_block',
                            'pgapp_blind',
                            'pgapp_bpl',
                            'pgapp_mobile',
                            'pgapp_nss',
                            'pgapp_addl',
                            'pgapp_age',
                            'pgapp_password',
                            'pgapp_stream_id',
                            'pgapp_whether_reserv',
                            'pgapp_wh_special_reserv',
                            'pgapp_flag',
                            'regdetails_flag',
                            'pgapp_sportsncc',
                            'dd',
                            'pgapp_castetext',
                            'pgapp_hallticket_dtime',
                            'pgapp_hallticket_dstatus'
                            
    ];

    public function community_table()
    {
        return $this->belongsTo('App\Community', 'pgapp_comm_sl','comm_sl');
    }
    public function religion_table()
    {
        return $this->belongsTo('App\Religion', 'pgapp_relgn_sl','relgn_sl');
    }
    public function ranklist()
    {
        return $this->belongsTo('App\Ranklist', 'pgapp_id','applnid');
    }
  public function scheme_select()
    {
        return $this->belongsTo('App\AdmissionSchemeSelect' ,'pgapp_id','pgpgm_pgapp_id');
    }
     public function income_table()
    {
        return $this->belongsTo('App\Income', 'pgapp_inc_sl','inc_sl');
    }
    public function pg_stream_table()
    {
        return $this->belongsTo('App\Stream', 'pgapp_stream_id','pgstream_id');
    }

   
}

