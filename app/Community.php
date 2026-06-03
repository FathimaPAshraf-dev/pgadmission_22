<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    //

protected $table='tb_community';
    protected $primaryKey = 'comm_sl';
    protected $fillable = [
    				'comm_sl',

                     'comm_name',
                     'comm_status',
                     'comm_user_sl ',
                     'comm_time'
                     
  
                            
    ];

   

}
