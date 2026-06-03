<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectmodecourse extends Model
{
    protected $table='tb_pg_projectmode';
    protected $primaryKey = 'p_sl';
    protected $fillable = [
              'pgapp_id','p_adsc_sl','p_option','p_stream'
        
    ];
	
}
