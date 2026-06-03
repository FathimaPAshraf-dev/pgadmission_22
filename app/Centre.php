<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
       

protected $table='tb_centre';
    protected $primaryKey = 'centre_sl';
    protected $fillable = [
							
							'centre_code',
							'centre_name',
							'centre_place'	,
							'centre_dist_sl',	
							'centre_addr',
							'centre_ph'	,
							'centre_mob',
							'centre_fax',
							'centre_email',	
							'centre_web',
							'centre_centd_sl',
							'centre_status'	,
							'centre_user_sl',
							'centre_time',
							'id_pkey'	,
							'admnnid_on'
							                     
							  
                            
    ];
}
