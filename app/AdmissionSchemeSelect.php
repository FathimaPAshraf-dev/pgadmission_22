<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionSchemeSelect extends Model
{
    //

protected $table='tb_pg_pgpgm';
    protected $primaryKey = 'pgpgm_sl';
    protected $fillable = [
							'pgpgm_pgapp_id',
							'pgpgm_adsc_sl',
							'pgpgm_user_sl',
							'pgpgm_status',
							'pgpgm_timestamp',
							'pgpgm_weightage',
							'pgpgm_entrance',
							'pgpgm_index',
							'pgpgm_rank',
							'pgpgm_quota',
							'pgpgm_listtype',
							'pgpgm_entrstatus',
							'pgpgm_reason',
							'pgpgm_indexstatus',
							'pgpgm_rankstatus',
							'pgpgm_allotstatus',
							'pgpgm_admnweg_sl',
							'pgpgm_rankallot',
							'pgpgm_intstatus',
							'pgpgm_centreallotted',
							'pgpgm_ranksl',
							'pgpgm_originallist',
							'pgpgm_feex',
							'pgpgm_feeconsn',
							'pgpgm_spot',
							'pgpgm_qcec',
							'pgpgm_entrverified'


                            
    ];

   public function admn_scheme_table()
    {
        return $this->belongsTo('App\AdmissionScheme', 'pgpgm_adsc_sl','adsc_sl');
    }


}
