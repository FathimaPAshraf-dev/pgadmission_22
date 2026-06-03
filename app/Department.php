<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='tb_department';
    protected $primaryKey = 'dept_sl';
    protected $fillable = [

							'dept_sl',		
							'dept_name'	,
							'dept_descp',	
							'dept_coordinator',		
							'dept_council',	
							'dept_user_sl',	
							'dept_time'	,	
							'dept_status'
							];
}
