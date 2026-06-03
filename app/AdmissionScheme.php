<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionScheme extends Model
{
    //	adsc_sl	adsc_scheme_sl	adsc_admnyear	adsc_status	adsc_user_sl	adsc_time	adsc_name	adsc_pgm_sl	adsc_rankstatus	adsc_laststudent	adsc_block_allot	adsc_admon	adsc_tot_cre
//   protected $connection = 'pgsql2';

protected $table='tb_admnscheme';
    protected $primaryKey = 'adsc_sl';
    protected $fillable = [

						'adsc_sl',
						'adsc_scheme_sl',
						'adsc_admnyear',
						'adsc_status',
						'adsc_user_sl',
						'adsc_time',
						'adsc_name',
						'adsc_pgm_sl',
						'adsc_rankstatus',
						'adsc_laststudent',
						'adsc_block_allot',
						'adsc_admon',
						'adsc_tot_cre'

                            
    ];
    
    public  function program_table()
    {
    	return $this->belongsTo('App\Program','adsc_pgm_sl', 'pgm_sl');
    }
    public  function scheme_table()
    {
    	return $this->belongsTo('App\Scheme', 'adsc_scheme_sl','scheme_sl');
    }
    
    

}
